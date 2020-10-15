<?php

namespace App\Services;

use App\Helper\FormBuilderHelper as Helper;
use App\Models\Attachment;
use App\Models\Form;
use App\Models\RequestComment;
use App\Models\RequestCommentAttachment;
use App\Models\RequestLog;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RequestService
{
    /**
     * @param $categoryId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($param): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $query = Submission::from('form_submissions as s')
            ->join('template_category as tc', 'tc.form_id', 's.form_id')
            ->join('users as u', 'u.id', 's.user_id');

        if (!empty($param['keyword'])) {
            $query->where('u.name', 'LIKE', "%{$param['keyword']}%");
        }

        if (!empty($param['category_id'])) {
            $query->where('tc.category_id', $param['category_id']);
        }

        if (!empty($param['template_id'])) {
            $query->where('tc.form_id', $param['template_id']);
        }

        if (!empty($param['start_date']) && !empty($param['end_date']) && $param['start_date'] != '1970-01-01T00:00:00.000Z') {
            $query->where(
                function ($qDate) use ($param) {
                        $qDate->whereBetween('s.created_at', [new \Carbon\Carbon($param['start_date']), new \Carbon\Carbon($param['end_date'])]);
                });
        }

        if (!empty($param['status'])) {
            $query->where('s.status', $param['status']);
        }

        return $query->with(['requestLogs', 'requestComments', 'user', 'form.approvers', 'form.category'])
            ->select(['s.*'])
            ->orderByDesc('s.created_at')
            ->paginate(config('app.item_per_request'));
    }

    /**
     * @param $categoryId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getRequestByCategory($categoryId): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Submission::from('form_submissions as s')
            ->join('template_category as tc', 'tc.form_id', 's.form_id')
            ->where('tc.category_id', $categoryId)
            ->with(['requestLogs', 'requestComments', 'user', 'form.approvers'])
            ->latest()
            ->paginate(config('app.item_per_request'));
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getRequest($id)
    {
        return Submission::with('requestLogs', 'requestComments.user', 'requestComments.attachments', 'user', 'form.approvers', 'form.category')
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * @param $id
     * @param $request
     * @throws \Exception
     */
    public function createRequestComment($id, $request): void
    {
        try {
            DB::beginTransaction();

            $message = $request->get('message');

            $requestComment = RequestComment::create([
                'user_id' => auth()->user()->id,
                'request_id' => $id,
                'message' => $message
            ]);

            if (!empty($request->file) && $request->file != "null") {
                $fileName = time() . '_____' . $request->file->getClientOriginalName();
                $extension = $request->file->extension();
                $path = Storage::putFileAs(
                    'attachment', $request->file, $fileName
                );
                $attachment = Attachment::create([
                    'title' => $fileName,
                    'url' => $path,
                    'type' => $extension,
                ]);
                RequestCommentAttachment::insertOrIgnore([
                    'attachment_id' => $attachment->id,
                    'request_comment_id' => $requestComment->id,
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }

    public function createRequest($request, $identifier)
    {
        $form = Form::query()->where('identifier', $identifier)->first();
        if (empty($form)) {
            throw new \Exception(__('common.messsages._not_found'), 404);
        }
        try {
            DB::beginTransaction();
            $input = $request->except('_token');

            // check if files were uploaded and process them
            $uploadedFiles = $request->allFiles();
            if (count($uploadedFiles) > 5) {
                throw new \Exception(__('request.common.number_file_upload_greater_than'), 405);
            }
            foreach ($uploadedFiles as $key => $files) {
                if (is_array($files) && count($files) > 5) {
                    throw new \Exception(__('request.common.number_file_upload_greater_than'), 405);
                }
                $input[$key] = [];
                foreach ($files as $file) {
                    // store the file and set it's path to the value of the key holding it
                    if ($file->isValid()) {
                        $fileName = time() . '_____' . $file->getClientOriginalName();
                        $input[$key][] = Storage::putFileAs(
                            'attachment', $file, $fileName
                        );
                    }
                }
            }

            $userId = auth()->user()->id ?? null;
            $submission = $form->submissions()->create([
                'user_id' => $userId,
                'content' => $input,
            ]);

            DB::commit();

            return $submission;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}

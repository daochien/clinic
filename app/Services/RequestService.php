<?php

namespace App\Services;

use App\Models\Attachment;
use App\Models\RequestComment;
use App\Models\RequestCommentAttachment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RequestService
{

    public function __construct()
    {
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
            ->paginate(10);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getRequest($id)
    {
        $submission = Submission::with('requestLogs', 'requestComments.user', 'requestComments.attachments', 'user', 'form.approvers', 'form.category')
            ->where('id', $id)
            ->firstOrFail();
        return $submission;
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

            if (!empty($request->file)) {
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
}

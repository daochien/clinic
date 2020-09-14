<?php

namespace App\Services;

use App\Helper\FormBuilderHelper as Helper;
use App\Models\Attachment;
use App\Models\Form;
use App\Models\Inquiry;
use App\Models\InquiryComment;
use App\Models\InquiryCommentAttachment;
use App\Models\InquiryLog;
use App\Models\RequestComment;
use App\Models\RequestCommentAttachment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InquiryService
{
    /**
     * @param $categoryId
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getRequestByCategory($categoryId): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Inquiry::from('inquiry as i')
            ->join('categories as c', 'c.id', 'i.category_id')
            ->leftJoin('inquiry_logs as l', 'l.inquiry_id', 'i.id')
            ->where('c.id', $categoryId)
            ->with('inquiryComments.user', 'createdBy', 'closedBy', 'category')
            ->latest('i.created_at')
            ->select('i.*', 'l.created_at as closed_at')
            ->paginate(10);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    public function getDetail($id)
    {
        return Inquiry::with('inquiryComments.user', 'createdBy', 'closedBy', 'category')
            ->where('id', $id)
            ->first();
    }

    public function storage($params)
    {
        try {
            DB::beginTransaction();
            $userId = auth()->user()->id ?? null;
            $inquiry = Inquiry::create([
                'created_by' => $userId,
                'category_id' => $params['category_id'],
                'title' => $params['title'],
                'question' => $params['question'],
                'status' => Inquiry::STATUS['open'],
            ]);
            DB::commit();

            return $inquiry;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * @param $id
     * @param $request
     * @throws \Exception
     */
    public function comment($id, $request): void
    {
        try {
            DB::beginTransaction();

            $message = $request->get('message');

            $requestComment = InquiryComment::create([
                'user_id' => auth()->user()->id,
                'inquiry_id' => $id,
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
                InquiryCommentAttachment::insertOrIgnore([
                    'attachment_id' => $attachment->id,
                    'inquiry_comment_id' => $requestComment->id,
                ]);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }
    }

    public function closeInquiry($user, $id)
    {
        InquiryLog::insert([
            'inquiry_id' => $id,
            'user_id' => $user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

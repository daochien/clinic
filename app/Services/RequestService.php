<?php

namespace App\Services;

use App\Models\Submission;
use Illuminate\Support\Facades\DB;

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
        $submission = Submission::with('requestLogs', 'requestComments', 'user', 'form.approvers', 'form.category')
            ->where('id', $id)
            ->firstOrFail();
        return $submission;
    }
}

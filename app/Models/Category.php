<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name', 'description', 'type'];

    const TYPE = ['document' => 1,'blog' => 2, 'inquiry' => 3, 'template' => 4, 'faq' => 5];

    protected $hidden = ['created_at', 'updated_at'];

    public function inquiry()
    {
        return $this->hasMany(Inquiry::class);
    }

    public function latestPage()
    {
        return $this->hasOne(Page::class, 'category_id')->where('pages.status', Page::PAGE_STATUS['active'])->latest();
    }

    public function countRequestNeedProcess($catId)
    {
        $requestMultiApproverNeedProcess = Submission::from('form_submissions as fs')
            ->join('forms as f', 'f.id', 'fs.form_id')
            ->join('template_category as tc', 'tc.form_id', 'fs.form_id')
            ->join('template_approvers as ta', 'ta.form_id','fs.form_id')
            ->leftJoin('request_logs as rl', function($join) {
                $join->on('fs.id', 'rl.request_id');
                $join->on('ta.user_id', 'rl.approver_id');
            })
            ->whereNull('rl.approver_id')
            ->where('tc.category_id', $catId)
            ->where('f.multi_approve', 1)
            ->groupBy('fs.id')
            ->get('fs.id', 'fs.id as request_id');

        $requestOnceApproverNeedProcess = Submission::from('form_submissions as fs')
            ->join('forms as f', 'f.id', 'fs.form_id')
            ->join('template_category as tc', 'tc.form_id', 'fs.form_id')
            ->leftJoin('request_logs as rl', 'fs.id', 'rl.request_id')
            ->whereNull('rl.approver_id')
            ->where('tc.category_id', $catId)
            ->where('f.multi_approve', 0)
            ->groupBy('fs.id')
            ->get('fs.id', 'fs.id as request_id');

        return $requestMultiApproverNeedProcess->count() + $requestOnceApproverNeedProcess->count();
    }

    public function countInquiryNotClosed($catId)
    {
        return Inquiry::from('inquiry as i')
            ->join('categories as c', 'c.id', 'i.category_id')
            ->where('c.id', $catId)
            ->where('i.status', Inquiry::STATUS['open'])
            ->count();
    }
}

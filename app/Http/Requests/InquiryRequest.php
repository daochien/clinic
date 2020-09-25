<?php

namespace App\Http\Requests;

use App\Models\Inquiry;
use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $inquiryCategory = implode(",", Inquiry::allCategory()->pluck('id')->all());

        return [
            'title' => 'required|string|max:200',
            'category_id' => "required|integer|in:{$inquiryCategory}",
            'question' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            '題名' => 'クリニック名',
            'カテゴリ' => '郵便番号',
            '内容' => '住所 ',
        ];
    }
}

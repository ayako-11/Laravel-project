<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
    *
    * @return array<string, string>
    */
    public function rules(): array
    {
        return [
            'start_deadline' => 'nullable|date',
            'end_deadline' => 'nullable|date|after_or_equal:start_deadline',
            'keyword' => 'nullable|string',
            'priority' => 'nullable|integer',
            'status' => 'nullable',
            'sort_by' => 'required|string',
            'sort_order' => 'required|in:asc,desc',
        ];
    }

    /**
    *
    * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            'start_deadline.nullable' => '開始日が無効です。',
            'end_deadline.nullable' => '終了日が無効です。',
            'end_deadline.after_or_equal' => '終了日は開始日以降の日付を入力してください。',
            'keyword.nullable' => 'キーワードを入力してください。',
            'priority' => '優先度が無効です。',
            'status' => 'ステータスが無効です。',
            'sort_by.required' => '並び替え対象は必須です。',
            'sort_order.required' => '並び替え順序は必須です。',
        ];
    }
}

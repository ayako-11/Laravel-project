<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_deadline' => 'required|date',
            'end_deadline' => 'required|date|after_or_equal:start_deadline',
            'priority' => 'required|integer|in:10,20,30',
        ];
    }
    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'start_deadline.required' => '日付が無効です',
            'end_deadline.required' => '日付が無効です',
            'priority.required' => '優先度が異なります',
        ];
    }
}

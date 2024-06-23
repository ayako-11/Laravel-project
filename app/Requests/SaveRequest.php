<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
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
        'title' => 'required|string|max:120',
        'detail' => 'nullable|string|max:1000',
        'deadline' => 'required|date|after_or_equal:today',
        'priority' => 'required|integer|in:10,20,30',
        ];
    }

/**
 * Get custom error messages for validator errors.
 *
 * @return array<string, string>
 */
    public function messages(): array
    {
        return [
        'title.required' => '120字以内です',
        'detail.nullable' => '1000字以内です',
        'deadline.required' => '日付が無効です',
        'priority.required' => '優先度が異なります',
        ];
    }
}

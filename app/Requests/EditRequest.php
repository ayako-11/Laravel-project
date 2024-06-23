<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
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
            'last_updated_at' => 'required|date|same:database_column_name',
        ];
    }

    public function messages(){
        return [
            'title.required' => '120字におさめてください',
            'detail.required'  => '1000字におさめてください',
        ];
    }

}

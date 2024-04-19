<?php

class ExampleValidationDefinition
{
    public function rules(): array
    {
        return [
            'item' => ['required']
        ];
    }

    public function messages(): array
    {
        return [];
    }
}

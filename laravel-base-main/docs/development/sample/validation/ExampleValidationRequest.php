<?php

use Illuminate\Foundation\Http\FormRequest;

/**
 * FormRequestの例
 * サーバーサイドとクライアントサイドで同じバリデーションルールを使う都合上、
 * ルールの定義を ExampleValidationDefinition クラスに切り出してある。
 *
 */
class ExampleValidationRequest extends FormRequest
{
    /**
     * コンストラクタインジェクションにより、このFormRequestが依存する ExampleValidationDefinition を取得
     */
    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null,
        private ExampleValidationDefinition $validation
    ) {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function rules(): array
    {
        //実装内容はExampleValidationDefinitionに移譲してある
        return $this->validation->rules();
    }

    public function messages(): array
    {
        //こちらも同様。実装内容はExampleValidationDefinitionに移譲してある。
        return $this->validation->messages();
    }
}

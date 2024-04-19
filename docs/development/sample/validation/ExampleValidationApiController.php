<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * 最も単純なバリデーションを行うAPIの例。
 * クライアントサイドでバリデーションを行いたい場合は、下記の要領でFormRequestと同等のバリデーションを行うAPIを用意。
 * クライアントからはこのコントローラーを呼び出して利用する。
 */
class ExampleValidationApiController
{
    public function __construct(private ExampleValidationDefinition $validation)
    {
    }

    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validation->rules(), $this->validation->messages());

        //以下の実装は、クライアントサイドでどのように実装したいかによって適宜返却する情報を増やせばよい。
        $result = true;
        if ($validator->fails()) {
            $result = false;
        }

        //全体のバリデーション結果とメッセージを返却
        return response()->json([
            'result' => $result,
            'messages' => $validator->messages(),
        ]);
    }

}

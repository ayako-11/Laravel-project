<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return view('save');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 入力内容のチェック
        // ルールに一致しない入力の場合は、自動的に入力画面を表示させる
        $request->validate([
            'title' => 'required|max:120',
            'detail' => 'required|max:1000',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'priority' => 'required|in:urgent,high,low',
        ]);

        return view('save');
    }

}

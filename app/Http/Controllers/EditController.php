<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditController extends Controller
{
    /**
     * Handle the incoming request and return the view.
     */
    public function __invoke(Request $request)
    {
        // ここに適切な処理を追加してください
        return view('edit');
    }
}

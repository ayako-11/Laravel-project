<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Query\Changequery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChangeformController extends Controller
{
    /*
     * Handle the incoming request and return the view.
     */
    public function __invoke(int $id, Changequery $changeQuery): View
    {
        // 指定されたIDのタスクを取得
        $task = $changeQuery->getTaskById($id);

        return view('change', [
            'task' => $task
        ]);
    }
}

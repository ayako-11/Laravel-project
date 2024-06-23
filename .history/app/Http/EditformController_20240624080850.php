<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Query\Editquery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EditformController extends Controller
{
    public function __invoke(int $id, Editquery $editQuery): View
    {
        // 指定されたIDのタスクを取得
        $task = $editQuery->getTaskById($id);

        return view('edit', [
            'task' => $task
        ]);
    }
}

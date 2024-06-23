<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EditRequest;
use App\Query\Editquery;
use Illuminate\View\View;

class EditController extends Controller
{
    protected Editquery $editQuery;

    public function __construct(Editquery $editQuery)
    {
        $this->editQuery = $editQuery;
    }

    public function store(int $id, EditRequest $request): View
    {
        $data = [
            'title' => $request->input('title'),
            'detail' => $request->input('detail'),
        ];

        $this->editQuery->updateTask($id, $data);

        // 編集後のタスクを再取得してビューに渡す
        $task = $this->editQuery->getTaskById($id);

        return view('/search', compact('task'));
    }
}

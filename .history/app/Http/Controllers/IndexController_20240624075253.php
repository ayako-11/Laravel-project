<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use Illuminate\View\View;
use App\Gateway\Repository\TodoRepository;

class IndexController extends Controller
{
    protected TodoRepository $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function search(SearchRequest $request): View
    {
        $filters = $request->only([
            'start_deadline', 'end_deadline', 'keyword',
            'priority', 'status', 'sort_by', 'sort_order'
        ]);
        // 空のtasksを渡す
        $tasks = $this->todoRepository->search($filters);

        return view('search', compact('tasks'));
    }
}

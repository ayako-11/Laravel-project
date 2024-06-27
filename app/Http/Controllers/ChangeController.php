<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChangeRequest;
use App\Query\Changequery;
use Illuminate\View\View;

class ChangeController extends Controller
{
    protected Changequery $changeQuery;

    public function __construct(Changequery $changeQuery)
    {
        $this->changeQuery = $changeQuery;
    }

    public function store(int $id, ChangeRequest $request): View
    {
        $data = [
            'start_deadline' => $request->input('start_deadline'),
            'end_deadline' => $request->input('end_deadline'),
            'priority' => $request->input('priority'),
        ];

        $this->changeQuery->updateTask($id, $data);


        $task = $this->changeQuery->getTaskById($id);

        return view('/search', compact('task'));
    }
}

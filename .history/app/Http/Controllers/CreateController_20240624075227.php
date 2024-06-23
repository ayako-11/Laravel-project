<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SaveRequest;
use Illuminate\Http\RedirectResponse;
use App\Query\Query;

class CreateController extends Controller
{
    public function store(SaveRequest $request): RedirectResponse
    {
        $query = new Query();
        $query->store($request);

        return redirect('/search')->with('success', 'タスクが登録されました。');
    }
}

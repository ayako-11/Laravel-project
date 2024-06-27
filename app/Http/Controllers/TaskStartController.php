<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Task;

class TaskStartController extends Controller
{
    public function startTask($id)
{
    // TODOを取得
    $task = Task::find($id);

    // 遷移条件のチェック
    $currentStatus = $task->status;
    $canStart = false;

    switch ($currentStatus) {
        case 'new':
            $canStart = true; // 新規から進行中へ
            break;
        case 'in_progress':
            $canStart = false; // 進行中から進行中へは変更不可
            break;
        case 'completed':
            $canStart = false; // 完了から進行中へは変更不可
            break;
        case 'canceled':
            $canStart = false; // 中止から進行中へは変更不可
            break;
    }

    if ($canStart) {
        $task->status = 'in_progress';
        $task->save();
        return redirect('/search')->with('success', 'TODOを「開始」に変更しました。');
    } else {
        return redirect('/search')->with('warning', 'このTODOは「開始」に変更できません。');
    }
}
}

<?php

declare(strict_types=1);

namespace App\Query;

use App\Models\Task;
use App\Http\Requests\SaveRequest;
use Carbon\Carbon;
use LogicException;

class Query
{
    /**
     * タスクを登録する
     *
     * @return int
     */
    public function insertTask(string $title, string $detail, Carbon $deadline, int $priority): int
    {
        // Task クラスのインスタンスを作成
        $task = new Task();

        // インスタンスを使ってデータを登録する
        $task->title = $title;
        $task->detail = $detail;
        $task->deadline = $deadline;
        $task->priority_id = $priority;
        $task->status_id = 10; // ステータスのデフォルト値を設定
        $task->save();

        return $task->id;
    }

    /**
     * リクエストデータを元にタスクを登録する
     *
     * @param SaveRequest $request
     * @return void
     */
    public function store(SaveRequest $request): void
    {
        $title = $request->String(key: 'title')->toString();
        $detail = $request->String(key: 'detail')->toString();

        /** @var \Carbon\Carbon|null $deadline */
        $deadline = $request->date(key: 'deadline', format: 'Y-m-d');
        if(is_null($deadline)){
            throw new LogicException('deadline must not be null.');
        }

        $priority = $request->integer(key: 'priority');

            // $deadline の値を出力して確認
        $this->insertTask($title, $detail, $deadline, $priority);
    }
}

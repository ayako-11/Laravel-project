<?php

declare(strict_types=1);

namespace App\Query;

use App\Models\Task;

class Editquery
{
    /**
     * タスクIDからタスクを取得する
     *
     * @param int $id
     * @return Task|null
     */
    public function getTaskById(int $id): ?Task
    {
        return Task::find($id);
    }

    /**
     * タスクを更新する
     *
     * @param int $id
     * @param array $data
     * @return void
     */
    public function updateTask(int $id, array $data): void
    {
        // 渡されてきた記事IDのデータを取得
        $task = Task::find($id);

        if ($task) {
            // 編集する内容をfillメソッドを使用して記述
            $task->fill($data);

            // 保存処理
            $task->save();
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Query;

use App\Models\Task;

class Changequery
{
    private Task $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * @param int $id
     * @return Task|null
     */
    public function getTaskById(int $id): ?Task
    {
        return $this->task->find($id);
    }

    /**
     * @param int $id
     * @param array<string, mixed> $data
     * @return bool
     */
    public function updateTask(int $id, array $data): bool
    {
        $task = $this->task->find($id);
        if ($task) {
            return $task->update($data);
        }
        return false;
    }
}

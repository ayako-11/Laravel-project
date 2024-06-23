<?php

declare(strict_types=1);

namespace App\Gateway\Repository;

use App\Http\Requests\SearchRequest;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TodoRepository
{
    /**
     * Taskのクエリを構築する、検索結果を取得する
     * @param array<string, string|null> $filters
     * @return LengthAwarePaginator<Task>
     */
    public function search(array $filters): LengthAwarePaginator
    {
        // クエリビルダーのインスタンスを作成
        $query = Task::query()
            ->startDeadline($this->castToStringOrNull($filters['start_deadline'] ?? null))
            ->endDeadline($this->castToStringOrNull($filters['end_deadline'] ?? null))
            ->keyword($this->castToStringOrNull($filters['keyword'] ?? null))
            ->priority($this->castToStringOrNull($filters['priority'] ?? null))
            ->status($this->castToStringOrNull($filters['status'] ?? null))
            ->sortBy($this->castToStringOrNull($filters['sort_by'] ?? null))
            ->sortOrder($this->castToStringOrNull($filters['sort_order'] ?? null));

        // クエリを実行し、ページネーションを行う
        return $query->paginate(10);
    }

    private function castToStringOrNull(mixed $value): ?string
    {
        if (is_string($value) || is_null($value)) {
            return $value;
        }
        return null;
    }
}

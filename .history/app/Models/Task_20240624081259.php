<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'id',
        'title',
        'detail',
        'deadline',
        'priority_id',
        'status_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'deadline' => 'date:Y-m-d',
    ];

    /**
     * デッドライン開始日によるフィルタリング
     *@param  Builder<Task>  $query
     */
    public function scopeStartDeadline(Builder $query, ?string $startDeadline): void
    {
        if (!is_null($startDeadline)) {
            $query->where('deadline', '>=', $startDeadline);
        }
    }

    /**
     * デッドライン終了日によるフィルタリング
     * @param  Builder<Task>  $query
     */
    public function scopeEndDeadline(Builder $query, ?string $endDeadline): void
    {
        if (!is_null($endDeadline)) {
            $query->where('deadline', '<=', $endDeadline);
        }
    }

    /**
    * キーワードによるフィルタリング
    * @param  Builder<Task>  $query
    */
    public function scopeKeyword(Builder $query, ?string $keyword): void
    {
        if (!is_null($keyword)) {
        // 全角スペースを半角に変換
            $spaceConvert = mb_convert_kana($keyword, 's');
        // 空白で区切る
            $keywords = preg_split('/[\s]+/', $spaceConvert, -1, PREG_SPLIT_NO_EMPTY);

        // $keywords が配列であることを確認
            if (is_array($keywords)) {
                $query->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->where('title', 'like', "%{$keyword}%")
                          ->orWhere('detail', 'like', "%{$keyword}%");
                    }
                });
            } else {
            }
        }
    }

    /**
     * 優先度によるフィルタリング
     * @param  Builder<Task>  $query
     */
    public function scopePriority(Builder $query, ?string $priority): void
    {
        if (!is_null($priority)) {
            $query->where('priority_id', $priority);
        }
    }

    /**
     * ステータスによるフィルタリング
     * @param  Builder<Task>  $query
     */
    public function scopeStatus(Builder $query, ?string $status): void
    {
        if (!is_null($status)) {
            $query->where('status_id', $status);
        }
    }

    /**
     * 並び順の設定
     * @param  Builder<Task>  $query
     */
    public function scopeSortBy(Builder $query, ?string $sortBy): void
    {
        if (!is_null($sortBy)) {
            switch ($sortBy) {
                case 'id':
                    $query->orderBy('id');
                    break;
                case 'priority':
                    $query->orderBy('priority_id');
                    break;
                case 'deadline':
                    $query->orderBy('deadline');
                    break;
                default:
                    $query->orderBy('id');
                    break;
            }
        }
    }

    /**
     * 並び順の方向の設定
     * @param  Builder<Task>  $query
     */
    public function scopeSortOrder(Builder $query, ?string $sortOrder, ?string $column = 'created_at'): void
    {
        if (!is_null($sortOrder)) {
            switch ($sortOrder) {
                case 'asc':
                    $query->orderBy((string)$column, 'asc');
                    break;
                case 'desc':
                    $query->orderBy((string)$column, 'desc');
                    break;
                default:
                    $query->orderBy((string)$column, 'asc');
                    break;
            }
        } else {
            $query->orderBy((string)$column, 'asc');
        }
    }
}

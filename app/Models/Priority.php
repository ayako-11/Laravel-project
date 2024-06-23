<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $table = 'priorities';

    protected $fillable = [
        'name',
        'sort_sequence',
        'created_at',
    ];

    public $timestamps = false;
}

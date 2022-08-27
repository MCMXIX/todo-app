<?php

namespace App\Services\Todo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * TodoNoteModel
 * @package App\Services\Todo\Models
 * @since 2022.08.27
 */
class TodoNoteModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'note';

    /**
     * set note relationship for todo
     * @return BelongsTo
     */
    public function todo() : BelongsTo
    {
        $this->belongsTo(TodoModel::class, 'todo_id', 'id');
    }
}

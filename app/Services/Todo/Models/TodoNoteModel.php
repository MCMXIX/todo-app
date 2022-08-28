<?php

namespace App\Services\Todo\Models;

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
     * @var array
     */
    protected $fillable = [
        'todo_id',
        'note',
        'status'
    ]; 

    /**
     * set note relationship for todo
     * @return BelongsTo
     */
    public function todo() : BelongsTo
    {
        return $this->belongsTo(TodoModel::class);
    }

    /**
     * createNote
     * @param array $aParameters
     * @return mixed
     */
    public function createNote(array $aParameters)
    {
        return $this->create($aParameters);
    }

    /**
     * updateNote
     * @param array $aParameters
     * @param int $iId
     * @return bool
     */
    public function updateNote(array $aParameters, int $iId) : bool
    {
        $mTodoNoteModel = $this->find($iId) ?? [];
        if (empty($mTodoNoteModel) === true) {
            return false;
        }

        return (bool)$mTodoNoteModel->update($aParameters);
    }

    /**
     * deleteNote
     * @param int $iId
     * @return bool
     */
    public function deleteNote(int $iId) : bool
    {
        $mTodoNoteModel = $this->find($iId) ?? [];
        if (empty($mTodoNoteModel) === true) {
            return false;
        }

        return (bool)$mTodoNoteModel->delete();
    }
}

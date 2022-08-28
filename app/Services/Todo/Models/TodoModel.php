<?php

namespace App\Services\Todo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * TodoModel
 * @package App\Services\Todo\DOMNodelist
 * @since 2022.08.27
 */
class TodoModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'todo';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'task',
        'status'
    ];

    /**
     * set todo relationship for note
     * @return HasMany
     */
    public function notes() : HasMany
    {
        return $this->hasMany(TodoNoteModel::class, 'todo_id', 'id');
    }

    /**
     * Create new todo
     * @param array $aParameters
     * @return mixed
     */
    public function createTodo(array $aParameters)
    {
        return $this->create($aParameters);
    }

    /**
     * updateTodo
     * @param array $aParameters
     * @param int $iId
     * @return bool
     */
    public function updateTodo(array $aParameters, int $iId) : bool
    {
        $mTodoModel = $this->find($iId) ?? [];
        if (empty($mTodoModel) === true) {
            return false;
        }

        return (bool)$mTodoModel->update($aParameters);
    }

    /**
     * deleteTodo
     * @param int $iId
     * @return bool
     */
    public function deleteTodo(int $iId) : bool
    {
        $mTodoModel = $this->find($iId) ?? [];
        if (empty($mTodoModel) === true) {
            return false;
        }

        return (bool)$mTodoModel->delete();
    }

    /**
     * Retrieve all todo of the current user
     * @param array $aParameters
     * @return array
     */
    public function getTodoList(array $aParameters) : array
    {
        return $this->with(['notes'])
            ->where($aParameters)
            ->get()
            ->toArray();
    }
}

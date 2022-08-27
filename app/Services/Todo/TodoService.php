<?php

namespace App\Services\Todo;

use App\Services\Todo\Models\TodoModel;

/**
 * TodoService
 * All Business logic of Todo goes here
 * @package App\Services\Todo
 * @since 2022.08.27
 */
class TodoService
{
    /**
     * @var TodoModel $oTodoModel
     */
    private $oTodoModel;

    /**
     * TodoService constructor.
     */
    public function __construct(TodoModel $oTodoModel)
    {
        $this->oTodoModel = $oTodoModel;
    }

    /**
     * createTodo
     * @param array $aParameters
     * @return array
     */
    public function createTodo(array $aParameters) : array
    {
        $aParameters['user_id'] = session()->get('user_id');
        $this->oTodoModel->createTodo($aParameters);

        return [
            'code' => 200,
            'data' => [
                'message' => 'Successfully added.'
            ]
        ];
    }

    /**
     * updateTodo
     * @param array $aParameters
     * @param int $iId
     * @return array
     */
    public function updateTodo(array $aParameters, int $iId) : array
    {
        $bResult = $this->oTodoModel->updateTodo($aParameters, $iId);
        if ($bResult === false) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'The task doesn\'t exist.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => [
                'message' => 'Task Successfully Update.'
            ]
        ];
    }

    /**
     * deleteTodo
     * @param int $iId
     * @return array
     */
    public function deleteTodo(int $iId) : array
    {
        $bResult = $this->oTodoModel->deleteTodo($iId);
        if ($bResult === false) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'Failed deleting task, please check the task id,'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => [
                'message' => 'Task Successfully Deleted.'
            ]
        ];
    }

    /**
     * getTodoList
     * @param array $aParameters
     * @return array
     */
    public function getTodoList(array $aParameters) : array
    {
        $aParameters['user_id'] = session()->get('user_id');
        
        return [
            'code' => 200,
            'data' => [
                'list' => $this->oTodoModel->getTodoList($aParameters)
            ]
        ];
    }
}

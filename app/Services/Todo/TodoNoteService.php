<?php

namespace App\Services\Todo;

use App\Services\Todo\Models\TodoNoteModel;

/**
 * TodoNoteService
 * All todo's notes business logic will go here
 * @package App\Services\Todo
 * @since 2022.08.28
 */
class TodoNoteService
{
    /**
     * @var TodoNoteModel
     */
    private $oTodoNoteModel;

    /**
     * TodoNoteService constructor.
     */
    public function __construct(TodoNoteModel $oTodoNoteModel)
    {
        $this->oTodoNoteModel = $oTodoNoteModel;
    }

    /**
     * createNote
     * @param array $aParamters
     * @return array
     */
    public function createNote(array $aParameters) : array
    {
        $this->oTodoNoteModel->createNote($aParameters);

        return [
            'code' => 200,
            'data' => [
                'message' => 'Note has been successfully added.'
            ]
        ];
    }

    /**
     * updateNote
     * @param array $aParameters
     * @param int $iId
     * @return array
     */
    public function updateNote(array $aParameters, int $iId) : array
    {
        $bResult = $this->oTodoNoteModel->updateNote($aParameters, $iId);
        if ($bResult === false) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'The note doesn\'t exist.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => [
                'message' => 'The Note has been successfully updated.'
            ]
        ];
    }

    /**
     * deleteNote
     * @param int $iId
     * @return array
     */
    public function deleteNote(int $iId) : array
    {
        $bResult = $this->oTodoNoteModel->deleteNote($iId);
        if ($bResult === false) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'Deletion failed, please check the note id if existing.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => [
                'message' => 'The note has been successfully delete.'
            ]
        ];
    }
}
<?php

namespace App\Services\Todo\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Todo\Requests\CreateNoteRequest;
use App\Services\Todo\Requests\UpdateNoteRequest;
use App\Services\Todo\TodoNoteService;
use Illuminate\Http\JsonResponse;

/**
 * TodoNoteController
 * @package App\Services\Todo\Controllers
 * @since 2022.08.28
 */
class TodoNoteController extends Controller
{
    /**
     * @var TodoNoteService
     */
    private $oTodoNoteService;

    /**
     * TodoNoteController constructor.
     */
    public function __construct(TodoNoteService $oTodoNoteService)
    {
        $this->oTodoNoteService = $oTodoNoteService;
    }

    /**
     * createNote
     * @param CreateNoteRequest $oRequest
     * @return JsonResponse
     */
    public function createNote(CreateNoteRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oTodoNoteService->createNote($oRequest->validated());
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * updateNote
     * @param UpdateNoteRequest $oRequest
     * @param $id
     * @return JsonResponse
     */
    public function updateNote(UpdateNoteRequest $oRequest, $id) : JsonResponse
    {
        $aResult = $this->oTodoNoteService->updateNote($oRequest->validated(), (int)$id);
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * deleteNote
     * @param $id
     * @return JsonResponse
     */
    public function deleteNote($id) : JsonResponse
    {
        $aResult = $this->oTodoNoteService->deleteNote((int)$id);
        return response()->json($aResult['data'], $aResult['code']);
    }
}

<?php

namespace App\Services\Todo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Todo\TodoService;
use App\Services\Todo\Requests\CreateTodoRequest;
use App\Services\Todo\Requests\UpdateTodoRequest;
use App\Services\Todo\Requests\GetTodoListRequest;
use Illuminate\Http\JsonResponse;

/**
 * TodoController
 * @package App\Services\Todo\Controllers
 * @since 2022.08.27
 */
class TodoController extends Controller
{
    /**
     * @var TodoUserService
     */
    private $oTodoService;
    
    /**
     * TodoController constructor.
     */
    public function __construct(TodoService $oTodoService)
    {
        $this->oTodoService = $oTodoService;
    }

    /**
     * createTodo
     * @param CreateTodoRequest $oRequest
     * @return JsonResponse
     */
    public function createTodo(CreateTodoRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oTodoService->createTodo($oRequest->validated());
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * updateTodo
     * @param UpdateTodoRequest $oRequest
     * @param $id
     * @return JsonResponse
     */
    public function updateTodo(UpdateTodoRequest $oRequest, $id) : JsonResponse
    {
        $aResult = $this->oTodoService->updateTodo($oRequest->validated(), (int)$id);
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * deleteTodo
     * @param $id
     * @return JsonResponse
     */
    public function deleteTodo($id) : JsonResponse
    {
        $aResult = $this->oTodoService->deleteTodo((int)$id);
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * getTodoList
     * @param GetTodoListRequest $oRequest
     * @return JsonResponse
     */
    public function getTodoList(GetTodoListRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oTodoService->getTodoList($oRequest->validated());
        return response()->json($aResult['data'], $aResult['code']);
    }
}

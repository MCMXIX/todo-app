<?php

namespace App\Services\User\Controllers;

use App\Http\Controllers\Controller;
use App\Services\User\Requests\CreateUserRequest;
use App\Services\User\Requests\LoginRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;
use App\Services\User\Requests\UpdateUserRequest;
use App\Services\User\Requests\ValidatePasswordRequest;
use Illuminate\Support\Arr;

/**
 * User management controller
 * @package App\Services\User\Controller
 * @since 2022.08.26
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    private $oUserService;

    /**
     * UserController constructor.
     * @param UserService $oUserService
     */
    public function __construct(UserService $oUserService)
    {
        $this->oUserService = $oUserService;
    }

    /**
     * createUser
     * @param CreateUserRequest $oRequest
     * @return JsonResponse
     */
    public function createUser(CreateUserRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oUserService->createUser($oRequest->validated());
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * updateUser
     * @param UpdateUserRequest $oRequest
     * @param $id
     * @return JsonResponse
     */
    public function updateUser(UpdateUserRequest $oRequest, $id) : JsonResponse
    {
        $aResult = $this->oUserService->updateUser($oRequest->validated(), (int)$id);
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * validate the password before allowing user to update
     * @param ValidatePasswordRequest $oRequest
     * @return JsonResponse
     */
    public function validatePassword(ValidatePasswordRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oUserService->validatePassword(Arr::get($oRequest->validated(), 'password'));
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * login
     * @param LoginRequest $oRequest
     * @return JsonResponse
     */
    public function login(LoginRequest $oRequest) : JsonResponse
    {
        $aResult = $this->oUserService->doLogin($oRequest->validated());
        return response()->json($aResult['data'], $aResult['code']);
    }

    /**
     * logout
     */
    public function logout()
    {
        //TODO: UPDATE REDIRECT TO LOGIN PAGE
        session()->flush();
    }
}
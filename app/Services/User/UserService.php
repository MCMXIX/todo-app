<?php

namespace App\Services\User;

use App\Services\User\Models\UserModel;
use Illuminate\Support\Arr;

/**
 * User management service
 * @package App\Services\User
 * @since 2022.08.26
 */
class UserService
{
    /**
     * @var UserModel
     */
    private $oUserModel;

    /**
     * UserService constructor.
     * @param UserModel $oUserModel
     */
    public function __construct(UserModel $oUserModel)
    {
        $this->oUserModel = $oUserModel;
    }

    /**
     * createUser
     * @param array $aParameters
     * @return array
     */
    public function createUser(array $aParameters) : array
    {
        $this->oUserModel->storeUser($aParameters);

        return [
            'code' => 200,
            'data' => [
                'message' => 'Successfully Created.'
            ]
        ];
    }

    /**
     * updateUser
     * @param array $aParameters
     * @param int $iId
     * @return array
     */
    public function updateUser(array $aParameters, int $iId) : array
    {
        $bResult = $this->oUserModel->updateUser($aParameters, $iId);
        if ($bResult === false) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'User doesn\'t exist, please check the user id.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => [
                'message' => 'Data successfully update.'
            ]
        ];
    }

    /**
     * validatePassword
     * validates the user's password before allowing to update
     * @param string $sPassword
     * @return array
     */
    public function validatePassword(string $sPassword) : array
    {
        $aUser = $this->oUserModel->getUserByUsername(session()->get('username'));
        if (Arr::first($aUser)['password'] !== $sPassword) {
            return [
                'code' => 401,
                'data' => [
                    'message' => 'Incorrect password.'
                ]
            ];
        }

        return [
            'code' => 200,
            'data' => [
                'message' => 'success'
            ]
        ];
    }

    /**
     * doLogin
     * @param array $aParameters
     * @return array
     */
    public function doLogin(array $aParameters) : array
    {
        $aUser = Arr::first($this->oUserModel->getUserByUsername($aParameters['username'])) ?? [];
        if ((empty($aUser) === true) || ($aParameters['password'] !== $aUser['password'])) {
            return [
                'code' => 404,
                'data' => [
                    'message' => 'Incorrect username or password.'
                ]
            ];
        }

        session()->put([
            'user_id'   => $aUser['id'],
            'username'  => $aUser['username'],
            'full_name' => $aUser['first_name'] . ' ' . $aUser['last_name']
        ]);

        return [
            'code' => 200,
            'data' => [
                'message' => 'Successfully logged in.'
            ]
        ];
    }
}

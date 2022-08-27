<?php

namespace App\Services\User\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

/**
 * User management model
 * @package App\Services\User\Models
 * @since 2022.08.26
 */
class UserModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'user';

    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'password'
    ];

    /**
     * setPasswordAttribute
     * encrypt the user's password
     * @param $sValue
     */
    public function setPasswordAttribute(string $sValue)
    {
        $this->attributes['password'] = Crypt::encrypt($sValue);
    }

    /**
     * getPasswordAttribute
     * decrypt the user's password
     * @param string $sValue
     * @return string
     */
    public function getPasswordAttribute(string $sValue) : string
    {
        return Crypt::decrypt($sValue);
    }

    /**
     * store newly created user
     * @param array $aParameters
     * @return mix
     */
    public function storeUser(array $aParameters)
    {
        return $this->create($aParameters);
    }

    /**
     * updateUser
     * @param array $aParameters
     * @param int $iId
     */
    public function updateUser(array $aParameters, int $iId) : bool
    {
        $mUserModel = $this->find($iId) ?? [];
        if (empty($mUserModel) === true) {
            return false;
        }

        return (bool)$mUserModel->update($aParameters);
    }

    /**
     * getUserByUsername
     * @param string $sUsername
     * @return array
     */
    public function getUserByUsername(string $sUsername) : array
    {
        return $this->where('username', $sUsername)
            ->get()
            ->toArray();
    }
}

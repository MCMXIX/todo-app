<?php

namespace App\Services\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateUserRequest
 * @package App\Service\User\Requests
 * @since 2022.08.26
 */
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
public function rules()
    {
        return [
            'first_name' => 'sometimes|required|string|min:3|max:150',
            'last_name'  => 'sometimes|required|string|min:3|max:150',
            'username'   => 'sometimes|required|string|min:6|max:60|unique:App\Services\User\Models\UserModel,username',
            'password'   => 'sometimes|required|string|min:8'
        ];
    }
}

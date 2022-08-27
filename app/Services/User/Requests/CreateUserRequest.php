<?php

namespace App\Services\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * CreateUserRequest
 * @package App\Services\User\Requests
 * @since 2022.08.26
 */
class CreateUserRequest extends FormRequest
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
            'first_name' => 'required|string|min:3|max:150',
            'last_name'  => 'required|string|min:3|max:150',
            'username'   => 'required|string|min:6|max:60|unique:App\Services\User\Models\UserModel,username',
            'password'   => 'required|string|min:8'
        ];
    }
}

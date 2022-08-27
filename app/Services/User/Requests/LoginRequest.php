<?php

namespace App\Services\User\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * LoginRequest
 * @package App\Services\User\Request
 * @since 2022.08.26
 */
class LoginRequest extends FormRequest
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
            'username' => 'required|string|min:6|max:60',
            'password' => 'required|string|min:8'
        ];
    }
}

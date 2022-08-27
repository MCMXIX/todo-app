<?php

namespace App\Services\Todo\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * CreateTodoRequest
 * Validation for creating todo
 * @package App\Services\Todo\Requests
 * @since 2022.08.27
 */
class CreateTodoRequest extends FormRequest
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
            'task' => 'required|string|min:6|max:150'
        ];
    }
}

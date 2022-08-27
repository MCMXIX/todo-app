<?php

namespace App\Services\Todo\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateTodoRequest
 * @package App\Services\Todo\Requests
 * @since 2022.08.27
 */
class UpdateTodoRequest extends FormRequest
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
            'task'   => 'sometimes|required|string|min:6|max:150',
            'status' => 'sometimes|required|in:I,T,D'
        ];
    }
}

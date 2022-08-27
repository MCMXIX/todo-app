<?php

namespace App\Services\Todo\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request validation for retrieving todo list
 * @package App\Services\Todo\Requests
 * @since 2022.08.27
 */
class GetTodoListRequest extends FormRequest
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
            'status' => 'required|in:I,T,D'
        ];
    }
}

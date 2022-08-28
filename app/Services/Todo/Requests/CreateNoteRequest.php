<?php

namespace App\Services\Todo\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * CreateNoteRequest
 * @package App\Services\Todo\Requests
 * @since 2022.08.28
 */
class CreateNoteRequest extends FormRequest
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
            'todo_id' => 'required|int',
            'note'    => 'required|string'
        ];
    }
}

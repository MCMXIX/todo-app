<?php

namespace App\Services\Todo\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * UpdateNoteRequest
 * @package App\Services\Todo\Requests
 * @since 2022.08.28
 */
class UpdateNoteRequest extends FormRequest
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
            'note'   => 'sometimes|required|string',
            'status' => 'sometimes|required|in:R,I,N'
        ];
    }
}

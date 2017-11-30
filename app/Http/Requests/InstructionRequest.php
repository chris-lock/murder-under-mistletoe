<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructionRequest extends FormRequest
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
            'act_id' => 'required|numeric',
            'character_id' => 'required|numeric',
            'copy' => 'required',
            'value' => 'required|numeric',
        ];
    }
}

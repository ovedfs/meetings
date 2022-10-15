<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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
            'place' => 'required',
            // 'date' => 'required| after:' . date('Y-m-d'),
            'date' => 'required|after:yesterday',
            'time' => 'required|date_format:H:i',
            'abogado_id' => 'required|integer',
            'arrendador_id' => 'required|integer',
            'arrendatario_id' => 'required|integer',
            'solidario_id' => 'sometimes|integer',
            'fiador_id' => 'sometimes|integer',
        ];
    }
}

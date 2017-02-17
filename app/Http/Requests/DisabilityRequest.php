<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisabilityRequest extends FormRequest
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
        $disability = $this->route('disability');

        switch ($this->method()) {
            case 'POST':
                return [
                    'disability_name'    => 'required|max:255|unique:disabilities,name',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'disability_name'    => 'required|max:255|unique:disabilities,name,' . $disability->id,
                ];
        }
    }
}

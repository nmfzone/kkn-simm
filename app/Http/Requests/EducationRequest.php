<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
        $education = $this->route('education');

        switch ($this->method()) {
            case 'POST':
                return [
                    'education_name'    => 'required|max:255|unique:education,name',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'education_name'    => 'required|max:255|unique:education,name,' . $education->id,
                ];
        }
    }
}

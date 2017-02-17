<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResidentRequest extends FormRequest
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
        $resident = $this->route('resident');

        $rules = collect([
            'name' => 'required|max:255',
            'nik' => 'required|digits_between:1,20|unique:residents',
            'gender' => 'required|in:L,P',
            'date_of_birth' => 'required|date_format:m/d/Y',
            'hometown_id' => 'required|exists:districts,id',
            'education_id' => 'required|exists:education,id',
            'job_id' => 'required|exists:jobs,id',
            'disability.*' => 'exists:disabilities,id',
        ]);

        switch ($this->method()) {
            case 'POST':
                return $rules->toArray();
            case 'PUT':
            case 'PATCH':
                return $rules->merge([
                    'nik' => 'required|digits_between:1,20|unique:residents,nik,' . $resident->id,
                ])->all();
        }
    }
}

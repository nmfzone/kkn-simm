<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvinceRequest extends FormRequest
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
        $province = $this->route('province');

        switch ($this->method()) {
            case 'POST':
                return [
                    'province_name'    => 'required|max:255|unique:provinces,name',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'province_name'    => 'required|max:255|unique:provinces,name,' . $province->id,
                ];
        }
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubDistrictRequest extends FormRequest
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
        $district_id = $this->request->get('district_id');
        $subDistrict = $this->route('subDistrict');

        switch ($this->method()) {
            case 'POST':
                return [
                    'district_id' => 'required|exists:districts,id',
                    'postal_code' => 'required|unique:sub_districts',
                    'sub_district_name' => [
                        'required',
                        'max:255',
                        Rule::unique('sub_districts', 'name')->where(function ($query) use ($district_id) {
                            $query->where('district_id', $district_id);
                        }),
                    ],
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'district_id' => 'required|exists:districts,id',
                    'postal_code' => 'required|unique:sub_districts,postal_code,' . $subDistrict->id,
                    'sub_district_name' => [
                        'required',
                        'max:255',
                        Rule::unique('sub_districts', 'name')->where(function ($query) use ($subDistrict) {
                            $query->where('district_id', $subDistrict->district_id);
                        })->ignore($subDistrict->id),
                    ],
                ];
            break;
        }
    }
}

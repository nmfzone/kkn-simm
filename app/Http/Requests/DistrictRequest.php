<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DistrictRequest extends FormRequest
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
        $province_id = $this->request->get('province_id');
        $district = $this->route('district');

        switch ($this->method()) {
            case 'POST':
                return [
                    'province_id' => 'required|exists:provinces,id',
                    'district_name' => [
                        'required',
                        'max:255',
                        Rule::unique('districts', 'name')->where(function ($query) use ($province_id) {
                            $query->where('province_id', $province_id);
                        }),
                    ],
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'province_id' => 'required|exists:provinces,id',
                    'district_name' => [
                        'required',
                        'max:255',
                        Rule::unique('districts', 'name')->where(function ($query) use ($district) {
                            $query->where('province_id', $district->province_id);
                        })->ignore($district->id),
                    ],
                ];
        }
    }
}

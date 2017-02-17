<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VillageRequest extends FormRequest
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
        $subDistrict_id = $this->request->get('sub_district_id');
        $village = $this->route('village');

        switch ($this->method()) {
            case 'POST':
                return [
                    'sub_district_id' => 'required|exists:sub_districts,id',
                    'village_name' => [
                        'required',
                        'max:255',
                        Rule::unique('villages', 'name')->where(function ($query) use ($subDistrict_id) {
                            $query->where('sub_district_id', $subDistrict_id);
                        }),
                    ],
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'sub_district_id' => 'required|exists:sub_districts,id',
                    'village_name' => [
                        'required',
                        'max:255',
                        Rule::unique('villages')->where(function ($query) use ($village) {
                            $query->where('sub_district_id', $village->sub_district_id);
                        })->ignore($village->id),
                    ],
                ];
        }
    }
}

<?php

namespace App\Http\Requests;

use App\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FamilyCardRequest extends FormRequest
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
        $familyCard = $this->route('familyCard');

        $rules = collect([
            'number' => 'required|digits_between:1,20|unique:family_cards',
            'village_id' => 'required|exists:villages,id',
            'kadus' => [
                'required',
                Rule::in(Setting::getKadus()->all()),
            ],
            'rt' => [
                'required',
                Rule::in(Setting::getRT()->all()),
            ],
            'rw' => [
                'required',
                Rule::in(Setting::getRW()->all()),
            ],
            'patriarch' => 'required|exists:residents,id',
            'family_member' => 'required|boolean',
            'family_member_id.*' => 'exists:residents,id',
        ]);

        switch ($this->method()) {
            case 'POST':
                return $rules->all();
            case 'PUT':
            case 'PATCH':
                return $rules->merge([
                    'number' => 'required|digits_between:1,20|unique:family_cards,number,' . $familyCard->id,
                ])->all();
        }
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'family_member_id.*.not_in' => 'Isian tidak boleh mengandung kepala keluarga.',
        ];
    }

    /**
     * Get the validator instance for the request.
     *
     * @return \Illuminate\Validation\Validator
     */
    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();

        $validator->sometimes('family_member_id.*', 'distinct', function($input)
        {
            return $input->family_member == 1;
        });

        $validator->sometimes('family_member_id.*', 'not_in:'. $this->request->get('patriarch'), function($input)
        {
            return $input->family_member == 1;
        });

        return $validator;
    }
}

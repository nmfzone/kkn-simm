<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
        $job = $this->route('job');

        switch ($this->method()) {
            case 'POST':
                return [
                    'job_name'    => 'required|max:255|unique:jobs,name',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'job_name'    => 'required|max:255|unique:jobs,name,' . $job->id,
                ];
        }
    }
}

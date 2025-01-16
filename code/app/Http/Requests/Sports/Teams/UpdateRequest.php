<?php

namespace App\Http\Requests\Sports\Teams;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => [
                'sometimes',
                'string',
                'required_with:full_name',
            ],
            'name' => [
                'sometimes',
                'string',
                'required_with:name',
            ],
            'conference' => [
                'nullable',
                'string'
            ],
            'division' => [
                'nullable',
                'string'
            ],
            'city' => [
                'nullable',
                'string'
            ],
            'abbreviation' => [
                'nullable',
                'string'
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(array_filter($this->all(), function ($value, $key) {
            return $this->has($key) && $value !== '';
        }, ARRAY_FILTER_USE_BOTH));
    }
}

<?php

namespace App\Http\Requests\Sports\Players;

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
            'first_name' => [
                'sometimes',
                'string',
                'required_with:first_name',
            ],
            'last_name' => [
                'sometimes',
                'string',
                'required_with:last_name',
            ],
            'position' => [
                'nullable',
                'string'
            ],
            'height' => [
                'nullable',
                'string'
            ],
            'weight' => [
                'nullable',
                'string'
            ],
            'jersey_number' => [
                'nullable',
                'integer'
            ],
            'college' => [
                'nullable',
                'string'
            ],
            'country' => [
                'nullable',
                'string'
            ],
            'draft_year' => [
                'nullable',
                'integer'
            ],
            'draft_round' => [
                'nullable',
                'integer',
                'min:1900',
                'max:' . date('Y')
            ],
            'draft_number' => [
                'nullable',
                'integer'
            ],
            'team_id' => [
                'sometimes',
                'integer',
                'exists:teams,id'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(array_filter($this->all(), function ($value, $key) {
            return $this->has($key) && $value !== '';
        }, ARRAY_FILTER_USE_BOTH));
    }
}

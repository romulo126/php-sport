<?php

namespace App\Http\Requests\Sports\Teams;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
                'required',
                'string'
            ],
            'name' => [
                'required',
                'string'
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
            'abbreviation' => [
                'nullable',
                'string'
            ],
            'team_bot_id' => [
                'nullable',
                'integer'
            ]
        ];
    }
}

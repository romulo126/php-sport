<?php

namespace App\Http\Requests\Sports\Games;

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
            'date' => [
                'sometimes',
                'date',
                'required_with:date',
            ],
            'season' => [
                'sometimes',
                'integer',
                'required_with:season',
                'max:' . date('Y')
            ],
            'status' => [
                'nullable',
                'string'
            ],
            'period' => [
                'nullable',
                'string'
            ],
            'time' => [
                'nullable',
                'string'
            ],
            'postseason' => [
                'nullable',
                'string'
            ],
            'home_team_score' => [
                'nullable',
                'string'
            ],
            'visitor_team_score' => [
                'nullable',
                'string'
            ],
            'home_team_id' => [
                'sometimes',
                'integer',
                'exists:teams,id'
            ],
            'visitor_team_id' => [
                'sometimes',
                'integer',
                'exists:teams,id'
            ],
        ];
    }
}

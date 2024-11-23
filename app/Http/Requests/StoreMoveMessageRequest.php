<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMoveMessageRequest extends FormRequest
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
            'recipient' => 'required|min:3|max:60',
            'movie_id' => 'required|integer|exists:movies,id',
            'message' => 'required|string|min:4|max:999',
            'movie_reaction_id' => 'required|integer|exists:movie_reactions,id',
            'show_sender' => 'nullable'
        ];
    }
}

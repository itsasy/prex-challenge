<?php

namespace Src\Adapters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchGifsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'query' => 'required|string|min:2|max:100',
            'limit' => 'nullable|integer|min:1|max:100',
            'offset' => 'nullable|integer|min:0',
        ];
    }

}

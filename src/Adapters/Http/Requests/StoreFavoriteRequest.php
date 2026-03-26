<?php

namespace Src\Adapters\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFavoriteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'gif_id' => 'required|string',
            'alias' => 'nullable|string|max:255',
        ];
    }
}

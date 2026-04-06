<?php

namespace App\Http\Requests\Production;

use Illuminate\Foundation\Http\FormRequest;

class MachineLaborRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // TODO: Add validation rules
        ];
    }
}

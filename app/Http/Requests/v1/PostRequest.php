<?php

namespace App\Http\Requests\v1;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:250'],
            'description' => ['min:500', 'max:1000'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }
}

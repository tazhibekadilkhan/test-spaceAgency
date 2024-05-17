<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content' => ['required', 'string', 'min:3', 'max:255'],
            'comment_id' => ['exists:comments,id'],
            'user_id' => [],
        ];
    }
}

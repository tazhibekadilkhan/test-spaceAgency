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
            'name' => ['required'],
            'description' => [''],
            'user_id' => [''],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

//    protected function passedValidation()
//    {
//        $data = $this->validator->getData();
//        $this->validator->setData(['user_id' => Auth::id()] + $data);
//    }
}

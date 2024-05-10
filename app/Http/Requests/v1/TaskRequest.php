<?php

namespace App\Http\Requests\v1;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TaskRequest extends FormRequest
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
            'deadline' => ['', 'date_format:d.m.Y'],
            'priority_id' => ['required', 'exists:priorities,id'],
            'status_id' => ['required', 'exists:statuses,id'],
        ];
    }

    protected function passedValidation()
    {
        $data = $this->validator->getData();
        $this->validator->setData([
                'deadline' => Carbon::parse($this->request->get('deadline'))->format('Y-m-d'),
                'user_id' => Auth::id()
            ] + $data);
    }
}

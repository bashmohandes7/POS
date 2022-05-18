<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function onCreate()
    {
        return [
            'name' => ['required', 'string', 'max:191', 'min:2'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required','min:6','confirmed'],
            'permissions'=> ['required', 'array', 'min:1'],
            'image' => ['image', 'mimes:jpeg,png,jpg']
        ];
    } // end of create
    protected function onUpdate()
    {
        return [
            'name' => ['sometimes', 'nullable', 'string', 'max:191', 'min:2'],
            'email' => 'sometimes|nullable|email|string|max:191'.request()->user()->id,
            'permissions' => ['sometimes', 'nullable', 'array', 'min:1'],
            'image' => ['image', 'mimes:jpeg,png,jpg']
        ];
    } // end of update

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return request()->isMethod('PUT') || request()->isMethod('PATCH') ?
            $this->onUpdate() : $this->onCreate();
    }// end of rules
}

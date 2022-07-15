<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'products' => 'required|array',
        ];
    }

    protected function onUpdate()
    {
        return [
            'products' =>'required|array'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
       return request()->isMethod('PUT') || request()->isMethod('PATCH') ?
           $this->onUpdate() : $this->onCreate();
    }
}

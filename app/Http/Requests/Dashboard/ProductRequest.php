<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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

    public function onCreate()
    {
        $rules = ['category_id' => 'required'];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => 'required|unique:product_translations,name'];
            $rules += [$locale . '.description' => 'required'];
        } // end of for each
        $rules += [
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'stock' =>'required'
        ];
        return $rules;
    } // end of onCreate

    public function onUpdate()
    {
        $rules = ['category_id' => 'required'];
        foreach (config('translatable.locales') as $locale) {

            $rules += [
                $locale . '.name' =>
                [
                    'required',
                    Rule::unique('product_translations', 'name')->ignore(request()->product_id, 'product_id')
                ]

            ];


        }//end of for each

        $rules +=[
                $locale . '.description' => 'required',
                 'purchase_price'=>'required',
                  'sale_price'=>'required',
                   'stock'=>'required'
            ];
        return $rules;
    } // end of onUpdate

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

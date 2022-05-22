<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules = [];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required', Rule::unique('category_translations', 'name')]];

        }//end of for each

        return $rules;

    } // end of on create

    protected function onUpdate()
    {
        $rules = [];
        foreach (config('translatable.locales') as $locale) {

            $rules += [
                $locale . '.name' => [
                    'required',
                    Rule::unique('category_translations', 'name')->ignore(request()->route('id'))
                ]
            ];

        }//end of for each
        return $rules;
    } // end of on update

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

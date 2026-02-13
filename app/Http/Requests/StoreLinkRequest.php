<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLinkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3',
            'url' => [
                'required',
                'url',
                'unique:links,url,NULL,id,user_id,' . auth()->id()
            ],
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array'
        ];
    }

     public function messages(): array
    {
        return [
            'title.required' => ' le titre important',
            'url.required' => ' lien imprt',
            'url.url' => '  lien refuse',
            'url.unique' => '    le lien deja ext',
            'category_id.required' => '  il faut choisir une category ',
        ];
    }
}

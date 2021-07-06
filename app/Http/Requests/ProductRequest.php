<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function rules()
    {
        $uniqueName = Rule::unique('products', 'name');

        if($product = $this->route('product'))
            $uniqueName->ignoreModel($product);

        return [
            'name' => [
                'required',
                'string',
                'max:110',
                $uniqueName
            ],
            'description' => ['required', 'string']
        ];
    }
}

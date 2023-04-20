<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SorteioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required'
        ];
    }

    public function attributes()
    {
        return  [
            'name' => 'Nome'
        ];
    }
}

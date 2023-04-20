<?php

namespace App\Http\Requests;

use App\Models\Pessoa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class PessoaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
        ];
    }

    public function attributes()
    {
        return  [
            'name' => 'Nome',
            'email' => 'Email'
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (Pessoa::where('sorteio_id', $validator->getData()['sorteio_id'])->where(DB::raw("LOWER(email)"), strtolower($validator->getData()['email']))->first() && !isset($validator->getData()['id'])){
                $validator->errors()->add('email', "Email ja cadastrado.");
            }
        });
    }

}

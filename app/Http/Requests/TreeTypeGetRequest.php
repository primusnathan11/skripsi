<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreeTypeGetRequest extends FormRequest
{
    public function rules()
    {
        return [
            'page' => [
                'required',
                'numeric'
            ],
            'limit' => [
                'required',
                'numeric'
            ]
        ];
    }

    public function messages(){
        return [
            'page.required'  => 'Page wajib diisi',
            'page.numeric'   => 'Page wajib bertipe angka',
            'limit.required' => 'Limit wajib diisi',
            'limit.numeric'  => 'Limit wajib bertipe angka'
        ];
    }
}

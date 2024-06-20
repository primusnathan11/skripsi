<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreeTypeUpdateRequest extends FormRequest
{

    public function rules()
    {
        return [
            'id' => [
                'required',
                'numeric',
                'exists:tree_types,id'
            ],
            'name' => [
                'required'
            ],
            'partner_id' => [
                'required',
                'numeric',
                'exists:partners,id'
            ],
            'description' => [
                'required'
            ],
            'sequestration' => [
                'required',
                'numeric'
            ]
        ];
    }

    public function messages(){
        return [
            'id.required'               => 'ID wajib diisi',
            'id.numeric'                => 'ID wajib bertipe angka',
            'id.exists'                 => 'ID tidak terdaftar',
            'partner_id.required'       => 'Id partner wajib diisi',
            'partner_id.numeric'        => 'Id partner wajib bertipe angka',
            'partner_id.exists'         => 'Id partner tidak terdaftar',
            'description.required'      => 'Deskripsi wajib diisi',
            'sequestration.required'    => 'Penyerapan wajib diisi',
            'sequestration.numeric'     => 'Penyerapan wajib bertipe angka'
        ];
    }
}

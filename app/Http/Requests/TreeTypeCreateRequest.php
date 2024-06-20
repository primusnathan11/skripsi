<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreeTypeCreateRequest extends FormRequest
{

    public function rules(){
        return [
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
            'name.required'             => 'Nama tipe pohon wajib diisi',
            'partner_id.required'       => 'Id partner wajib diisi',
            'partner_id.numeric'        => 'Id partner wajib bertipe angka',
            'partner_id.exists'         => 'Id partner tidak terdaftar',
            'description.required'      => 'Deskripsi wajib diisi',
            'sequestration.required'    => 'Penyerapan wajib diisi',
            'sequestration.numeric'     => 'Penyerapan wajib bertipe angka'
        ];
    }
}

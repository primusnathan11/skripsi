<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreeCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'tree_type' => [
                'required',
                'numeric',
                'exists:tree_types,id'
            ],
            'code' => [
                'required',
                'unique:trees,code'
            ],
            'description' => [
                'nullable'
            ],
            'planting_date' => [
                'required',
                'date'
            ],
            'image' => [
                'required',
                'url'
            ],
            'longitude' => [
                'required'
            ],
            'latitude' => [
                'required'
            ],
            'production' => [
                'nullable'
            ]
        ];
    }

    public function messages(){
        return [
            'tree_type.required'     => 'Tipe pohon wajib diisi',
            'tree_type.numeric'      => 'Tipe pohon wajib bertipe angka',
            'tree_type.exists'       => 'Tipe pohon tidak terdaftar',
            'code.required'          => 'Kode pohon wajib diisi', 
            'code.unique'            => 'Kode pohon telah terdaftar',
            'planting_date.required' => 'Tanggal penanaman wajib diisi',
            'planting_date.date'     => 'Tanggal penanaman wajib format tanggal',
            'image.required'         => 'Gambar pohon wajib diisipohon',
            'image.url'              => 'Gambar pohon wajib format link url',
            'longitude.required'     => 'Longitude wajib diisi',
            'latitude.required'      => 'Latitude wajib diisi'
        ];
    }
}

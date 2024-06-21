<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreeUpImageRequest extends FormRequest
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
            'img' => [
                'required',
                'image',
                'max:1024'
            ]
        ];
    }

    public function messages(){
        return [
            'img.required' => "File wajib diisi",
            'img.image'    => "File harus bertipe gambar (jpg, jpeg, png, bmp, gif, svg, or webp)",
            'img.max'      => "File harus dibawah 1MB"
        ];
    }
}

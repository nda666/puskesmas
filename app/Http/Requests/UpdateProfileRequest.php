<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|between:5,30',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
        ];
    }
}

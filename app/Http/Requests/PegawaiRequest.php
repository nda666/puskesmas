<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PegawaiRequest extends Request
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
            'foto' => 'max:300|mimes:jpeg,bmp,png',
            'agama' => 'required',
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jabatan' => 'required|in:Konsultan,Administrasi,Apoteker',
            'no_telp' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'password' => 'required|confirmed',
        ];
    }
}

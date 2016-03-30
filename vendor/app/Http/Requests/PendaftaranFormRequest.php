<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (! Auth::guard('pegawai')->check()){
            return false;
        }
        $jabatan = Auth::guard('pegawai')->user()->jabatan;
        if ($jabatan == 'Administrasi'){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|min:3|max:50',
            'kepala_keluarga' => 'required|min:3|max:50',
            'pekerjaan' => 'required|min:3|max:50',
            'alamat' => 'required|max:255',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_kartu_keluarga' => 'required|between:10,30',
            'jenis_kepesertaan' => 'required_if:daftar_rawat_jalan,check' 
        ];
    }
}

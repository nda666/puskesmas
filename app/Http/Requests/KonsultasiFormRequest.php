<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class KonsultasiFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $jabatan = auth()->guard('pegawai')->user()->jabatan;
        if ($jabatan == 'Administrasi' || $jabatan == 'Konsultan'){
            return true;
        }
        return false;
    }

    public function messages(){
        return ['poli_id.required' => 'Field poli harus di isi'];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pemeriksaan_fisik' => 'required|min:3',
            'diagnosa' => 'required|min:3',
            'poli_id' => 'required',
            'kasus' => 'required'
        ];
    }
}

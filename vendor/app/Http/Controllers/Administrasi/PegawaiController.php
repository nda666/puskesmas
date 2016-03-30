<?php

namespace App\Http\Controllers\Administrasi;

use Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\PegawaiRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PegawaiController extends Controller
{
    /**
     * [getIndex description]
     * @return [type] [description]
     */
    public function getIndex()
    {
        return view('administrasi.pegawai.index',['active'=>'management','active_item' =>'pegawai']);
    }

    /**
     * @param Request $request
     */
    public function postCreate(PegawaiRequest $request)
    {
        $update                               = false;
        ($request->get('id') == '') ? $update = false : $update = true;
        $input                                = array_except($request->all(), ['_token', 'password_confirmation', 'foto']);
        if ($update) {
            return ($this->update($input)) ? response()->json(['response' => true, 'message' => 'Sukses mengubah data pegawai!']) : response()->json(['response' => false, 'message' => 'Terjadi kesalahan pada database, gagal mengubah data pegawai!']);
        }
        $input              = array_except($input, ['_token', 'password_confirmation', 'id']);
        $input['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['tgl_lahir'])->format('Y-m-d');
        $input['password']  = bcrypt($input['password']);

        if($request->file('foto')){
            $path     = base_path('public/foto-profil/');
            $new_name = str_random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
            while (\File::exists($path . $new_name)) {
                $new_name = str_random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
            }
            $request->file('foto')->move($path, $new_name);
            $input['foto'] = '/foto-profil/' . $new_name;
        }

        return (\App\Pegawai::create($input)) ? response()->json(['response' => true, 'message' => 'Sukses menambah data pegawai!']) : response()->json(['response' => false, 'message' => 'Terjadi kesalahan pada database, gagal menambah data pegawai!']);
    }

    /**
     * @param  $input
     * @return mixed
     */
    protected function update($input)
    {
        $input['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['tgl_lahir'])->format('Y-m-d');
        $input['password']  = bcrypt($input['password']);
        $result = false;

        return \App\Pegawai::find($input['id'])->update(array_except($input, ['id']));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getData_pegawai(Request $request)
    {
        $pegawai = \App\Pegawai::select('*')->whereNotIn('jabatan', ['Dokter']);

        return Datatables::of($pegawai)
            ->editColumn('tgl_lahir', function ($pegawai) {
                $date = \Date::parse($pegawai->tgl_lahir)->format('d-m-Y');
                return $date;
            })
            ->addColumn('action', function($pegawai){
                 return '<div class="ui small  group buttons"><a data-content="Lihat Detail" class="ui primary icon small button view-btn" data-id="'. $pegawai->id .'"><i class="eye icon"></i></a><a data-content="Ubah Data Pasien" class="ui orange icon small button edit-btn" data-id="'. $pegawai->id .'"><i class="edit icon"></i></a></div>';
            })
            ->make(true);
    }

    /**
     * @param Request $request
     */
    public function postDelete(Request $request)
    {
        try {
            return (\App\Pegawai::whereIn('id', $request->get('id'))->delete()) ? response()->json(['response' => true, 'message' => 'Berhasil menghapus data Pegawai']) : response()->json(['response' => false, 'message' => 'Gagal menghapus data Pegawai']);
        } catch (QueryException $e) {
            return response()->json(['response' => false, 'message' => 'Gagal menghapus data Pegawai<br>' . $e->getMessage]);
        }

    }

    /**
     * @param Request $request
     */
    public function getData_pegawai_detail(Request $request)
    {
        $pegawai = \App\Pegawai::findOrFail($request->get('id'));
        $data    = [
            'tgl_lahir'     => $pegawai->tgl_lahir->format('d-m-Y'),
            'username'      => $pegawai->username,
            'nama'          => $pegawai->nama,
            'agama'         => $pegawai->agama,
            'jabatan'       => $pegawai->jabatan,
            'no_telp'       => $pegawai->no_telp,
            'jenis_kelamin' => $pegawai->jenis_kelamin,
            'alamat'        => $pegawai->alamat,
            'id'            => $pegawai->id,
        ];

        return response()->json($data);
    }
}

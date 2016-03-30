<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Requests\DokterRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Yajra\Datatables\Datatables;

class DokterController extends Controller
{
    /**
     * Index Page Halaman "/administrasi/dokter"
     *
     * @method getIndex
     * @return \Response
     */
    public function getIndex()
    {
        return view('administrasi.dokter.index',['active'=>'management','active_item' =>'dokter']);
    }

    /**
     * Data Index Datatables
     *
     * @method getData_index
     * @param  Request       $request
     * @return \Response
     */
    public function getData_index(Request $request)
    {
        $dokter = \App\Dokter::where('jabatan', 'Dokter')->join('pegawai', 'pegawai.id', '=', 'dokter.pegawai_id')->join('poli', 'poli.id', '=', 'dokter.poli_id')->select('pegawai.*', 'poli.nama as nama_poli');
        $datatables = Datatables::of($dokter);
        $datatables->addColumn('action', function($dokter){
             return '<div class="ui small  group buttons"><a data-content="Lihat Detail" class="ui primary icon small button view-btn" data-id="'. $dokter->id .'"><i class="eye icon"></i></a><a data-content="Ubah Data Pasien" class="ui orange icon small button edit-btn" data-id="'. $dokter->id .'"><i class="edit icon"></i></a></div>';
        });
        return $datatables->make(true);
    }

    /**
     * Post Data Buat Baru / Update Apabila id != ''
     *
     * @method postCreate
     * @param  DokterRequest $request
     * @return \Response
     */
    public function postCreate(DokterRequest $request)
    {
        $input = array_except($request->all(), ['_token', 'password_confirmation']);
        $input['jabatan'] = 'Dokter';
        $input['password'] = bcrypt($input['password']);
        $input['tgl_lahir'] = \Date::createFromFormat('d-m-Y', $input['tgl_lahir'])->format('Y-m-d');
        if (isset($input['id']) && trim($input['id'] != '')) {
            return response()->json($this->update($input));
        }

        return response()->json($this->dokter_trans($input));
    }

    /**
     * Transaksi Update Database Pegawai dan Dokter
     *
     * @method update
     * @param  array $input
     * @return array
     */
    protected function update($input = [])
    {
        \DB::beginTransaction();
        $input['jabatan'] = 'Dokter';
        try {
            \App\Pegawai::where('id', $input['id'])->update(array_except($input, ['id', 'poli_id']));
        } catch (QueryException $e) {
            \DB::rollBack();

            return ['response' => false, 'message' => $e->getMessage()];
        }

        try {
            \App\Dokter::where('pegawai_id', $input['id'])->update(['poli_id' => $input['poli_id']]);
        } catch (QueryException $e) {
            \DB::rollBack();

            return ['response' => false, 'message' => $e->getMessage()];
        }
        \DB::commit();

        return ['response' => true, 'message' => 'Berhasil mengubah data Dokter'];
    }

    /**
     * Transaksi Create Database Pegawai & Dokter
     *
     * @method create
     * @param  array       $input [description]
     * @return array              [description]
     */
    protected function create($input = [])
    {
        \DB::beginTransaction();
        $dokter = [];
        try {
            $dokter = \App\Pegawai::create(array_except($input, ['poli_id']));
        } catch (QueryException $e) {
            \DB::rollBack();

            return ['response' => false, 'message' => $e->getMessage()];
        }

        try {
            \App\Dokter::create(['poli_id' => $input['poli_id'], 'pegawai_id' => $dokter->id]);
        } catch (QueryException $e) {
            \DB::rollBack();

            return ['response' => false, 'message' => $e->getMessage()];
        }
        \DB::commit();

        return ['response' => true, 'message' => 'Sukses menambah data Dokter'];
    }

    /**
     * JSON data poli, #dropdown-poli-id
     *
     * @method getData_poli
     * @param  Request      $request
     * @return \Request JSON
     */
    public function getData_poli(Request $request)
    {
        $data = \App\Poli::Query();
        $data->select('id', 'nama');
        if (trim($request->get('find')) != '') {
            $data->where('id', $request->get('find'));
            $data->orWhere('nama', 'like', $request->get('find').'%');
        }
        $result = [];
        foreach ($data->get() as $key => $value) {
            $result[] = ['value' => $value->id, 'name' => $value->nama];
        }

        return response()->json(['success' => true, 'results' => $result]);
    }

    /**
     * Get Detail Data Dokter
     *
     * @method getDokter_detail
     * @param  Request          $request [description]
     * @return \Response
     */
    public function getDokter_detail(Request $request)
    {
        $dokter = \App\Dokter::where('dokter.pegawai_id', $request->get('id'))->where('pegawai.jabatan', 'Dokter')->join('pegawai', 'pegawai.id', '=', 'dokter.pegawai_id')->select('pegawai.*', 'dokter.poli_id')->get();
        $dokter_res = [];
        foreach ($dokter as $key => $value) {
            $dokter_res['id'] = $value->id;
            $dokter_res['nama'] = $value->nama;
            $dokter_res['username'] = $value->username;
            $dokter_res['poli_id'] = $value->poli_id;
            $dokter_res['jenis_kelamin'] = $value->jenis_kelamin;
            $dokter_res['no_telp'] = $value->no_telp;
            $dokter_res['alamat'] = $value->alamat;
            $dokter_res['agama'] = $value->agama;
            $dokter_res['tgl_lahir'] = \Date::createFromFormat('Y-m-d', $value->tgl_lahir)->format('d-m-Y');
        }

        return response()->json($dokter_res);
    }
}

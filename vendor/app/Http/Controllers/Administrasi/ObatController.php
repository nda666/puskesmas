<?php

namespace App\Http\Controllers\Administrasi;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ObatController extends Controller
{
    /**
     * Halaman index /administrasi/obat
     * @method getIndex
     * @return \Response
     */
    public function getIndex(){
        return view('administrasi.obat.index',['active'=>'management','active_item' =>'obat']);
    }

    /**
     * [getData_index description]
     * @method getData_index
     * @param  Request       $request [description]
     * @return \Response
     */
    public function getData_index(Request $request){
        $obat = \App\Obat::select('id','kode', 'nama');
        $datatables = \Datatables::of($obat);
        $datatables->addColumn('action', function($obat){
            return '<div class="ui small  group buttons"><a title="Ubah Data" data-content="Ubah Data Pasien" class="ui orange icon small button edit-btn" data-id="'. $obat->id .'"><i class="edit icon"></i></a><a title="Hapus Data" data-content="Hapus Data Pasien" class="ui negative icon small button delete-btn" data-id="'. $obat->id .'"><i class="trash icon"></i></a></div>';
        });

        return $datatables->make(true);
    }

    /**
     * Create / Update Obat
     *
     * @method postCreate
     * @param  Request    $request
     * @return \Response JSON
     */
    public function postCreate(Request $request){
        try {
            $obat = \App\Obat::findOrNew($request->get('id'));
            $obat->kode = $request->get('kode');
            $obat->nama = $request->get('nama');
            return ($obat->save()) ? response()->json(['response' => true, 'message' =>'Berhasil menyimpan data Obat']):response()->json(['response' => false, 'message' =>'Terjadi kesalahan, gagal menyimpan data Obat']);
        } catch (QueryException $e) {
            return response()->json(['response' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Hapus data obat
     * @method postDelete
     * @param  Request    $request
     * @return \Response JSON
     */
    public function postDelete(Request $request){
        try {
            return (\App\Obat::whereIn('id', $request->get('id'))->delete()) ? response()->json(['response' => true, 'message' => 'Data Obat berhasil dihapus']) : response()->json(['response' => true, 'message' => 'Terjadi Kesalahan, Data Obat gagal dihapus']);
        } catch (QueryException $e) {
            return response()->json(['response' => true, 'message' => $e->getMessage()]);
        }
    }
}

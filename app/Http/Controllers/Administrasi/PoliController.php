<?php

namespace App\Http\Controllers\Administrasi;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PoliController extends Controller
{
    public function __construct(){

    }

    /**
     * Halaman index /administrasi/dokter
     *
     * @method getIndex
     * @return \Response
     */
    public function getIndex(){
        return view('administrasi.poli.index',['active'=>'management','active_item' =>'poli']);
    }

    /**
     * Data index "Datatables"
     * @method getData_index
     * @return \Response JSON
     */
    public function getData_index(){
        $poli = \App\Poli::select('id', 'nama');
        $datatables = \Datatables::of($poli);
        $datatables->addColumn('action', function($poli){
            return '<div class="ui small  group buttons"><a data-content="Ubah Data Pasien" class="ui orange icon small button edit-btn" data-id="'. $poli->id .'"><i class="edit icon"></i></a><a data-content="Hapus Data Pasien" class="ui negative icon small button delete-btn" data-id="'. $poli->id .'"><i class="trash icon"></i></a></div>';
        });
        return $datatables->make(true);
    }

    /**
     * Buat baru / Ubah data poli berikan error apabila ingin
     * mengubah nama default Poli
     *
     * @method postCreate
     * @param  Request    $request
     * @return \Response
     */
    public function postCreate(Request $request){
        try {
            $poli = \App\Poli::findOrNew($request->get('id'));
            if ($poli->id >= 1 && $poli->id <= 3){
                return response()->json(['response' => false, 'message' => 'Anda tidak dapat mengubah nama Poli: '. $poli->nama]);
            }
            $poli->nama = $request->get('nama');
            return ($poli->save()) ? response()->json(['response' => true, 'message' => 'Berhasil menyimpan data Poli']) : response()->json(['response' => false, 'message' => 'Gagal menyimpan data Poli']);
        } catch (QueryException $e) {
            return response()->json(['response' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
    * Hapus data poli, berikan error apabila ingin
    * mengubah nama default Poli
    *
    * @method postCreate
    * @param  Request    $request
    * @return \Response
    */
    public function postDelete(Request $request){
        try {
            $id = $request->get('id');
            $poli = \App\Poli::whereIn('id', $id);
            foreach ($poli->get() as $key => $value) {
                if ($value->id > 0 && $value->id <= 3){
                    return response()->json(['response' => false, 'message' => 'Anda tidak dapat menghapus Poli: '. $value->nama]);
                }
            }
            return ($poli->delete()) ? response()->json(['response' => true, 'message' => 'Berhasil menghapus data Poli']) : response()->json(['response' => false, 'message' => 'Gagal menghapus data Poli, coba refresh kembali tabel List Poli']);
        } catch (QueryException $e) {
            return response()->json(['response' => false, 'message' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Http\Requests\PendaftaranFormRequest;
use App\Http\Requests\RawatJalanFormRequest;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Halaman index /administrasi/rawat-jalan
     * @method getIndex
     * @return \View
     */
    public function getIndex()
    {
        return view('administrasi.pendaftaran.rawat_jalan', ['active' => 'pendaftaran']);
    }

   /**
    * @param Request $request
    */
   public function postSimpan_pendaftaran(PendaftaranFormRequest $request)
   {
       $input              = array_except($request->all(), ['id', '_token']);
       $input['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['tgl_lahir'])->format('Y-m-d');

       if ($request->get('daftar_rawat_jalan') == 'check') {
           $input = array_except($input, ['daftar_rawat_jalan']);

           return response()->json($this->transaksi_daftar($input));
       }
       $input = array_except($input, ['daftar_rawat_jalan', 'jenis_kepesertaan']);
       try {
           $pendaftaran = \App\Pasien::create($input);

           return response()->json(['response' => true, 'message' => '<b>ID:</b>'.$pendaftaran->id.'<br><b>Nama:</b>'.$pendaftaran->nama.'<br>Sudah terdaftar sebagai anggota baru']);
       } catch (\Illuminate\Database\QueryException $e) {
           return response()->json(['response' => false, 'message' => $e->errorInfo[2]]);
       }
   }

  /**
   * @param Request $request
   */
  public function postUbah_data_pasien(PendaftaranFormRequest $request)
  {
      $data = array_except($request->all(), ['id', '_token']);
      try {
          $pasien = \App\Pasien::where('id', $request->get('id'))->update($data);
          return response()->json(['response' => true, 'message' => '<b>ID:</b> '.$request->get('id').'<br>Berhasil diubah',
     ]);
      } catch (\Illuminate\Database\QueryException $e) {
          return response()->json(['response' => false, 'message' => $e->errorInfo[2]]);
      }
  }

   /**
    * @param RawatJalanFormRequest $request
    */
   public function postDaftar_rawat_jalan(RawatJalanFormRequest $request)
   {
       $input['kepesertaan'] = $request->get('kepesertaan');
       $input['pasien_id']   = $request->get('pasien_id');
       $input['kunjungan']   = (\App\RawatJalan::where('pasien_id', $input['pasien_id'])->count() > 0) ? 'Lama' : 'Baru';
       $input['pegawai_id']  = auth()->guard('pegawai')->user()->id;
       try {
           \App\RawatJalan::create($input);
       } catch (\Illuminate\Database\QueryException $e) {
           return response()->json(['response' => false, 'message' => $e->errorInfo[2]]);
       }

       return response()->json(['response' => true, 'message' => '<b>ID:</b> '.$request->get('pasien_id').'<br>Nama: '.$request->get('nama').'<br>Berhasil didaftarkan untuk Rawat Jalan.']);
   }

   /**
    * Transaksi insert Pasien Baru + Daftarkan rawat jalan.
    * @param $data
    * @return array   [Response, Message]
    */
   protected function transaksi_daftar($data)
   {
       $kepesertaan = $data['jenis_kepesertaan'];
       $data        = array_except($data, ['jenis_kepesertaan']);
       \DB::beginTransaction();
       try {
           $pasien = \App\Pasien::create($data);
       } catch (\Illuminate\Database\QueryException $e) {
           \DB::rollBack();

           return ['response' => false, 'message' => $e->errorInfo[2]];
       }
       try {
           $rawat_jalan = \App\RawatJalan::create(['pasien_id' => $pasien->id, 'progress' => 'Konsultasi', 'kunjungan' => 'Baru', 'kepesertaan' => $kepesertaan, 'pegawai_id' => auth()->guard('pegawai')->user()->id]);
       } catch (\Illuminate\Database\QueryException $e) {
           \DB::rollBack();

           return ['response' => false, 'message' => $e->errorInfo[2]];
       }
       \DB::commit();

       return ['response' => true, 'message' => 'Pendafataran Baru dan Pendaftaran Rawat Jalan Berhasil<br><b>'.$data['nama'].'</b> bisa masuk ruang konsultasi sekarang.'];
   }

   /**
    * @param Request $request
    * @return type [description]
    */
   public function getList_pasien(Request $request)
   {
       $request->ajax() || abort(404);
       $anggota    = \App\Pasien::select('*');
       $datatables = app('datatables')->of($anggota);
       $datatables->filter(function ($query) use ($request) {
         $get = $request->get('columns');
         $search = $request->get('search');
         if (trim($search['value']) != '') {
             $query->where('id', '=', $search['value']);
             $query->orWhere('nama', 'like', $search['value'].'%');
         }
         if (isset($get[5]['search']['value']) && str_contains($get[5]['search']['value'], '-yadcf_delim-')) {
             $tgl_lahir = explode('-yadcf_delim-', $get[5]['search']['value']);
             $query->where('tgl_lahir', '>=', $tgl_lahir[0]);
             $query->where('tgl_lahir', '<=', $tgl_lahir[1]);
         }
         if (isset($get[0]['search']['value']) && trim($get[0]['search']['value']) != '') {
             $query->where('id', 'like', $get[0]['search']['value'].'%');
         }
      });
      $datatables->addColumn('action', function($anggota){
          return '<div class="ui small  group buttons"><a data-content="Lihat Detail" class="ui primary icon small button view-btn" data-id="'. $anggota->id .'"><i class="eye icon"></i></a><a data-content="Daftarkan Rawat Jalan" class="ui icon small positive button daftarkan-btn" data-id="'. $anggota->id .'"><i class="treatment icon"></i></a><a data-content="Ubah Data Pasien" class="ui orange icon small button edit-btn" data-id="'. $anggota->id .'"><i class="edit icon"></i></a><a data-content="Hapus Data Pasien" class="ui negative icon small button delete-btn" data-id="'. $anggota->id .'"><i class="trash icon"></i></a></div>';
      });
       $datatables->editColumn('tgl_lahir', function ($anggota) {
         return \Jenssegers\Date\Date::parse($anggota->tgl_lahir)->format('d-m-Y');
      });

       return $datatables->make(true);
   }

   /**
    * Ged Data Pasien
    * @method getData_pasien
    * @param  Request       $request
    * @param  mixed         $id
    */
   public function getData_pasien(Request $request, $id)
   {
       $data = \App\Pasien::where('id', $id)->select('id', 'nama',
         'kepala_keluarga', 'no_kartu_keluarga',
         'pekerjaan', 'alamat', 'tgl_lahir', 'jenis_kelamin', 'agama')->get();

       return response()->json($data);
   }

   public function postDelete_pasien(Request $request){
       return (\App\Pasien::whereIn('id', $request->get('id'))->delete()) ? response()->json(['response' => true, 'message' => 'Berhasil menghapus Pasien']) : response()->json(['response' => false, 'message' => 'Gagal menghapus Pasien']);
   }

   public function getFilter_data(Request $request){
       $col = $request->get('col');
       $val = $request->get('data');
       $data = \App\Pasien::where($col,'like', '%'. $val['term'] .'%')->lists('nama');
       return response()->json(['result' => $data]);
   }
}

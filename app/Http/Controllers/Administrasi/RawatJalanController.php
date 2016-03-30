<?php

namespace App\Http\Controllers\Administrasi;
use App\Http\Controllers\Controller;
use App\Http\Requests\TindakanRequest;
use App\Http\Requests\ResepPasienRequest;
use App\Http\Requests\KonsultasiFormRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class RawatJalanController extends Controller
{
    /**
     * @var mixed
     */
    protected $pegawai;

    public function __construct()
    {
        $this->pegawai = auth()->guard('pegawai')->user();
    }

    /**
     * Halaman index administrasi/rawat-jalan.
     *
     * @method getIndex
     * @return \Response
     */
    public function getIndex()
    {
        return view('administrasi.rawat-jalan.index',['active'=>'rawat-jalan']);
    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function getData_index(Request $request)
    {
        $rjalan = \App\RawatJalan::where('progres', 0);
        $rjalan->join('pasien', 'pasien.id', '=', 'rawat_jalan.pasien_id');
        $rjalan->select('pasien.*', 'rawat_jalan.id as id_rjalan', 'rawat_jalan.created_at as tgl_daftar', \DB::raw('DATE_FORMAT(`rawat_jalan`.`created_at`, "%H:%i") as jam'));
        $datatables = Datatables::of($rjalan);
        $datatables->filter(function ($query) use ($request) {
            $search = $request->get('search');
            $get    = $request->get('columns');
            if (trim($search['value']) != '') {
                $query->where('pasien.id', '=', $search['value']);
                $query->orWhere('rawat_jalan.id', '=', $search['value']);
                $query->orWhere('pasien.nama', 'like', $search['value'] . '%');
            }
            if (isset($get[4]['search']['value']) && str_contains($get[4]['search']['value'], '-yadcf_delim-')) {
                $created_at = explode('-yadcf_delim-', $get[4]['search']['value']);
                if (isset($created_at[0]) && $created_at[0] != '') {
                    $query->where('rawat_jalan.created_at', '>=', $created_at[0]);
                }
                if (isset($created_at[1]) && $created_at[1] != '') {
                    $query->where('rawat_jalan.created_at', '<=', $created_at[1]);
                }
            }
        });

        $datatables->addColumn('action', function ($rjalan) {
            return '<div class="ui small group buttons"><a data-content="Lihat Detail / Proses Rawat Jalan" href="' . url('administrasi/rawat-jalan/view/' . $rjalan->id_rjalan) . '" class="ui primary icon small button"><i class="eye icon"></i></a><a data-content="Hapus Data Rawat Jalan" data-id="'. $rjalan->id_rjalan .'" class="ui negative icon small button delete-btn"><i class="trash icon"></i></a></div>';
        })->editColumn('tgl_daftar', function ($rjalan) {
            return \Date::parse($rjalan->tgl_daftar)->format('j F Y');
        })->editColumn('tgl_lahir', function ($rjalan) {
            return \Date::parse($rjalan->tgl_lahir)->format('j F Y');
        });

        return $datatables->make(true);
    }

    public function postDelete_rawat_jalan(Request $request){
        return (\App\RawatJalan::whereIn('id', $request->get('id'))->delete()) ? response()->json(['response' => true, 'message' => 'Berhasil menghapus Rawat Jalan']) : response()->json(['response' => false, 'message' => 'Gagal menghapus Rawat Jalan']);
    }

    /**
     * Page: administrasi/konsultasi/pasien/{id}.
     *
     * @method getPasien
     *
     * @param mixed $id
     */
    public function getView($id)
    {
        $rawat_jalan = \App\RawatJalan::find($id);
        if ($rawat_jalan->progres == 1){
            abort(404);
        }
        return view('administrasi.rawat-jalan.view', ['rawat_jalan' => $rawat_jalan]);
    }

    /**
     * Post Form Konsultasi.
     *
     * @method postKonsultasi
     *
     * @param  KonsultasiFormRequest $request
     * @return \Response             Json response
     */
    public function postSimpan_konsultasi(KonsultasiFormRequest $request)
    {
        #update apabila terdatapat key 'id' pada request
        if ($request->get('id') != '') {
            $input               = array_except($request->all(), ['_token']);
            $input['pegawai_id'] = auth()->guard('pegawai')->user()->id;
            try {
                $save = \App\RuangKonsul::where('id', $request->get('id')) ->update(array_except($input, ['id']));

                return response()->json([
                    'response' => true,
                    'message'  => trans('message.update_success', ['name' => 'konsultasi']),
                ]);
            } catch (QueryException $e) {
                return response()->json([
                    'response' => false,
                    'message'  => 'Gagal menyimpan data.<br>' . $e->getCode() . ' ' . $e->getMessage(),
                ]);
            }
        }

        #create apabila terdatapat key 'id' pada request
        $input               = array_except($request->all(), ['_token', 'id']);
        $input['pegawai_id'] = auth()->guard('pegawai')->user()->id;
        try {
            $save = \App\RuangKonsul::create($input);
            if ($save) {
                return response()->json([
                    'response' => true,
                    'message'  => 'Data konsultasi berhasil disimpan',
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'response' => false,
                'message'  => 'Gagal menyimpan data.<br>' . $e->getCode() . ' ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Hapus Data Konsultasi.
     *
     * @method getDelete_konsultasi
     *
     * @param  Request    $request [description]
     * @return Response
     */
    public function getDelete_konsultasi(Request $request)
    {
        $id_ar = $request->get('id');
        try {
            $delete = \App\RuangKonsul::whereIn('id', $id_ar)->delete();
            if ($delete) {
                return response()->json([
                    'response' => true,
                    'message'  => trans('message.delete_success', ['name' => 'Konsultasi']),
                ]);
            } else {
                return response()->json([
                    'response' => false,
                    'message'  => trans('message.delete_failed', ['name' => 'Konsultasi']),
                ]);
            }
        } catch (QueryException $e) {
            return response()->json([
                'response' => false,
                'message'  => 'Gagal menyimpan data.<br>' . $e->getCode() . ' ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * @param Request $request
     */
    public function getPasien_json(Request $request)
    {
        $rawat_jalan = \App\RawatJalan::where('progres', 0)
            ->join('pasien', 'pasien.id', '=', 'rawat_jalan.pasien_id');
        $datatables = app('datatables')->of($rawat_jalan);
        $datatables->filter(function ($query) use ($request) {
            $search = $request->get('search');
            if (trim($search['value']) != '') {
                $query->where('pasien.id', '=', $search['value']);
                $query->orWhere('rawat_jalan.id', '=', $search['value']);
                $query->orWhere('nama', 'like', $search['value'] . '%');
            }
        });

        return $datatables->make('true');
    }

    /**
     * JSON datatable konsultasi.
     *
     * @method getData_konsultasi
     *
     * @param  Request $request        [description]
     * @param  Integer  $id             [description]
     * @return \Response
     */
    public function getData_konsultasi(Request $request, $id)
    {
        $rawat_jalan = \App\RuangKonsul::where('rawat_jalan_id', $id);
        $rawat_jalan->join('pegawai', 'pegawai.id', '=', 'ruang_konsul.pegawai_id')
            ->join('poli', 'poli.id', '=', 'ruang_konsul.poli_id')
            ->select('ruang_konsul.*', 'poli.nama as nama_poli', 'pegawai.nama as nama_pegawai');
        $datatables  = app('datatables')->of($rawat_jalan);
        $datatables->filter(function ($query) use ($request, $id) {
            $search = $request->get('search');
            if ($search['value'] != '') {
                $query->where('pemeriksaan_fisik', 'like', $search['value'] . '%')
                    ->orWhere('ruang_konsul.id', $search['value'])
                    ->orWhere('diagnosa', 'like', $search['value'] . '%')
                    ->orWhere('keterangan', 'like', $search['value'] . '%')
                    ->orWhere('poli.nama', 'like', $search['value'] . '%')
                    ->orWhere('pegawai.nama', 'like', $search['value'] . '%');
            }
        })->editColumn('created_at', function ($rawat_jalan) {
            return \Date::parse($rawat_jalan->created_at)->format('l, j F Y H:i');
        })->addColumn('action', function($rawat_jalan){
            return '<div class="ui small  group buttons"><a data-content="Lihat Detail Konsultasi" class="ui primary icon small button view-btn" data-id="'. $rawat_jalan->id .'"><i class="eye icon"></i></a><a data-content="Ubah Data Konsultasi" class="ui orange icon small button edit-btn" data-id="'. $rawat_jalan->id .'"><i class="edit icon"></i></a><a data-content="Hapus Data Konsultasi" class="ui negative icon small button delete-btn" data-id="'. $rawat_jalan->id .'"><i class="trash icon"></i></a></div>';
        });

        return $datatables->make(true);
    }

    /**
     * [getData_konsultasi_form description].
     *
     * @method getData_konsultasi_form
     *
     * @param  mixed  $id             Ruang Konsul ID
     * @return [type] [description]
     */
    public function getData_konsultasi_form($id)
    {
        return response()->json([
            'results' => \App\RuangKonsul::find($id),
        ]);
    }

    /**
     * [getPetugas description].
     *
     * @method getPetugas
     *
     * @param  Request     $request [description]
     * @return \Response
     */
    public function getPetugas(Request $request)
    {
        $request->get('role') || abort(404);
        $data   = \App\Pegawai::Query();
        $result = [];
        try {
            trim($request->get('find')) != '' && $data->where('nama', 'like', $request->get('find') . '%');
            trim($request->get('role')) != '' && $data->where('jabatan', '=', $request->get('role'));
            $data->orderBy('nama', 'asc');
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
        foreach ($data->get() as $key => $value) {
            $result[] = ['name' => $value->nama, 'value' => $value->id];
        }

        return response()->json(['success' => true, 'results' => $result]);
    }

    /**
     * [getData_poli description].
     *
     * @method getData_poli
     *
     * @param  Request $request        [description]
     * @return [type]  [description]
     */
    public function getData_poli(Request $request)
    {
        $data   = \App\Poli::Query();
        $result = [];
        try {
            trim($request->get('find')) != '' && $data->where('nama', 'like', $request->get('find') . '%');
            $data->orderBy('nama', 'asc');
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }
        foreach ($data->get() as $key => $value) {
            $result[] = ['name' => $value->nama, 'value' => $value->id];
        }

        return response()->json(['success' => true, 'results' => $result]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function getData_id_konsultasi(Request $request, $id)
    {
        $tindakan = \App\RuangKonsul::where('ruang_konsul.rawat_jalan_id', $id)->leftJoin('tindakan','tindakan.ruang_konsul_id','=','ruang_konsul.id')->select('ruang_konsul.id','ruang_konsul.created_at','tindakan.id as check')->get();
        return response()->json(['response' => true, 'data' => $tindakan]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function getData_detail_tindakan(Request $request, $id)
    {

        $tindakan = \App\RuangKonsul::where('ruang_konsul.id', $id)
            ->leftJoin('tindakan', 'tindakan.ruang_konsul_id', '=', 'ruang_konsul.id')
            ->join('poli', 'poli.id', '=', 'ruang_konsul.poli_id')
            ->join('pegawai', 'pegawai.id', '=', 'ruang_konsul.pegawai_id')
            ->leftJoin('pegawai as petugas_tindakan', 'petugas_tindakan.id', '=', 'tindakan.pegawai_id')
            ->select('ruang_konsul.id as ruang_konsul_id', 'ruang_konsul.diagnosa', 'ruang_konsul.keterangan as keterangan_konsultasi', 'ruang_konsul.pemeriksaan_fisik', 'tindakan.pengobatan', 'ruang_konsul.kasus', 'ruang_konsul.created_at as tgl_konsultasi', 'tindakan.keterangan as keterangan_tindakan', 'tindakan.id as id_tindakan', 'tindakan.created_at as tgl_tindakan', 'pegawai.nama as nama_petugas', 'petugas_tindakan.nama as petugas_tindakan', 'poli.nama as nama_poli')
            ->get();
        for ($i = 0; $i < count($tindakan); $i++) {
            $tindakan[$i]->tgl_konsultasi = \Date::parse($tindakan[$i]->tgl_konsultasi)->format('l, j F Y \J\a\m H:i');
            if ($tindakan[$i]->tgl_tindakan) {
                $tindakan[$i]->tgl_tindakan = \Date::parse($tindakan[$i]->tgl_tindakan)->format('l, j F Y \J\a\m H:i');
            }
        }

        return response()->json(['response' => true, 'data' => $tindakan]);
    }

    /**
     * @param Request $request
     */
    public function postSimpan_tindakan(TindakanRequest $request)
    {
        if ($request->get('id') != '') {
            return response()->json($this->update_tindakan(array_except($request->all(), ['_token'])));
        }
        $input               = array_except($request->all(), ['_token', 'id']);
        $input['pegawai_id'] = $this->pegawai->id;
        try {
            $tindakan = \App\Tindakan::create($input);

            return ($tindakan->id != null) ? response()->json(['response' => true, 'message' => 'Berhasil menyimpan Data Tindakan', 'result' => $tindakan->id]) : response()->json(['response' => false, 'message' => 'Terjadi kesalahan, Gagal menyimpan Tindakan']);
        } catch (QueryException $e) {
            return response()->json([
                'response' => false,
                'message'  => 'Gagal menyimpan Tindakan.<br><b>Error: </b>' . $e->getMessage(),
            ]);
        }
    }

    /**
     * @param $input
     */
    protected function update_tindakan($input)
    {
        $id   = $input['id'];
        $data = array_except($input, ['id']);
        $data['pegawai_id'] = auth()->guard('pegawai')->user()->id;
        try {
            return \App\Tindakan::where('id', $id)->update($data) ? ['response' => true, 'message' => 'Berhasil mengubah Data Tindakan'] : ['response' => false, 'message' => 'Maaf terjadi kesalahan, Gagal mengubah Tindakan'];
        } catch (QueryException $e) {
            return [
                'response' => false,
                'message'  => 'Gagal menghapus Tindakan.<br><b>Error: </b>' . $e->getMessage(),
            ];
        }
    }

    /**
     * [postDelete_tindakan description]
     * @method postDelete_tindakan
     * @param  Request             $request [description]
     * @return [type]                       [description]
     */
    public function postDelete_tindakan(Request $request)
    {
        try {
            return \App\Tindakan::where('id', $request->get('id'))->delete() ? response()->json(['response' => true, 'message' => 'Berhasil menghapus Data Tindakan']) : response()->json(['response' => false, 'message' => 'Maaf terjadi kesalahan, hapus Tindakan Gagal']);
        } catch (QueryException $e) {
            return response()->json([
                'response' => false,
                'message'  => 'Gagal menghapus Tindakan.<br><b>Error: </b>' . $e->getMessage(),
            ]);
        }
    }

    /**
     * JSON Datatables Resep Pasien.
     *
     * @method getData_resep
     *
     * @param  Request                   $request
     * @param  string|int|array          $id        ID Rawat Jalan
     * @return Response JSON
     */
    public function getData_resep(Request $request, $id)
    {
        $resep = \App\Resep::where('rawat_jalan.id', $id);
        $resep->join('rawat_jalan', 'rawat_jalan.id', '=', 'resep.rawat_jalan_id')
            ->join('pegawai', 'pegawai.id', '=', 'resep.pegawai_id')
            ->join('obat', 'obat.id', '=', 'resep.obat_id')
            ->select('resep.*', 'pegawai.nama', 'obat.nama as nama_obat');
        $datatables = \Datatables::of($resep);
        $datatables->editColumn('created_at', function($resep){
            return \Date::parse($resep->tgl_daftar)->format('j F Y - H:i');
        });
        $datatables->addColumn('action', function($resep){
            return '<div class="ui small  group buttons"><a data-content="Ubah Data Resep" class="ui orange icon small button edit-btn" data-id="'. $resep->id .'"><i class="edit icon"></i></a><a data-content="Hapus Data Resep" class="ui negative icon small button delete-btn" data-id="'. $resep->id .'"><i class="trash icon"></i></a></div>';
        });
        return $datatables->make(true);
    }

    /**
     * Simpan data resep.
     *
     * @method postSimpan_resep
     *
     * @param  ResepPasienRequest $request
     * @return Response
     */
    public function postSimpan_resep(ResepPasienRequest $request)
    {
        $input = array_except($request->all(), ['_token', 'id']);
        if (trim($request->get('id')) != '') {
            try {
                if (\App\Resep::where('rawat_jalan_id', $input['rawat_jalan_id'])->where('obat_id', $input['obat_id'])->count() == 1) {
                    return response()->json([
                         'response' => false,
                         'message'  => 'Anda tidak seharusnya mendapatkan pesan ini. Sepertinya data resep ini sudah ada.',
                     ]);
                }
                $save = \App\Resep::where('id', $request->get('id'))->update($input);

                return ($save) ? response()->json([
                    'response' => true,
                    'message'  => 'Data resep berhasil disimpan',
                ]) : response()->json([
                    'response' => false,
                    'message'  => 'Gagal menyimpan data resep',
                ]);
            } catch (QueryException $e) {
                return false;
            }
        }
        $input['pegawai_id'] = auth()->guard('pegawai')->user()->id;
        try {
            $obat = explode(',', $input['obat_id']);
            for ($i = 0; $i < count($obat); ++$i) {
                $validasi = \App\Resep::where('rawat_jalan_id', $input['rawat_jalan_id'])
                    ->where('obat_id', $obat[$i])
                    ->count();
                if ($validasi == 0) {
                    \App\Resep::create([
                        'obat_id'        => $obat[$i],
                        'pegawai_id'     => $input['pegawai_id'],
                        'rawat_jalan_id' => $input['rawat_jalan_id'],
                    ]);
                }
            }

            return response()->json([
                'response' => true,
                'message'  => 'Data resep berhasil disimpan',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'response' => false,
                'message'  => $e->getMessage(),
            ]);
        }
    }

    /**
     * Hapus data resep
     * @method getDelete_resep
     * @param  Request         $request
     * @return Response
     */
    public function getDelete_resep(Request $request)
    {
        try {
            return (\App\Resep::whereIn('id', $request->get('id'))->delete()) ? response()->json([
                'response' => true,
                'message'  => 'Data resep berhasil dihapus',
            ]) : response()->json([
                'response' => false,
                'message'  => 'Gagal menghapus data resep',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'response' => false,
                'message'  => 'Gagal menghapus data resep.<br><b>Error: </b>' . $e->getMessage(),
            ]);
        }
    }

    /**
     * [postSelesai description]
     *
     * @method postSelesai
     * @param  Request     $request [description]
     * @return [type]               [description]
     */
    public function postSelesai(Request $request)
    {
        $id      = $request->get('id');
        $progres = $request->get('progres');
        $force   = $request->get('force');
        if ($force == 'false') {
            if (\App\RuangKonsul::where('ruang_konsul.rawat_jalan_id', $id)->count() <= 0) {
                return response()->json([
                    'response'  => false,
                    'message'   => 'Server mendapati bahwa data ini tidak memiliki data KONSULTASI. Anda yakin ingin menandai selesai?',
                    'reconfirm' => true,
                ]);
            } else {
                $rID = \App\RuangKonsul::where('rawat_jalan_id', $id)->lists('id');
                foreach ($rID as $val) {
                    if (\App\Tindakan::where('ruang_konsul_id', $val)->count() <= 0) {
                        return response()->json([
                        'response'  => false,
                        'message'   => 'Server mendapati bahwa data ini tidak memiliki
                        Data Tindakan. Anda yakin ingin menandai selesai?',
                        'reconfirm' => true,
                    ]);
                    }
                }

            }
            if (\App\Resep::where('rawat_jalan_id', $id)->count() <= 0) {
                return response()->json([
                    'response'  => false,
                    'message'   => 'Server mendapati bahwa data ini tidak memiliki data RESEP. Anda yakin ingin menandai selesai?',
                    'reconfirm' => true,
                ]);
            }
            $force = true;
        }
        if ($force == 'true') {
            try {
                $message = ($progres == 1) ? 'Sukses menandai "SELESAI" untuk rawat jalan ini.' : 'Sukses menandai "BELUM" untuk rawat jalan ini.';
                $redirect = ($progres == 1) ? url('administrasi/rawat-jalan') : url('administrasi/rawat-jalan/view/'. $id);
                return (\App\RawatJalan::where('id', $id)->update(['progres' => $progres])) ? response()->json(['response' => true, 'redirect' => $redirect, 'message' => $message, 'result' => \App\RawatJalan::find($id)->progres]) : response()->json(['response' => false, 'message' => 'Maaf terjadi kesalahan, penandaan selesai gagal']);
            } catch (QueryException $e) {
                return response()->json([
                    'response' => false,
                    'message'  => 'Gagal menghapus data resep.<br><b>Error: </b>' . $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * @param $id
     */
    protected function validate_selesai($id)
    {
        if (\App\RuangKonsul::where('rawat_jalan_id', $id)->count() <= 0) {
            return [
                'response'  => false,
                'message'   => 'Server mendapati bahwa data ini tidak memiliki data KONSULTASI. Anda yakin ingin menandai selesai?',
                'reconfirm' => true,
            ];
        }
        if (\App\Resep::where('rawat_jalan_id', $id)->count() <= 0) {
            return [
                'response'  => false,
                'message'   => 'Server mendapati bahwa data ini tidak memiliki data RESEP. Anda yakin ingin menandai selesai?',
                'reconfirm' => true,
            ];
        }

        return ['response' => true];
    }

    /**
     * [getList_obat description]
     * @method getList_obat
     * @param  Request $request        [description]
     * @return [type]  [description]
     */
    public function getList_obat(Request $request)
    {
        $obat   = \App\Resep::where('rawat_jalan_id', $request->get('id'))->lists('obat_id');
        $data   = \App\Obat::Query();

        $result = [];
        try {
            trim($request->get('find')) != '' && $data->where('nama', 'like', $request->get('find') . '%');
            trim($request->get('find')) != '' && $data->where('kode', 'like', $request->get('find') . '%');
            $data->whereNotIn('id', $obat);
            $data->orderBy('nama', 'asc');

            foreach ($data->get() as $key => $value) {
                $result[] = ['name' => $value->nama, 'value' => $value->id];
            }
        } catch (QueryException $e) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true, 'results' => $result]);
    }
}

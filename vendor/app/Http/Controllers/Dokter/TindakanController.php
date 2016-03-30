<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\ResepPasienRequest;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    /**
     * Halaman index dokter/tindakan.
     *
     * @method getIndex
     *
     * @return \Response
     */
    public function getIndex()
    {
        return view('dokter.tindakan.index');
    }

    /**
     * @param  Request $request
     * @return mixed
     */
    public function getData_index(Request $request)
    {
        $dokter = \App\Dokter::where('pegawai_id', auth()->guard('pegawai')->user()->id)->first();
        $rjalan = \App\RuangKonsul::where('ruang_konsul.poli_id', $dokter->poli_id)->where('progres',0);
        $rjalan->join('rawat_jalan', 'ruang_konsul.rawat_jalan_id', '=', 'rawat_jalan.id');
        $rjalan->join('pasien', 'pasien.id', '=', 'rawat_jalan.pasien_id');
        $rjalan->select('pasien.*', 'rawat_jalan.id as id_rjalan', 'rawat_jalan.created_at as tgl_daftar', \DB::raw('DATE_FORMAT(`rawat_jalan`.`created_at`, "%H:%i") as jam'));
        $rjalan->groupBy('id_rjalan');
        $datatables = \Datatables::of($rjalan);
        $datatables->filter(function ($query) use ($request) {
            $search = $request->get('search');
            $get    = $request->get('columns');
            if (trim($search['value']) != '') {
                $query->where('pasien.id', '=', $search['value']);
                $query->orWhere('rawat_jalan.id', '=', $search['value']);
                $query->orWhere('pasien.nama', 'like', $search['value'] . '%');
            }
            if (isset($get[5]['search']['value']) && str_contains($get[5]['search']['value'], '-yadcf_delim-')) {
                $created_at = explode('-yadcf_delim-', $get[5]['search']['value']);
                if (isset($created_at[0]) && $created_at[0] != '') {
                    $query->where('rawat_jalan.created_at', '>=', $created_at[0]);
                }
                if (isset($created_at[1]) && $created_at[1] != '') {
                    $query->where('rawat_jalan.created_at', '<=', $created_at[1]);
                }
            }

        });

        $datatables->addColumn('action', function ($rjalan) {
            return '<a href="' . url('dokter/rawat-jalan/view/' . $rjalan->id_rjalan) . '" class="ui positive icon small button">Lihat</a>';
        })
            ->editColumn('tgl_daftar', function ($rjalan) {
                return \Date::parse($rjalan->tgl_daftar)->format('j F Y');
            })
            ->editColumn('tgl_lahir', function ($rjalan) {
                return \Date::parse($rjalan->tgl_lahir)->format('j F Y');
            });

        return $datatables->make(true);
    }

    /**
     * Page: dokter/konsultasi/pasien/{id}.
     *
     * @method getPasien
     *
     * @param mixed $id
     */
    public function getView($id)
    {
        $rawat_jalan = \App\RawatJalan::find($id);

        return view('dokter.tindakan.view',
            ['rawat_jalan' => $rawat_jalan]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function getData_id_konsultasi(Request $request, $id)
    {
        $dokter   = \App\Dokter::where('pegawai_id', auth()->guard('pegawai')->user()->id)->first();

        $tindakan = \App\RuangKonsul::where('ruang_konsul.rawat_jalan_id', $id)->where('ruang_konsul.poli_id', $dokter->poli_id)->leftJoin('tindakan','tindakan.ruang_konsul_id','=','ruang_konsul.id')->select('ruang_konsul.id','ruang_konsul.created_at','tindakan.id as check')->get();
        return response()->json(['response' => true, 'data' => $tindakan]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function getData_detail_tindakan(Request $request, $id)
    {
        $dokter   = \App\Dokter::where('pegawai_id', auth()->guard('pegawai')->user()->id)->first();
        $tindakan = \App\RuangKonsul::where('ruang_konsul.id', $id)->where('poli_id', $dokter->poli_id)
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
    public function postSimpan_tindakan(Request $request)
    {
        if ($request->get('id') != '') {
            return response()->json($this->update_tindakan(array_except($request->all(), ['_token'])));
        }
        $input               = array_except($request->all(), ['_token', 'id']);
        $input['pegawai_id'] = auth()->guard('pegawai')->user()->id;
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
     * @param Request $request
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
     * @return \Illuminate\HTTP\Response JSON
     */
    public function getData_resep(Request $request, $id)
    {
        $resep = \App\Resep::where('rawat_jalan.id', $id)
            ->join('rawat_jalan', 'rawat_jalan.id', '=', 'resep.rawat_jalan_id')
            ->join('pegawai', 'pegawai.id', '=', 'resep.pegawai_id')
            ->join('obat', 'obat.id', '=', 'resep.obat_id')
            ->select('resep.*', 'pegawai.nama', 'obat.nama as nama_obat');
        $datatables = \Datatables::of($resep);
        $datatables->editColumn('created_at', function($resep){
            return \Date::parse($resep->created_at)->format('j F Y - H:i');
        });
        $datatables->addColumn('action', function($resep){
            return '<div class="ui small  group buttons"><a data-content="Ubah Data Resep" class="ui orange icon small button edit-btn" data-id="'. $resep->id .'"><i class="edit icon"></i></a><a data-content="Hapus Data Resep" class="ui negative icon small button delete-btn" data-id="'. $resep->id .'"><i class="trash icon"></i></a></div>';
        });

        return $datatables->make(true);
    }

    /**
     * [postSimpan_resep description].
     *
     * @method postSimpan_resep
     *
     * @param  ResepPasienRequest $request        [description]
     * @return [type]             [description]
     */
    public function postSimpan_resep(ResepPasienRequest $request)
    {
        $input = array_except($request->all(), ['_token', 'id']);
        if (trim($request->get('id')) != '') {
            try {
                if (\App\Resep::where('rawat_jalan_id', $input['rawat_jalan_id'])->where('obat_id', $input['obat_id'])->count() == 1){
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
     * @param Request $request
     */
    public function getDelete_resep(Request $request)
    {
        try {
            return \App\Resep::whereIn('id', $request->get('id'))
                ->delete() ? response()->json([
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
     * [getList_obat description]
     * @method getList_obat
     * @param  Request $request        [description]
     * @return [type]  [description]
     */
    public function getList_obat(Request $request)
    {
        $obat = \App\Resep::where('rawat_jalan_id', $request->get('id'))->lists('obat_id');
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

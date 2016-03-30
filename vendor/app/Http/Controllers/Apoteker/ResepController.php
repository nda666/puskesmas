<?php

namespace App\Http\Controllers\Apoteker;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;

class ResepController extends Controller
{
    public function getIndex()
    {
        return view('apoteker.rawat-jalan.index');
    }

    public function getData_index(Request $request)
    {
        $rjalan = \App\Resep::where('rawat_jalan.progres', 0);
        $rjalan->join('rawat_jalan','rawat_jalan.id','=','resep.rawat_jalan_id');
        $rjalan->join('pasien', 'pasien.id', '=', 'rawat_jalan.pasien_id');
        $rjalan->select('pasien.*', 'rawat_jalan.id as id_rjalan', 'rawat_jalan.created_at as tgl_daftar', \DB::raw('DATE_FORMAT(`rawat_jalan`.`created_at`, "%H:%i") as jam'));
        $rjalan->groupBy('rawat_jalan.id');
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
            return '<a href="' . url('apoteker/rawat-jalan/view/' . $rjalan->id_rjalan) . '" class="ui positive icon small button">Lihat</a>';
        })
            ->editColumn('tgl_daftar', function ($rjalan) {
                return \Date::parse($rjalan->tgl_daftar)->format('j F Y');
            })
            ->editColumn('tgl_lahir', function ($rjalan) {
                return \Date::parse($rjalan->tgl_lahir)->format('j F Y');
            });

        return $datatables->make(true);
    }

    public function getView($id)
    {
        $rawat_jalan = \App\RawatJalan::find($id);
        if ($rawat_jalan->progres == 1){
            abort(404);
        }
        return  view('apoteker.resep.view',
            ['rawat_jalan' => $rawat_jalan]);
    }

    public function getData_konsultasi(Request $request, $id)
    {
        $rawat_jalan = \App\RuangKonsul::Query();
        $datatables  = app('datatables')->of($rawat_jalan);
        $datatables->filter(function ($query) use ($request, $id) {
            $query->where('rawat_jalan_id', $id)
                ->join('pegawai', 'pegawai.id', '=', 'ruang_konsul.pegawai_id')
                ->join('poli', 'poli.id', '=', 'ruang_konsul.poli_id')
                ->select('ruang_konsul.*', 'poli.nama as nama_poli', 'pegawai.nama as nama_pegawai');
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
        });

        return $datatables->make(true);
    }

    public function getData_id_konsultasi(Request $request, $id)
    {
        $tindakan = \App\RuangKonsul::where('ruang_konsul.rawat_jalan_id', $id)->leftJoin('tindakan','tindakan.ruang_konsul_id','=','ruang_konsul.id')->select('ruang_konsul.id','ruang_konsul.created_at','tindakan.id as check')->get();
        return response()->json(['response' => true, 'data' => $tindakan]);
    }

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

    public function getData_resep(Request $request, $id)
    {
        $resep = \App\Resep::where('rawat_jalan.id', $id)
            ->join('rawat_jalan', 'rawat_jalan.id', '=', 'resep.rawat_jalan_id')
            ->join('pegawai', 'pegawai.id', '=', 'resep.pegawai_id')
            ->join('obat', 'obat.id', '=', 'resep.obat_id')
            ->select('resep.*', 'pegawai.nama', 'obat.nama as nama_obat');
        $datatables = \Datatables::of($resep);
        return $datatables->make(true);
    }

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

                return (\App\RawatJalan::where('id', $id)->update(['progres' => $progres])) ? response()->json(['response' => true, 'redirect' => url('apoteker/rawat-jalan') ,'message' => $message, 'result' => \App\RawatJalan::find($id)->progres]) : response()->json(['response' => false, 'message' => 'Maaf terjadi kesalahan, penandaan selesai gagal']);
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
}

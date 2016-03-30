<?php

namespace App\Http\Controllers\Administrasi;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function getIndex()
    {
        return view('administrasi.laporan.index', ['active' => 'laporan']);
    }

    public function getData_index(Request $request)
    {
        $rjalan = \App\RawatJalan::where('progres', 1);
        $rjalan->join('pasien', 'pasien.id', '=', 'rawat_jalan.pasien_id');
        $rjalan->select('pasien.*', 'rawat_jalan.id as id_rjalan', 'rawat_jalan.created_at as tgl_daftar', \DB::raw('DATE_FORMAT(`rawat_jalan`.`created_at`, "%H:%i") as jam'));
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
            return '<div class="ui small group buttons"><a data-content="Lihat Detail / Proses Rawat Jalan" href="' . url('administrasi/laporan/view/' . $rjalan->id_rjalan) . '" class="ui primary icon small button"><i class="eye icon"></i></a><a data-content="Hapus Data Rawat Jalan" data-id="'. $rjalan->id_rjalan .'" class="ui negative icon small button delete-btn"><i class="trash icon"></i></a></div>';
        })->editColumn('tgl_daftar', function ($rjalan) {
            return \Date::parse($rjalan->tgl_daftar)->format('j F Y');
        })->editColumn('tgl_lahir', function ($rjalan) {
            return \Date::parse($rjalan->tgl_lahir)->format('j F Y');
        });

        return $datatables->make(true);
    }

    public function getView($id)
    {
        $rawat_jalan = \App\RawatJalan::findOrFail($id);
        if ($rawat_jalan->progres == 0) {
            abort(404);
        }
        return view('administrasi.laporan.view',
            ['rawat_jalan' => $rawat_jalan]);
    }

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
            return '<div class="ui small  group buttons"><a data-content="Lihat Detail" class="ui primary icon small button view-btn" data-id="'. $rawat_jalan->id .'"><i class="eye icon"></i></a></div>';
        });
        return $datatables->make(true);
    }
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
        return $datatables->make(true);
    }
}

<?php

namespace App\Http\Controllers\Konsultan;

use App\Http\Requests\KonsultasiFormRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class KonsultasiController extends Controller
{
    public function getIndex(){
        return view('konsultan.konsultasi.index');
    }

    public function getData_index(Request $request)
    {
        $rjalan = \App\RawatJalan::where('progres', $request->get('progres'));
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
            return '<a href="' . url('konsultan/rawat-jalan/view/' . $rjalan->id_rjalan) . '" class="ui positive icon small button">Lihat</a>';
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
        $rawat_jalan = \App\RawatJalan::where('progres', 0)->where('id', $id)->first();

        return view('konsultan.konsultasi.view',
            ['rawat_jalan' => $rawat_jalan]);
    }

    /**
     * JSON datatable konsultasi.
     *
     * @method getData_konsultasi
     *
     * @param  Request $request        [description]
     * @param  [type]  $id             [description]
     * @return [type]  [description]
     */
    public function getData_konsultasi(Request $request, $id)
    {
        $rawat_jalan = \App\RuangKonsul::where('rawat_jalan_id', $id);
        $datatables  = app('datatables')->of($rawat_jalan);
        $datatables->filter(function ($query) use ($request, $id) {
            $query->join('pegawai', 'pegawai.id', '=', 'ruang_konsul.pegawai_id')
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
        })->addColumn('action', function($rawat_jalan){
            return '<div class="ui small group buttons"><a data-content="Lihat Detail" class="ui primary icon small button view-btn" data-id="'. $rawat_jalan->id .'"><i class="eye icon"></i></a><a data-content="Ubah Data Konsultasi" class="ui orange icon small button edit-btn" data-id="'. $rawat_jalan->id .'"><i class="edit icon"></i></a><a data-content="Hapus Data Konsultasi" class="ui negative icon small button delete-btn" data-id="'. $rawat_jalan->id .'"><i class="trash icon"></i></a></div>';
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
                $save = \App\RuangKonsul::where('id', $request->get('id'))
                    ->update(array_except($input, ['id']));

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
}

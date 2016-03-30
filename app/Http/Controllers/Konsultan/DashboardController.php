<?php

namespace App\Http\Controllers\Konsultan;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function getIndex()
    {
        $count[] = [
          'title' => 'Total Pasien',
          'icon' => 'user',
          'content' => \App\Pasien::count(),
       ];
        $count[] = [
          'title' => 'Rawat Jalan',
          'icon' => 'treatment',
          'content' => \App\RawatJalan::where('progres', 0)->count(),
       ];
        $count[] = [
          'title' => 'Pegawai',
          'icon' => 'users',
          'content' => \App\Pegawai::where('jabatan','!=' ,'Dokter')->count(),
       ];
        $count[] = [
          'title' => 'Dokter',
          'icon' => 'doctor',
          'content' => \App\Pegawai::where('jabatan', 'Dokter')->count(),
       ];

        return view('dashboard.konsultan', [
          'count' => $count,
       ]);
    }

    /**
     * @param Request $request
     */
    public function getPasien_rawat_jalan(Request $request)
    {
        $pasien = \App\RawatJalan::with('pasien')->where('progres',0)->orderBy('created_at', 'desc')->limit(10);
        return \Datatables::of($pasien)->make(true);
    }

    /**
     * @param Request $request
     */
    public function getRawat_jalan(Request $request)
    {
        $year = \Carbon\Carbon::now()->subMonths(12);
        $data = [];
        for ($i = 1; $i <= 12; ++$i) {
            $month = \Carbon\Carbon::parse($year)->addMonths($i)->format('Y-m');
            $rawat_jalan = \App\RawatJalan::where('created_at', 'like', $month.'%')->count();
            $indexs = \Date::parse($year)->addMonths($i)->format('F');
            $data[$indexs] = $rawat_jalan;
        }

        return response()->json($data);
    }

    public function getUsia_per_tahun(){
        $year = \Carbon\Carbon::now()->subMonths(12);
        $rawat_jalan = \App\RawatJalan::where('rawat_jalan.created_at', '>', $year)->where('rawat_jalan.created_at', '<', \Carbon\Carbon::now())->join('pasien','pasien.id','=','rawat_jalan.pasien_id')->select(\DB::raw('count(`pasien_id`) as total, case when DATEDIFF(now(),pasien.tgl_lahir) / 365.25 > 50 then "51 Tahun ke atas" when DATEDIFF(now(),pasien.tgl_lahir) / 365.25 > 40 then "41 - 50 Tahun" when DATEDIFF(now(),pasien.tgl_lahir) / 365.25 > 30 then "31 - 40 Tahun" when DATEDIFF(now(),pasien.tgl_lahir) / 365.25 > 20 then "20 - 30 Tahun" when DATEDIFF(now(),pasien.tgl_lahir) / 365.25 > 10 then "10 - 20 Tahun" when DATEDIFF(now(),pasien.tgl_lahir) / 365.25 > 0 then "1 - 10 Tahun" end as usia'))->groupBy('usia')->get();
        $data = [];
        foreach ($rawat_jalan as $key => $value) {
           $data[] = ['label' => $value->usia, 'data' => $value->total];
        }
        return response()->json(['response' => true, 'data' => $data ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateProfileFotoRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Validator;

class ProfileController extends Controller
{
    public function getIndex()
    {
        return view('auth.index',['active'=>'profile']);
    }

    /**
     * @param Request $request
     */
    public function postUpdate_password(Request $request)
    {
        $input     = $request->all();
        $validator = $this->validator_pass($input);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator->errors())
                ->withInput();
        }
        $pegawai = \App\Pegawai::find($input['id']);

        $pegawai->password = bcrypt($input['password']);
        if ($pegawai->save()) {
            return back()->with(['response' => true, 'message' => 'Berhasil update password']);
        }
        return back()->with(['response' => false, 'message' => 'Gagal update password']);
    }

    /**
     * @param Request $request
     */
    public function postUpdate_foto(UpdateProfileFotoRequest $request)
    {
        $pegawai  = \App\Pegawai::find($request->get('id'));
        $old_foto = $pegawai->foto;
        $path     = base_path('public/foto-profil/');
        $new_name = str_random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
        while (\File::exists($path . $new_name)) {
            $new_name = str_random(32) . '.' . $request->file('foto')->getClientOriginalExtension();
        }

        $request->file('foto')->move($path, $new_name);
        $img = \Image::make($path.$new_name)->resize(50, 50);
        $img->save($path.'thumb_'.$new_name);
        if (!$old_foto == null && \File::exists(base_path('public/' . $old_foto))) {
            try {
                $old_thumb = \File::name(base_path('public/' . $old_foto));
                $old_thumb_ex = \File::extension(base_path('public/' . $old_foto));
                \File::delete(base_path('public/' . $old_foto));
                \File::delete(base_path('public/foto-profil/thumb_' . $old_thumb.'.'.$old_thumb_ex));
            } catch (Exception $e) {
            }
        }
        $pegawai->foto = '/foto-profil/' . $new_name;
        return ($pegawai->save()) ? response()->json(['response' => true, 'results' => asset($pegawai->foto), 'result_thumb' => asset('foto-profil/thumb_'.$new_name), 'message' => 'Berhasil mengubah foto']) : response()->json(['response' => true, 'message' => 'Terjadi kesalahan, Gagal mengubah foto']);
    }

    /**
     * @param Request $request
     */
    public function postUpdate(UpdateProfileRequest $request)
    {
        $input              = array_except($request->all(), ['_token', 'password', 'username', 'remember_token', 'jabatan']);
        $input['tgl_lahir'] = \Carbon\Carbon::createFromFormat('d-m-Y', $input['tgl_lahir'])->format('Y-m-d');
        try {
            $result = \App\Pegawai::find($input['id']);
            $result->update(array_except($input,
            ['id']));

            return response()->json(['response' => true, 'message' => 'Profil berhasil diubah', 'results' => $result->nama]);
        } catch (QueryException $e) {
            return response()->json(['response' => false, 'message' => $e->getMessage()]);
        }
    }

    /**
     * @param $data
     */
    protected function validator_pass($data)
    {
        return Validator::make($data, [
            'password' => 'required|between:6,30|confirmed',
        ]);
    }
}

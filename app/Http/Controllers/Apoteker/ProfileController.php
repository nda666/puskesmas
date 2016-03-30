<?php

namespace App\Http\Controllers\Apoteker;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(){
    	$profile = \App\Pegawai::findOrFail(auth()->guard('pegawai')->user()->id);
    	return view('apoteker.profile.index', ['profile'=>$profile]);
    }
}

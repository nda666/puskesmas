<?php

namespace App\Http\Controllers\Konsultan;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
     public function index(){	
    	return view('konsultan.profile.index');
    }
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property integer $id
 * @property string $username Username Pegawai
 * @property string $password Password Pegawai
 * @property string $nama
 * @property string $jenis_kelamin
 * @property string $no_telp
 * @property string $tgl_lahir
 * @property string $agama
 * @property string $alamat
 * @property string $jabatan
 * @property string $remember_token Remember Pada Login Form
 */
class User extends Authenticatable
{
    protected $table = 'pegawai';    
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */ 
    protected $fillable = [
        'name', 'email', 'password',
    ];
    

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

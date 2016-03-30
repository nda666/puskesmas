<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * App\Pegawai
 *
 * @property integer $id
 * @property string $username Username Pegawai
 * @property string $password Password Pegawai
 * @property string $nama
 * @property string $jenis_kelamin
 * @property string $no_telp
 * @property \Carbon\Carbon $tgl_lahir
 * @property string $agama
 * @property string $alamat
 * @property string $jabatan
 * @property string $remember_token Remember Pada Login Form
 */
class Pegawai extends Authenticatable
{

    public $timestamps = false;
        
    protected $table = 'pegawai';

    protected $dates = ['tgl_lahir'];

    protected $guarded = [''];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

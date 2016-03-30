<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Dokter
 *
 * @property integer $id
 * @property integer $pegawai_id
 * @property integer $poli_id
 */
class Dokter extends Model
{
    protected $table = 'dokter';

    public $timestamps = false;

    public $fillable = ['poli_id', 'pegawai_id'];
}

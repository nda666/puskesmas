<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Tindakan
 *
 * @property integer $id
 * @property integer $ruang_konsul_id Foreign Key Ruang Konsul
 * @property string $pengobatan
 * @property string $keterangan
 * @property integer $pegawai_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Tindakan extends Model
{
    protected $table = 'tindakan';

    protected $fillable = ['ruang_konsul_id','pengobatan', 'keterangan', 'pegawai_id'];
}

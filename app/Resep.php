<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Resep
 *
 * @property integer $id
 * @property integer $rawat_jalan_id Foreign key -> rawat_jalan.id
 * @property string $resep
 * @property integer $dokter_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $obat_id
 * @property integer $pegawai_id
 */
class Resep extends Model
{
    protected $table = 'resep';

    protected $fillable = ['rawat_jalan_id','obat_id','pegawai_id'];
}

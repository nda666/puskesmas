<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Obat
 *
 * @property integer $id
 * @property string $kode Kode Obat, Unique Key
 * @property string $nama
 */
class Obat extends Model
{
    protected $table = 'obat';

    public $timestamps = false;
    protected $fillable = ['id', 'kode', 'nama'];
}

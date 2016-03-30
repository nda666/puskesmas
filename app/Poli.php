<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Poli
 *
 * @property integer $id
 * @property string $nama_poli
 * @property string $nama
 */
class Poli extends Model
{
    protected $table = 'poli';

    public $timestamps = false;

}

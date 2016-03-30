<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RawatJalan.
 *
 * @property int $id Nomor ID: Primary Key
 * @property int $pasien_id Foreign key -> pasien.id
 * @property string $progres
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $kunjungan
 * @property string $kepesertaan
 * @property-read \App\Pasien $pasien
 * @property integer $pegawai_id Foreign key -> pegawai.id
 * @property-read \App\Pegawai $petugas
 */
class RawatJalan extends Model
{
    /**
    * @var string
    */
   protected $table = 'rawat_jalan';

   /**
    * @var array
    */
   protected $fillable = ['pasien_id', 'pegawai_id', 'progres', 'kunjungan', 'kepesertaan', 'created_at'];

    /**
     * Relasi tabel pasien
     * @method pasien
     * @return void
     */
    public function pasien()
    {
        return $this->belongsTo('\App\Pasien','pasien_id','id');
    }

   /**
    * Relasi tabel pegawai.
    * @method petugas
    * @return void
    */
   public function petugas()
   {
       return $this->belongsTo('\App\Pegawai','pegawai_id','id');
   }
}

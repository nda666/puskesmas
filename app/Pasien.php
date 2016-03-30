<?php

namespace App;

use App\Pegawai;
use App\RuangKonsul;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Searchable\SearchableTrait;

/**
 * App\Pasien
 *
 * @property integer $id Nomor Index
 * @property string $nama
 * @property string $no_kartu_keluarga
 * @property string $kepala_keluarga
 * @property string $pekerjaan
 * @property string $alamat
 * @property \Carbon\Carbon $tgl_lahir
 * @property string $jenis_kelamin
 * @property string $agama
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RuangKonsul[] $ruang_konsul
 * @property-read \App\Pegawai $petugas
 * @method static \Illuminate\Database\Query\Builder|\App\Pasien belumKonsultasi()
 * @method static \Illuminate\Database\Query\Builder|\App\Pasien sudahKonsultasi()
 * @method static \Illuminate\Database\Query\Builder|\App\Pasien sudahTerimaResep()
 */
class Pasien extends Model
{

    /**
     * @var string
     */
    protected $table = 'pasien';

    /**
     * @var array
     */
    protected $dates = ['tgl_lahir'];

    /**
     * @var mixed
     */

    /**
     * @var array
     */
    protected $guarded = [''];

    public function setNamaAttribute($value)
    {
        $this->attributes['nama'] = ucwords($value);
    }

    public function setKepalaKeluargaAttribute($value)
    {
        $this->attributes['kepala_keluarga'] = ucwords($value);
    }

    public function setPekerjaanAttribute($value)
    {
        $this->attributes['pekerjaan'] = ucwords($value);
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = ucwords($value);
    }

    /**
     * @return mixed
     */
    public function ruang_konsul()
    {
        return $this->hasMany('\App\RuangKonsul');
    }
    /**
     * @return mixed
     */
    public function petugas()
    {
        return $this->belongsTo('\App\Pegawai', 'id_pegawai', 'id');
    }
    public function delete()
    {
        RuangKonsul::where('id', '=', $this->id)->delete();
        return parent::delete();
    }

    /**
     * @param  $query
     * @return mixed
     */
    public function scopeBelum_konsultasi($query)
    {
        return $query->where('konsultasi', '=', 'Belum')->where('resep', '=', 'Belum')->where('obat', '=', 'Belum');
    }

    /**
     * @param  $query
     * @return mixed
     */
    public function scopeSudah_konsultasi($query)
    {
        return $query->where('konsultasi', '=', 'Sudah')->where('resep', '=', 'Belum')->where('obat', '=', 'Belum');
    }

    /**
     * @param  $query
     * @return mixed
     */
    public function scopeSudah_terima_resep($query)
    {
        return $query->where('konsultasi', '=', 'Sudah')->where('resep', '=', 'Sudah')->where('obat', '=', 'Belum');
    }

}

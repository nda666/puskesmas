<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * App\RuangKonsul
 *
 * @property integer $id
 * @property integer $rawat_jalan_id
 * @property string $pemeriksaan_fisik
 * @property string $diagnosa
 * @property string $kasus
 * @property string $keterangan
 * @property integer $poli_id
 * @property integer $pegawai_id
 * @property string $created_at
 * @property string $updated_at
 * @property-read \App\Pasien $pasien
 * @property-read \App\Pegawai $petugas
 * @property-read \App\Poli $poli_resep
 * @method static \Illuminate\Database\Query\Builder|\App\RuangKonsul joinPegawai($id_pegawai)
 * @method static \Illuminate\Database\Query\Builder|\App\RuangKonsul joinPasien()
 * @method static \Illuminate\Database\Query\Builder|\App\RuangKonsul findByNoindex($id_pasien)
 * @method static \Illuminate\Database\Query\Builder|\App\RuangKonsul findByIdNoindex($id, $id_pasien)
 */
class RuangKonsul extends Model
{
    /**
     * @var string
     */
    protected $table = 'ruang_konsul';

    /**
     * @var mixed
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $guarded = [''];

    /**
     * @var array
     */
    protected $dates = ['tanggal'];

    /**
     * @return mixed
     */
    public function pasien()
    {
        return $this->belongsTo('\App\Pasien', 'id_pasien', 'id');
    }
    /**
     * Relasi dengan tabel/model pegawai
     * @return mixed
     */
    public function petugas()
    {
        return $this->belongsTo('\App\Pegawai', 'id_pegawai', 'id');
    }

    public function poli_resep(){
        return $this->belongsTo('\App\Poli','id', 'id_konsul');
    }

    /**
     * scope function join_pegawai
     *
     * @param  $query
     * @param  $id_pegawai
     * @return mixed
     */
    public function scopeJoin_pegawai($query, $id_pegawai)
    {
        return $query->join('pegawai', 'pegawai.id', '=', $id_pegawai);
    }

    /**
     * scope function join_pasien()
     *
     * @param  $query
     * @return mixed
     */
    public function scopeJoin_pasien($query)
    {
        return $query->join('pasien', 'pasien.id', '=', 'ruang_konsul.id_pasien');
    }

    /**
     * scope find_by_noindex()
     *
     * @param  $query
     * @param  $id_pasien
     * @return mixed
     */
    public function scopeFind_by_noindex($query, $id_pasien)
    {
        return $query->where('id_pasien', '=', $id_pasien);
    }

    /**
     * scope find_by_id_noindex()
     *
     * @param  $query
     * @param  $id
     * @param  $id_pasien
     * @return mixed
     */
    public function scopeFind_by_id_noindex($query, $id, $id_pasien)
    {
        return $query->where('id', '=', $id)->where('id_pasien', '=', $id_pasien);
    }

    /**
     * Event Eloquent, dijalankan apabila memanggil function "first()" pada Model.
     * Contoh kasus, \App\Model::where(id, 3)->delete();
     * Maka event deleted / deleting GAK BAKAL dijalankan.
     * Apabila model dipanggil seperti ini:
     * \App\Model::where(id, 3)->first()->delete();
     * Maka event deleted / deleting BAKAL dijalankan.
     *
     * NB: event eloquent antara lain,
     * creating, created, updating, updated, saving, saved, deleting, deleted, restoring, restored.
     * jadi bisa dikatakan hampir sama dengan function di MYSQL.
     */
    public static function boot()
    {
        parent::boot();
        #Jalankan ketika Model/Tabel sudah di delete
        static::deleted(function ($ruang_konsul) {
            if (\App\RuangKonsul::where('id_pasien', $ruang_konsul->id_pasien)->count() <= 0) {
                $pasien = \App\Pasien::find($ruang_konsul->id_pasien);
                $pasien->konsultasi = 'Belum';
                $pasien->save();
            }
        });

        #Jalankan ketika Model/Tabel sudah di delete
        static::updated(function ($ruang_konsul) {
        $prev_val = $ruang_konsul->getOriginal();          
            if (\App\RuangKonsul::where('id_pasien', $prev_val['id_pasien'])->count() <= 0) {
                $pasien = \App\Pasien::find($prev_val['id_pasien']);
                $pasien->konsultasi = 'Belum';
                $pasien->save();
            }

            if (\App\RuangKonsul::where('id_pasien', $ruang_konsul->id_pasien)->count() <= 0) {
                $pasien = \App\Pasien::find($ruang_konsul->id_pasien);
                $pasien->konsultasi = 'Belum';
                $pasien->save();
            }
        });
    }
}

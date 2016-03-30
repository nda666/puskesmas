<div class="ui long small modal" id="modal-konsultasi-insert">
  <i class="close icon"></i>
  <div class="header"></div>
  <div class="content">
    <form id="form-konsultasi" data-update="<?php echo e(url('/administrasi/rawat-jalan/data-konsultasi-form')); ?>" class="ui equal width form" data-token="<?php echo e(csrf_token()); ?>" data-id="<?php echo e($rawat_jalan->id); ?>" action="<?php echo e(url('administrasi/rawat-jalan/simpan-konsultasi')); ?>">
      <?php echo csrf_field(); ?>

      <input type="hidden" name="id">
      <input type="hidden" readonly value="<?php echo e($rawat_jalan->id); ?>" name="rawat_jalan_id">
      <div class="required field">
        <label>Pemeriksaan Fisik:</label>
        <textarea rows="3" placeholder="Pemeriksaan Fisik" name="pemeriksaan_fisik"></textarea>
      </div>
      <div class="required field">
        <label>Anamesa / Diagnosa:</label>
        <textarea rows="3" placeholder="Diagnosa" name="diagnosa"></textarea>
      </div>
      <div class="two fields">
        <div class="required field">
          <label>Ke Poli:</label>
          <div id="poli-dropdown" data-source="<?php echo e(url('/administrasi/rawat-jalan/data-poli')); ?>" class="ui fluid search normal selection dropdown">
            <input type="hidden" class="hidden-dropdown" name="poli_id">
            <i class="dropdown icon"></i>
            <div class="default text">Masukkan Ke Poli</div>
          </div>
        </div>

        <div class="required field">
          <label>Kasus:</label>
          <div id="kasus-dropdown" class="ui fluid search normal selection dropdown">
            <input type="hidden" class="hidden-dropdown" name="kasus">
            <i class="dropdown icon"></i>
            <div class="default text">Pilih Kasus</div>
            <div class="menu">
              <div class="item" data-value="Baru">Baru</div>
              <div class="item" data-value="Lama">Lama</div>
            </div>
          </div>
        </div>

      </div>
      <div class="field">
        <label>Keterangan (Optional):</label>
        <textarea rows="3" placeholder="Keterangan" name="keterangan"></textarea>
      </div>
    </form>
  </div>
  <div class="actions">
    <button title="Batal dan Close Modal" class="ui negative button">
      <i class="close icon"></i>Batal</button>
    <button title="Simpan Data Konsultasi" class="ui submit positive approve button">
      <i class="icon save"></i>Simpan</button>
  </div>
</div>
<div class="ui small modal" id="modal-konsultasi-view">
  <i class="close icon"></i>
  <div class="header">Lihat Detail Konsultasi</div>
  <div class="content">
    <table class="ui definition table">
      <tr>
        <td width="30%">ID</td>
        <td data-name="id"></td>
      </tr>
      <tr>
        <td>Pemeriksaan Fisik</td>
        <td data-name="pemeriksaan_fisik"></td>
      </tr>
      <tr>
        <td>Diagnosa</td>
        <td data-name="diagnosa"></td>
      </tr>
      <tr>
        <td>Kasus</td>
        <td data-name="kasus"></td>
      </tr>
      <tr>
        <td>Poli</td>
        <td data-name="nama_poli"></td>
      </tr>
      <tr>
        <td>Keterangan</td>
        <td data-name="keterangan"></td>
      </tr>
      <tr>
        <td>Petugas</td>
        <td data-name="nama_pegawai"></td>
      </tr>
      <tr>
        <td>Tgl Input</td>
        <td data-name="created_at"></td>
      </tr>
    </table>
  </div>
  <div class="actions">
    <button class="ui negative button">
      <i class="close icon"></i>Keluar</button>
  </div>
</div>

<div class="ui long small modal" id="modal-konsultasi-insert">
  <i class="close icon"></i>
  <div class="header"></div>
  <div class="content">
    <form id="form-konsultasi" class="ui equal width form" data-token="<?php echo e(csrf_token()); ?>" data-id="<?php echo e($rawat_jalan->id); ?>" action="<?php echo e(url('administrasi/rawat-jalan/simpan-konsultasi')); ?>">
      <?php echo csrf_field(); ?>

      <input type="hidden" name="id">
      <div class="two fields">
        <div class="field">
          <label>ID Rawat Jalan:</label>
          <input type="text" readonly value="<?php echo e($rawat_jalan->id); ?>" name="rawat_jalan_id">
        </div>
        <div class="required field">
          <label>Petugas Konsultasi:</label>
          <div id="pegawai-dropdown" class="ui fluid search normal selection dropdown">
            <input type="hidden" class="hidden-dropdown" name="pegawai_id">
            <i class="dropdown icon"></i>
            <div class="default text">Pilih Petugas</div>
          </div>
        </div>
      </div>

      <div class="required field">
        <label>Pemeriksaan Fisik:</label>
        <textarea rows="3" name="pemeriksaan_fisik"></textarea>
      </div>
      <div class="required field">
        <label>Anamesa / Diagnosa:</label>
        <textarea rows="3" name="diagnosa"></textarea>
      </div>
      <div class="required field">
        <label>Tindakan:</label>
        <textarea rows="3" name="tindakan"></textarea>
      </div>
      <div class="two fields">

        <div class="required field">
          <label>Ke Poli:</label>
          <div id="poli-dropdown" class="ui fluid search normal selection dropdown">
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
            <div class="default text">Masukkan Ke Poli</div>
            <div class="menu">
              <div class="item" data-value="Baru">Baru</div>
              <div class="item" data-value="Lama">Lama</div>
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
  <div class="actions">
    <button class="ui negative button">
      <i class="close icon"></i>Batal</button>
    <button class="ui submit positive approve button">
      <i class="icon save"></i>Simpan</button>
  </div>
</div>

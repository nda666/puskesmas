<div class="ui small modal" id="modal-resep-insert">
  <i class="close icon"></i>
  <div class="header"></div>
  <div class="content">
    <form id="form-resep" data-hapus="<?php echo e(url('/dokter/rawat-jalan/delete-resep')); ?>" class="ui small form" data-token="<?php echo e(csrf_token()); ?>" data-id="<?php echo e($rawat_jalan->id); ?>" action="<?php echo e(url('dokter/rawat-jalan/simpan-resep')); ?>">
      <?php echo csrf_field(); ?>

      <input type="hidden" name="id">
      <div class="field">
        <label>ID Rawat Jalan:</label>
        <input type="text" readonly value="<?php echo e($rawat_jalan->id); ?>" name="rawat_jalan_id">
      </div>
      <script type="text/javascript">
        $(document).ready(function(){
            $('#resep-dropdown').dropdown({
              apiSettings: {
                  url: $('#resep-dropdown').attr('data-source') + '?id='+ $('#resep-dropdown').attr('data-id') +'&find={query}'
              }
            });
        });
      </script>
      <div class="required field">
        <label>Resep:</label>
        <div id="resep-dropdown" data-id="<?php echo e($rawat_jalan->id); ?>" data-source="<?php echo e(url('/dokter/rawat-jalan/list-obat')); ?>" class="ui multiple search selection dropdown">
          <input name="obat_id" type="hidden">
          <i class="dropdown icon"></i>
          <input class="search" autocomplete="on" tabindex="0">
          <div class="default text">Pilih Nama Obat</div>
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

<?php $__env->startSection('title','Konsultasi Pasien: '.$rawat_jalan->pasien->nama); ?>
<?php $__env->startSection('content_title','Manage Pasien Sudah Konsultasi'); ?>
<?php $__env->startSection('content_sub_title', 'Lihat detil data konsultasi pasien dan batalkan kirim data ke Poli'); ?>
<?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
  <i class="icon treatment"></i>
  <i class="icon corner green check"></i>
</i>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
<div class="ui blue top attached segment breadcrumb">
  <div class="ui breadcrumb">
    <a href="<?php echo e(url('administrasi')); ?>" class="section">
      <i class="icon home"></i>Home</a>
    <i class="right chevron icon divider"></i>
    <a href="<?php echo e(url('administrasi/sudah-konsultasi/')); ?>" class="section">
      <i class="icon treatment"></i>Sudah Konsultasi</a>
    <i class="right chevron icon divider"></i>
    <div class="active section">
      <i class="icon edit"></i>Manage</div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('stylesheet'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTables.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Scroller/css/scroller.dataTables.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/css/animate.css')); ?>">
  <style type="text/css">
  .ui.small.modal>.close {
    top: 0.7rem !important;
    right: 0.5rem !important;
    z-index: 200 !important;
    color: #333 !important;
  }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jszip/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Scroller/js/dataTables.scroller.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.print.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Select/js/dataTables.select.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/serialize-object.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/view-rawat-jalan.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="ui grid">
  <div class="sixteen wide computer column">
    <div id="tab-rawat-jalan" class="ui small four fluid steps">
      <a class="step" data-tab="data-pasien">
        <i class="user icon"></i>
        <div class="content">
          <div class="title">Administrasi</div>
          <div class="description">Detail Data Pasien</div>
        </div>
      </a>
      <a class="step" data-tab="data-konsultasi">
        <i class="treatment icon"></i>
        <div class="content">
          <div class="title">Konsultasi</div>
          <div class="description">Data Konsultasi Pasien</div>
        </div>
      </a>
      <a class="step" data-tab="data-resep">
        <i class="file text outline icon"></i>
        <div class="content">
          <div class="title">Resep</div>
          <div class="description">Data Resep Pasien</div>
        </div>
      </a>
      <a class="step" data-tab="data-obat">
        <i class="first aid icon"></i>
        <div class="content">
          <div class="title">Obat</div>
          <div class="description">Data Obat Pasien</div>
        </div>
      </a>
    </div>
  </div>
  <div class="sixteen wide column">
    <div class="ui attached tab segment" data-tab="data-pasien">
      <table id="data-pasien" class="ui definition table">
        <?php /* NAMA PASIEN */ ?>
        <tr>
          <td class="six wide">Nama Pasien</td>
          <td><?php echo e($rawat_jalan->pasien->nama); ?></td>
        </tr>
        <?php /* NAMA KEPALA KELUARGA */ ?>
        <tr>
          <td>Nama Kepala Keluarga</td>
          <td><?php echo e($rawat_jalan->pasien->kepala_keluarga); ?></td>
        </tr>
        <?php /* JENIS KELAMIN */ ?>
        <tr>
          <td>Jenis Kelamin</td>
          <td><?php echo e($rawat_jalan->pasien->jenis_kelamin); ?></td>
        </tr>
        <?php /* TANGGAL LAHIR */ ?>
        <tr>
          <td>Tanggal Lahir</td>
          <td><?php echo e(\Date::parse($rawat_jalan->pasien->tgl_lahir)->format('j F Y')); ?></td>
        </tr>
        <?php /* PEKERJAAN */ ?>
        <tr>
          <td>Pekerjaan</td>
          <td><?php echo e($rawat_jalan->pasien->pekerjaan); ?></td>
        </tr>
        <?php /* UMUR */ ?>
        <tr>
          <td>Umur</td>
          <td><?php echo e(get_umur($rawat_jalan->pasien->tgl_lahir->format('Y-m-d'))); ?></td>
        </tr>
        <?php /* ALAMAT */ ?>
        <tr>
          <td>Alamat</td>
          <td><?php echo e($rawat_jalan->pasien->alamat); ?></td>
        </tr>
        <?php /* AGAMA */ ?>
        <tr>
          <td>Agama</td>
          <td><?php echo e($rawat_jalan->pasien->agama); ?></td>
        </tr>
        <?php /* KUNJUNGAN */ ?>
        <tr>
          <td>Kunjungan</td>
          <td><?php echo e($rawat_jalan->kunjungan); ?></td>
        </tr>
        <?php /* KUNJUNGAN */ ?>
        <tr>
          <td>Kepesertaan</td>
          <td><?php echo e($rawat_jalan->kepesertaan); ?></td>
        </tr>
        <tr>
          <td>Tanggal Masuk</td>
          <td><?php echo e(\Date::parse($rawat_jalan->pasien->created_at)->format('j F Y')); ?></td>
        </tr>
        <tr>
          <td>Petugas Administrasi</td>
          <td><?php echo e($rawat_jalan->petugas->nama); ?></td>
        </tr>
      </table>
    </div>
    <div class="ui active tab vertical segment" data-tab="data-konsultasi">
      <div class="datatable-container">
        <table
          id="data-konsultasi"
          class="ui table"
          data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
          data-pasien="<?php echo e($rawat_jalan->pasien->id); ?>"
          data-token="<?php echo e(csrf_token()); ?>"
          data-source="<?php echo e(url('administrasi/rawat-jalan/data-konsultasi/'.$rawat_jalan->id)); ?>">
          <thead>
            <th>ID</th>
            <th>Pemeriksaan Fisik</th>
            <th>Diagnosa</th>
            <th>Tindakan</th>
            <th>Poli</th>
            <th>Petugas</th>
            <th>Tgl Konsultasi</th>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <?php /* Data Resep */ ?>
    <div class="ui tab vertical segment" data-tab="data-resep">
      <div class="datatable-container">
        <table
          id="data-konsultasi"
          class="ui table"
          data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
          data-pasien="<?php echo e($rawat_jalan->pasien->id); ?>"
          data-token="<?php echo e(csrf_token()); ?>"
          data-source="<?php echo e(url('administrasi/rawat-jalan/data-konsultasi/'.$rawat_jalan->id)); ?>">
          <thead>
            <th>ID</th>
            <th>Pemeriksaan Fisik</th>
            <th>Diagnosa</th>
            <th>Tindakan</th>
            <th>Poli</th>
            <th>Petugas</th>
            <th>Tgl Konsultasi</th>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>

    <div class="ui tab vertical segment" data-tab="data-obat">
      <div class="datatable-container">
        <table
          id="data-konsultasi"
          class="ui table"
          data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
          data-pasien="<?php echo e($rawat_jalan->pasien->id); ?>"
          data-token="<?php echo e(csrf_token()); ?>"
          data-source="<?php echo e(url('administrasi/rawat-jalan/data-konsultasi/'.$rawat_jalan->id)); ?>">
          <thead>
            <th>ID</th>
            <th>Pemeriksaan Fisik</th>
            <th>Diagnosa</th>
            <th>Tindakan</th>
            <th>Poli</th>
            <th>Petugas</th>
            <th>Tgl Konsultasi</th>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal Update-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
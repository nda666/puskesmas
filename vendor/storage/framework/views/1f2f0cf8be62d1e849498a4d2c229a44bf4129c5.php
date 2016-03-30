 <?php $__env->startSection('title','Rawat Jalan Pasien: '.$rawat_jalan->pasien->nama); ?> <?php $__env->startSection('content_title','Rawat Jalan Pasien'); ?> <?php $__env->startSection('content_sub_title', 'Management Konsultasi, Tindakan, Resep, dan Progres Pasien'); ?> <?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
  <i class="icon user"></i>
<i class="icon corner red heart"></i>
</i>
<?php $__env->stopSection(); ?> <?php $__env->startSection('breadcrumbs'); ?>
<div class="ui top attached panel-header segment">
  <div class="ui grid">
    <div class="six wide column computer">
      <b><?php echo e($rawat_jalan->pasien->nama); ?>,</b> Status Rawat Jalan: <?php if($rawat_jalan->progres == 0): ?>
      <span id="status-rawat-jalan" class="ui red horizontal label">Belum</span> <?php else: ?>
      <span id="status-rawat-jalan" class="ui green horizontal label">Sudah</span> <?php endif; ?>
    </div>
    <div class="right aligned ten wide column computer">
      <div class="ui breadcrumb">
        <a href="<?php echo e(url('administrasi')); ?>" class="section">
          <i class="icon black home"></i>Home</a>
        <span class="divider">/</span>
        <a href="<?php echo e(url('administrasi/rawat-jalan')); ?>" class="section">
          <i class="icon red heart"></i>Rawat Jalan</a>
        <span class="divider">/</span>
        <div class="section">
          <i class="icon edit"></i>Manage</div>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTablesMod.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/css/animate.css')); ?>">
<style type="text/css">
  .ui.small.modal>.close {
    top: 0.7rem !important;
    right: 0.5rem !important;
    z-index: 200 !important;
    color: #333 !important;
  }

  #status-rawat-jalan {
    -webkit-transition: background 1s 0.5s ease;
    transition: background 1s 0.5s ease;
  }

</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('javascript'); ?>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-address/jquery.address-1.5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jszip/jszip.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/serialize-object.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/view-rawat-jalan.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/view-rawat-jalan-resep.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/js/administrasi/view-rawat-jalan-tindakan.js')); ?>"></script>

<?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<div class="sixteen wide column no bottom padding">
  <div id="tab-rawat-jalan" class="ui stackable five item menu">
    <a class="item" data-tab="data-pasien">
      <i class="user icon"></i>Pasien
    </a>
    <a class="item" data-tab="data-konsultasi">
      <i class="treatment icon"></i>Konsultasi
    </a>
    <a class="item" data-tab="data-tindakan">
      <i class="doctor icon"></i>Tindakan
    </a>
    <a class="item" data-tab="data-resep">
      <i class="file text outline icon"></i>Resep
    </a>
    <?php if($rawat_jalan->progres == 0): ?>
    <a class="link green item" data-token="<?php echo e(csrf_token()); ?>" data-id="<?php echo e($rawat_jalan->id); ?>" data-action="<?php echo e(url('/administrasi/rawat-jalan/selesai')); ?>" title="Tandai Selesai Rawat Jalan ini" data-progres="1" data-force="false" id="selesai-rawat-jalan"><i class="check icon"></i>Selesai Rawat Jalan</a> <?php else: ?>
    <a class="link red item" data-action="<?php echo e(url('/administrasi/rawat-jalan/selesai')); ?>" data-token="<?php echo e(csrf_token()); ?>" data-id="<?php echo e($rawat_jalan->id); ?>" title="Tandai Selesai Rawat Jalan ini" data-progres="0" data-force="true" id="selesai-rawat-jalan"><i class="close icon"></i>Batalkan Selesai</a> <?php endif; ?>
  </div>

  <div class="ui tab  vertical segment" data-tab="data-pasien">

    <div class="ui grid">

      <div class="eight wide column">
        <div class="ui relaxed divided list">
          <div class="item">
            <div class="header">Nama Pasien</div>
            <?php echo e($rawat_jalan->pasien->nama); ?>

          </div>
          <div class="item">
            <div class="header">Nomor Kartu Keluarga</div>
            <?php echo e($rawat_jalan->pasien->no_kartu_keluarga); ?>

          </div>
          <div class="item">
            <div class="header">Nama Kepala Keluarga</div>
            <?php echo e($rawat_jalan->pasien->kepala_keluarga); ?>

          </div>
          <div class="item">
            <div class="header">Jenis Kelamin</div>
            <?php echo e($rawat_jalan->pasien->jenis_kelamin); ?>

          </div>
          <div class="item">
            <div class="header">Tanggal Lahir</div>
            <?php echo e(\Date::parse($rawat_jalan->pasien->tgl_lahir)->format('j F Y')); ?>

          </div>
          <div class="item">
            <div class="header">Pekerjaan</div>
            <?php echo e($rawat_jalan->pasien->pekerjaan); ?>

          </div>
          <div class="item">
            <div class="header">
              Umur</div>
            <?php echo e(get_umur($rawat_jalan->pasien->tgl_lahir->format('Y-m-d'))); ?>

          </div>
        </div>
      </div>
      <div class="eight wide column">
        <div class="ui relaxed divided list">
          <div class="item">
            <div class="header">
              Alamat</div>
            <?php echo e($rawat_jalan->pasien->alamat); ?>

          </div>
          <?php /* AGAMA */ ?>
          <div class="item">
            <div class="header">
              Agama</div>
            <?php echo e($rawat_jalan->pasien->agama); ?>

          </div>
          <?php /* KUNJUNGAN */ ?>
          <div class="item">
            <div class="header">
              Kunjungan</div>
            <?php echo e($rawat_jalan->kunjungan); ?>

          </div>
          <?php /* KUNJUNGAN */ ?>
          <div class="item">
            <div class="header">
              Kepesertaan</div>
            <?php echo e($rawat_jalan->kepesertaan); ?>

          </div>
          <div class="item">
            <div class="header">
              Tanggal Daftar</div>
            <?php echo e(\Date::parse($rawat_jalan->pasien->created_at)->format('l, j F Y')); ?>

          </div>
          <div class="item">
            <div class="header">
              Jam</div>
            <?php echo e($rawat_jalan->pasien->created_at->format('H:i')); ?>

          </div>
          <div class="item">
            <div class="header">
              Petugas Administrasi</div>
            <?php echo e($rawat_jalan->petugas->nama); ?>

          </div>
        </div>
      </div>
    </div>
  </div>

  <?php /* Data Konsultasi */ ?>
  <div class="ui active tab vertical segment" data-tab="data-konsultasi">
    <div class="datatable-container">
      <table id="data-konsultasi" class="ui definition padded unstackable celled table" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>" data-id="<?php echo e($rawat_jalan->id); ?>" data-token="<?php echo e(csrf_token()); ?>" width="100%" data-hapus="<?php echo e(url('/administrasi/rawat-jalan/delete-konsultasi')); ?>" data-source="<?php echo e(url('administrasi/rawat-jalan/data-konsultasi/'.$rawat_jalan->id)); ?>">
        <thead>
          <tr>
            <th></th>
            <th>ID</th>
            <th>Pemeriksaan Fisik</th>
            <th>Diagnosa</th>
            <th>Kasus</th>
            <th>Poli</th>
            <th>Keterangan</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    <?php echo $__env->make('administrasi.rawat-jalan.form.konsultasi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>

  <?php /* Data Tindakan */ ?>
  <div class="ui tab vertical segment" data-tab="data-tindakan">
    <?php echo $__env->make('administrasi.rawat-jalan.form.tindakan', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>

  <?php /* Data Resep */ ?>
  <div class="ui tab vertical segment" data-tab="data-resep">
    <div class="datatable-container">
      <table id="data-konsultasi-resep" class="ui definition celled table" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>" data-pasien="<?php echo e($rawat_jalan->pasien->id); ?>" data-token="<?php echo e(csrf_token()); ?>" width="100%" data-source="<?php echo e(url('administrasi/rawat-jalan/data-resep/'.$rawat_jalan->id)); ?>">
        <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Resep</th>
          <th>Petugas</th>
          <th>Tgl. Input</th>
          <th>Action</th>
        </thead>
        </tr>
        <tbody></tbody>
      </table>
    </div>
    <?php echo $__env->make('administrasi.rawat-jalan.form.resep', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  </div>
</div>

<!-- Modal Update-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrasi.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
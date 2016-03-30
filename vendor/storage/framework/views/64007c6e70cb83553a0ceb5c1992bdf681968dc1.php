 <?php $__env->startSection('title','Rawat Jalan'); ?> <?php $__env->startSection('content_title','Rawat Jalan'); ?> <?php $__env->startSection('content_sub_title', 'List Pasien Sedang Rawat Jalan'); ?> <?php $__env->startSection('content_title_icon'); ?>
<i class="big icons">
    <i class="icon user">
    </i>
<i class="icon corner red heart">
    </i>
</i>
<?php $__env->stopSection(); ?> <?php $__env->startSection('breadcrumbs'); ?>
  <div class="ui top attached panel-header segment">
    <div class="ui grid">
      <div class="six wide column computer">
        <b>List Rawat Jalan</b>
      </div>
      <div class="right aligned ten wide column computer">
        <div class="ui breadcrumb">
          <a href="<?php echo e(url('dokter')); ?>" class="section">
            <i class="icon black home"></i>Home</a>
          <span class="divider">/</span>
          <a href="<?php echo e(url('dokter/rawat-jalan')); ?>" class="section">
            <i class="icon red heart"></i>Rawat Jalan</a>
          <span class="divider">/</span>
          <div class="section">
            <i class="icon edit"></i>Manage</div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?> <?php $__env->startSection('stylesheet'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/media/css/jquery.dataTablesMod.min.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css')); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css')); ?>">

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css')); ?>">

<style type="text/css">
  .ui.small.modal> .close {
    top: 0.7rem !important;
    right: 0.5rem !important;
    z-index: 200 !important;
    color: #333 !important;
  }

</style>
<?php $__env->stopSection(); ?> <?php $__env->startSection('javascript'); ?>

<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/jquery.dataTables.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/media/js/dataTables.semantic.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js')); ?>">
</script>


<script type="text/javascript" src="<?php echo e(asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js')); ?>">
</script>

<script type="text/javascript" src="<?php echo e(asset('/assets/yadcf/jquery.dataTables.yadcf.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js')); ?>"></script>
<script src="<?php echo e(asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js')); ?>" type="text/javascript"></script>

<script type="text/javascript">
var table = $('#rawat-jalan').DataTable({
ajax: {
  url: $('#rawat-jalan').data('source'),
},
language: {
  url: $('#rawat-jalan').data('lang')
},
lengthMenu: [
  [10, 25, 100, 200, 500, -1],
  [10, 25, 100, 200, 500, 'Semua'],
],
searchDelay: 1000,
stateSave: true,
scrollY: '60vh',
scrollCollapse: true,
scrollX: true,
dom: "<'left no padding-bottom floated aligned sixteen wide mobile eight wide computer column'l><'right no padding-bottom aligned sixteen wide mobile eight wide computer column'f>" + "<'ui button-container sixteen wide tablet ten wide toolbars column'>" +
  "<'sixteen wide column no padding top bottom'tr>" + "<'sixteen wide mobile four wide computer column'i><'right aligned sixteen wide mobile twelve wide computer column'p>",
processing: true,
pagingType: 'numbers',
serverSide: true,
filter: true,
sort: true,
info: true,
order: [[ 3, "desc" ]],
columns: [{
  data: "id",
  name: 'pasien.id',
}, {
  data: 'nama',
  name: 'nama',
}, {
  data: 'jenis_kelamin',
  name: 'jenis_kelamin',
  className: 'text-center'
}, {
  data: 'tgl_daftar',
  name: 'rawat_jalan.created_at',
  searchable: false
}, {
  data: 'jam',
  name: 'jam',
  className: 'text-center'
}, {
  data: 'kepala_keluarga',
  name: 'kepala_keluarga',
}, {
  data: 'no_kartu_keluarga',
  name: 'no_kartu_keluarga'
}, {
  data: "action",
  name: 'action',
  searchable: false,
  sortable: false,
  className: 'text-center'
}, ],
drawCallback: function() {$('.ui .button').popup();},
});
table.on('init.dt', function() {
$('.dataTables_filter').addClass('ui datatables-search input');
yadcf.init(table, [{
  column_number: 0,
  filter_type: 'text',
  filter_reset_button_text: false
}, {
  column_number: 1,
  filter_type: 'text',
  filter_reset_button_text: false
},  {
  column_number: 2,
  filter_type: 'select',
  filter_reset_button_text: false,
  data: [{
    value: 'Laki-Laki',
    label: 'Laki-Laki'
  }, {
    value: 'Perempuan',
    label: 'Perempuan'
  }]
}, {
  column_number: 3,
  filter_type: 'range_date',
  date_format: 'yyyy-mm-dd',
  filter_reset_button_text: false
}, {
  column_number: 5,
  filter_type: 'text',
  filter_reset_button_text: false
},  {
  column_number: 6,
  filter_type: 'text',
  filter_reset_button_text: false
}, ]);
$('.yadcf-filter-wrapper').addClass('ui datatables-search input').css({
  'display': 'flex',
});
$('#yadcf-filter-wrapper--rawat-jalan-1 input').css('width', '60px');
$('#yadcf-filter-wrapper--rawat-jalan-2 input').css('width', '60px');
$('#yadcf-filter-wrapper--rawat-jalan-3 input').css('width', '100px');
$('#yadcf-filter-wrapper--rawat-jalan-4 input').css('width', '80px');
$('#yadcf-filter-wrapper--rawat-jalan-5 input').css('width', '80px');
$('#yadcf-filter-wrapper--rawat-jalan-7 input').css('width', '100px');
$('#yadcf-filter-wrapper--rawat-jalan-8 input').css('width', '100px');

$('.yadcf-filter-wrapper button').html('<i class="close icon"></i>')
$('.yadcf-filter-wrapper button').addClass('ui icon basic button');
new $.fn.dataTable.Buttons(table, {
  dom: {
    container: {
      tag: 'div',
      className: 'ui basic toolbar-button right floated buttons'
    },
    collection: {
      tag: 'div',
      className: 'dt-button-collection'
    },
    button: {
      tag: 'a',
      className: 'ui toggle tiny icon button',
      active: 'active',
      disabled: 'disabled'
    },
    buttonLiner: {
      tag: 'span',
      className: ''
    }
  },
  buttons: [{
    text: '<i class="icon refresh"></i>Refresh',
    className: 'refresh-btn',
    action: function (e, dt, node, config) {
      table.ajax.reload();
    }
  },  {
    text: '<i class="clockwise search icon"></i>Cari',
    className: 'search-btn',
    action: function (e, dt, node) {
      $(node).toggleClass('active').removeClass('toggle');
      if (!$(node).hasClass('active')) {
        $('[id^=yadcf]').hide();
      } else {
        $('[id^=yadcf]').show();
      }
      table.columns.adjust();
    }
        }, {
    text: '<i class="undo icon"></i>Clear',
    className: 'clear-search-btn',
    action: function (e, dt, node) {
      yadcf.exResetAllFilters(table)
      table.columns.adjust();
    }
    }, ],
});
$('[id^=yadcf]').hide();

table.buttons(0, 1).container().prependTo($('.toolbars'));
$(window).trigger('resize');
});

</script>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="sixteen wide column">
<div class="datatable-container">
  <table id="rawat-jalan" class="ui unstackable celled table" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>" data-token="<?php echo e(csrf_token()); ?>" width="100%" data-source="<?php echo e(url('dokter/rawat-jalan/data-index?progres=0')); ?>">
    <thead>
      <tr>
        <th class="collapsing">ID</th>
        <th>Nama</th>
        <th>Gender</th>
        <th>Tgl. Daftar</th>
        <th>Jam</th>
        <th>Kepala Keluarga</th>
        <th>No. KK</th>
        <th class="center aligned collapsing">Action</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dokter.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
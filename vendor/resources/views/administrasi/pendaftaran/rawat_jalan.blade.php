@extends('administrasi.default') @section('title','Pendaftaran Anggota & Rawat Jalan') @section('content_title','Pendaftaran Anggota & Rawat Jalan') @section('content_sub_title', 'Pendaftaran Anggota Baru dan Pendaftaran Rawat Jalan') @section('content_title_icon')
<i class="big icons">
<i class="icon user"></i>
<i class="icon corner file text outline"></i>
</i>
@stop @section('breadcrumbs')
<div class="ui top attached panel-header segment">
  <div class="ui grid">
    <div class="six wide column computer">
      <b>List Anggota/Pasien Terdata</b>
    </div>
    <div class="right aligned ten wide column computer">
      <div class="ui breadcrumb">
        <a href="{{ url('administrasi') }}" class="section">
          <i class="icon black home"></i>Home</a>
        <span class="divider">/</span>
        <div class="active section">
          <i class="icon user"></i>Pasien
        </div>
      </div>
    </div>
  </div>
</div>
@stop @section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.theme.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/yadcf/jquery.dataTables.yadcf.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/media/css/jquery.dataTablesMod.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Scroller/css/scroller.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/FixedHeader/css/fixedHeader.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/media/css/dataTables.responsive.min.css') }}">
<style type="text/css">
  .ui.modal>.close {
    top: 0.7rem !important;
    right: 0.5rem !important;
    z-index: 200 !important;
    color: #333 !important;
  }

</style>
@stop @section('javascript')

<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/dataTables.semantic.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/serialize-object.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/yadcf/jquery.dataTables.yadcf.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/administrasi/pendaftaran-rawat-jalan.min.js') }}"></script>
@stop @section('content')
<div class="sixteen wide column">
<div class="datatable-container">

    <style>
      table th {
        word-break: normal;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
      }

    </style>
    <table width="100%" id="data-pasien" class="ui definition unstackable celled table" data-token="{{ csrf_token() }}" data-lang="{{ asset('/assets/datatables/i18n/indonesian.json') }}" data-delete="{{ url('administrasi/pendaftaran/delete-pasien') }}" data-update="{{ url('administrasi/pendaftaran/data-pasien') }}" data-source="{{ url('administrasi/pendaftaran/list-pasien') }}">
      <thead>
        <tr>
          <th class="collapsing"></th>
          <th>ID</th>
          <th>Nama</th>
          <th>Kepala Keluarga</th>
          <th>No. KK</th>
          <th>Gender</th>
          <th class="active">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>

  </div>
  <!-- Modal Pendaftaran Baru -->
  <div id="pendaftaran-baru" class="ui small modal">
    <div class="header">Pendaftaran Baru</div>
    <i class="link close icon"></i>
    <div class="content">
      @include('administrasi.pendaftaran.form-baru')
    </div>
    <div class="actions">
      <div class="ui cancel negative button"><i class="close icon"></i>Batal</div>
      <div class="ui approve positive button"><i class="save icon"></i>Simpan</div>
    </div>
  </div>
  {{-- Modal Lihat Data Pasien --}}

  <div id="view-data" class="ui small modal">
    <div class="header">Detail Pasien / Anggota</div>
    <i class="link close icon"></i>
    <div class="content">
      <table class="ui definition table">
        <tbody>
          <tr>
            <td style="width=30%">ID</td>
            <td data-list="id"></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td data-list="nama"></td>
          </tr>
          <tr>
            <td>Kepala Keluarga</td>
            <td data-list="kepala_keluarga"></td>
          </tr>
          <tr>
            <td>No. KK</td>
            <td data-list="no_kartu_keluarga"></td>
          </tr>
          <tr>
            <td>Pekerjaan</td>
            <td data-list="pekerjaan"></td>
          </tr>
          <tr>
            <td>Tgl. Lahir</td>
            <td data-list="tgl_lahir"></td>
          </tr>
          <tr>
            <td>Gender</td>
            <td data-list="jenis_kelamin"></td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td data-list="alamat"></td>
          </tr>
          <tr>
            <td>Tgl. Buat</td>
            <td data-list="created_at"></td>
          </tr>
          <tr>
            <td>Tgl. Ubah</td>
            <td data-list="updated_at"></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="actions">
      <div class="ui cancel negative button"><i class="close icon"></i>Keluar</div>
    </div>
  </div>
  <!-- Modal Ubah data pasien -->

  <div id="ubah-data" class="ui small modal">
    <div class="header">Pendaftaran Baru</div>
    <i class="link close icon"></i>
    <div class="content">
      @include('administrasi.pendaftaran.form-ubah')
    </div>
    <div class="actions">
      <div class="ui cancel negative button"><i class="close icon"></i>Batal</div>
      <div class="ui approve positive button"><i class="save icon"></i>Simpan</div>
    </div>
  </div>

  <!-- Modal Daftar Rawat Jalan pasien -->

  <div id="daftar-rawat-jalan" class="ui small basic modal">
    <div class="content">
      <div style="width: 350px; margin: 0 auto;" class="ui segment">
        <h3 class="ui dividing modal-header header">Pendaftaran Rawat Jalan</h3>
        <i class="close black link icon closer-modal"></i>
          @include('administrasi.pendaftaran.form-rawat-jalan')
      </div>
    </div>
  </div>
</div>
@stop

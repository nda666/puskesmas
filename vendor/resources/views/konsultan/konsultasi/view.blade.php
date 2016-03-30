@extends('konsultan.default') @section('title','Rawat Jalan Pasien: '.$rawat_jalan->pasien->nama) @section('content_title','Rawat Jalan Pasien') @section('content_sub_title', 'Management Konsultasi, Resep & Obat Pasien') @section('content_title_icon')
<i class="big icons">
  <i class="icon user"></i>
<i class="icon corner red heart"></i>
</i>
@stop @section('breadcrumbs')
<div class="ui top attached panel-header segment">
  <div class="ui grid">
    <div class="six wide column computer">
      <b>{{$rawat_jalan->pasien->nama}}, </b>Status Rawat Jalan: @if($rawat_jalan->progres == 0)
      <span id="status-rawat-jalan" class="ui red horizontal label">Belum</span> @else
      <span id="status-rawat-jalan" class="ui green horizontal label">Sudah</span> @endif
    </div>
    <div class="right aligned ten wide column computer">
      <div class="ui breadcrumb">
        <a href="{{ url('konsultan') }}" class="section">
          <i class="icon black home"></i>Home</a>
        <span class="divider">/</span>
        <a href="{{ url('konsultan/rawat-jalan') }}" class="section">
          <i class="icon red heart"></i>Rawat Jalan</a>
        <span class="divider">/</span>
        <div class="section">
          <i class="icon edit"></i>Manage</div>
      </div>
    </div>
  </div>
</div>
@stop @section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/yadcf/jquery.dataTables.yadcf.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/media/css/jquery.dataTablesMod.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Buttons/css/buttons.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/datatables/extensions/ColReorder/css/colReorder.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/animate.css') }}">
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
@stop @section('javascript')
<script type="text/javascript" src="{{ asset('/assets/jquery-address/jquery.address-1.5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jszip/jszip.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/dataTables.semantic.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/dataTables.buttons.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/buttons.print.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/buttons.html5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Buttons/js/buttons.colVis.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/extensions/Select/js/dataTables.select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/serialize-object.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-ui-1.11.4/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/yadcf/jquery.dataTables.yadcf.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/jquery.inputmask.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/jquery-input-mask/min/inputmask/inputmask.date.extensions.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/js/administrasi/view-rawat-jalan.min.js') }}"></script>

@stop @section('content')
<div class="sixteen wide column no bottom padding">
  <div id="tab-rawat-jalan" class="ui stackable two item menu">
    <a class="item" data-tab="data-pasien">
      <i class="user icon"></i>Pasien
    </a>
    <a class="item" data-tab="data-konsultasi">
      <i class="treatment icon"></i>Konsultasi
    </a>
  </div>

  <div class="ui tab  vertical segment" data-tab="data-pasien">

    <div class="ui grid">

      <div class="eight wide column">
        <div class="ui relaxed divided list">
          <div class="item">
            <div class="header">Nama Pasien</div>
            {{ $rawat_jalan->pasien->nama }}
          </div>
          <div class="item">
            <div class="header">Nomor Kartu Keluarga</div>
            {{ $rawat_jalan->pasien->no_kartu_keluarga }}
          </div>
          <div class="item">
            <div class="header">Nama Kepala Keluarga</div>
            {{ $rawat_jalan->pasien->kepala_keluarga }}
          </div>
          <div class="item">
            <div class="header">Jenis Kelamin</div>
            {{ $rawat_jalan->pasien->jenis_kelamin }}
          </div>
          <div class="item">
            <div class="header">Tanggal Lahir</div>
            {{ \Date::parse($rawat_jalan->pasien->tgl_lahir)->format('j F Y') }}
          </div>
          <div class="item">
            <div class="header">Pekerjaan</div>
            {{ $rawat_jalan->pasien->pekerjaan }}
          </div>
          <div class="item">
            <div class="header">
              Umur</div>
            {{ get_umur($rawat_jalan->pasien->tgl_lahir->format('Y-m-d')) }}
          </div>
        </div>
      </div>
      <div class="eight wide column">
        <div class="ui relaxed divided list">
          <div class="item">
            <div class="header">
              Alamat</div>
            {{ $rawat_jalan->pasien->alamat }}
          </div>
          {{-- AGAMA --}}
          <div class="item">
            <div class="header">
              Agama</div>
            {{ $rawat_jalan->pasien->agama }}
          </div>
          {{-- KUNJUNGAN --}}
          <div class="item">
            <div class="header">
              Kunjungan</div>
            {{ $rawat_jalan->kunjungan }}
          </div>
          {{-- KUNJUNGAN --}}
          <div class="item">
            <div class="header">
              Kepesertaan</div>
            {{ $rawat_jalan->kepesertaan }}
          </div>
          <div class="item">
            <div class="header">
              Tanggal Daftar</div>
            {{ \Date::parse($rawat_jalan->pasien->created_at)->format('l, j F Y') }}
          </div>
          <div class="item">
            <div class="header">
              Jam</div>
            {{ $rawat_jalan->pasien->created_at->format('H:i') }}
          </div>
          <div class="item">
            <div class="header">
              Petugas Administrasi</div>
            {{ $rawat_jalan->petugas->nama }}
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Data Konsultasi --}}
  <div class="ui active tab vertical segment" data-tab="data-konsultasi">
    <div class="datatable-container">
      <table id="data-konsultasi" class="ui striped single line celled table" data-lang="{{ asset('/assets/datatables/i18n/indonesian.json')}}" data-id="{{ $rawat_jalan->id }}" data-token="{{ csrf_token() }}" width="100%" data-hapus="{{ url('/konsultan/rawat-jalan/delete-konsultasi') }}" data-source="{{ url('konsultan/rawat-jalan/data-konsultasi/'.$rawat_jalan->id) }}">
        <thead>
          <tr>
            <th class="collapsing"></th>
            <th class="collapsing">ID</th>
            <th>Pemeriksaan Fisik</th>
            <th>Diagnosa</th>
            <th>Kasus</th>
            <th>Poli</th>
            <th>Keterangan</th>
            <th class="collapsing">Action</th>
          </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
    @include('konsultan.konsultasi.form')
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

</div>

<!-- Modal Update-->
@stop

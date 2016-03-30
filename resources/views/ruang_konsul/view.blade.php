@extends('default')
@section('content_title')
<i class="treatment huge icon"></i>
<div class="content">
	Ruang Konsul
	<div class="sub header">Detail Konsultasi Pasien</div>
</div>
@stop
{{-- BREADCRUBMS --}}
@section('breadcrumbs')
<div class="ui breadcrumb">
	<div class="ui breadcrumb">
		<a class="section">Home</a>
		<i class="right chevron icon divider"></i>
		<a href="{{ route('ruang-konsul') }}" class="section">Ruang Konsultasi</a>
		<i class="right arrow icon divider"></i>
		<div class="active section">Details</div>
	</div>
</div>
@stop


@section('content')
<div class="ui vertical segment">
	@foreach ($obj_ruang_konsul as $ruang_konsul)
	<h3 class="ui header">Data Pasien</h3>
	<table class="ui definition table">
		{{-- NAMA PASIEN --}}
		<tr>
			<td class="six wide">Nama Pasien</td>
			<td>{{ $ruang_konsul->pasien->nama_pasien }}</td>
		</tr>
		{{-- NAMA KEPALA KELUARGA --}}
		<tr>
			<td>Nama Kepala Keluarga</td>
			<td>{{ $ruang_konsul->pasien->nama_kepala_keluarga }}</td>
		</tr>
		{{-- JENIS KELAMIN --}}
		<tr>
			<td>Jenis Kelamin</td>
			<td>{{ $ruang_konsul->pasien->jenis_kelamin }}</td>
		</tr>
		{{-- TANGGAL LAHIR --}}
		<tr>
			<td>Tanggal Lahir</td>
			<td>{{ $ruang_konsul->pasien->tgl_lahir->format('d-m-Y') }}</td>
		</tr>
		{{-- PEKERJAAN --}}
		<tr>
			<td>Pekerjaan</td>
			<td>{{ $ruang_konsul->pasien->pekerjaan }}</td>
		</tr>
		{{-- UMUR --}}
		<tr>
			<td>Umur</td>
			<td>{{ $ruang_konsul->pasien->umur }}</td>
		</tr>
		{{-- ALAMAT --}}
		<tr>
			<td>Alamat</td>
			<td>{{ $ruang_konsul->pasien->alamat }}</td>
		</tr>
		{{-- AGAMA --}}
		<tr>
			<td>Agama</td>
			<td>{{ $ruang_konsul->pasien->agama }}</td>
		</tr>
	</table>
	<div class="ui horizontal section icon divider"><i class="icon user"></i></div>
	<h3 class="ui header">Data Konsultasi</h3>
	<table class="ui definition table">
		{{-- TANGGAL --}}
		<tr>
			<td class="six wide">Tanggal</td>
			<td>{{ $ruang_konsul->tanggal }}</td>
		</tr>
		{{-- JAM --}}
		<tr>
			<td>Jam</td>
			<td>{{ $ruang_konsul->jam }}</td>
		</tr>
		{{-- PEMERIKSAAN FISIK --}}
		<tr>
			<td>Pemeriksaan Fisik</td>
			<td>{{ $ruang_konsul->pemeriksaan_fisik }}</td>
		</tr>
		{{-- DIAGNOSA --}}
		<tr>
			<td>Diagnosa</td>
			<td>{{ $ruang_konsul->diagnosa }}</td>
		</tr>
		{{-- TINDAKAN --}}
		<tr>
			<td>Tindakan</td>
			<td>{{ $ruang_konsul->tindakan }}</td>
		</tr>
	</table>
	<div class="ui horizontal section icon divider"><i class="icon treatment"></i></div>
	@endforeach
	
</div>
@stop
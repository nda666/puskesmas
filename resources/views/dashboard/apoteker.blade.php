@extends('dashboard.dashboard_default')
@section('title','Dashboard')
@section('stylesheet')
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/media/css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/assets/datatables/extensions/Select/css/select.dataTables.min.css') }}">
<style type="text/css">
	table.nowarp tr > th, table.nowarp tr > td {
		white-space: nowrap;
	}
	div.dt-buttons {
		float: none !important;
	}
	table.dataTable thead > tr > th.sorting_asc, table.dataTable thead > tr > th.sorting_desc, table.dataTable thead > tr > th.sorting, table.dataTable thead > tr > td.sorting_asc, table.dataTable thead > tr > td.sorting_desc, table.dataTable thead > tr > td.sorting {
padding-right: 30px;
}
</style>
@stop
@section('javascript')
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/datatables/media/js/dataTables.semantic.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/flot/jquery.flot.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/flot/jquery.flot.pie.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/assets/flot/jquery.flot.categories.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/flot/jquery.flot.navigate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/flot/jquery.flot.threshold.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/dashboard.js') }}"></script>
@stop
@section('content')
<div class="ui grid">
	<!-- Pasien -->
	<div class="four columns row">
		<?php
		$color = ['blue', 'red', 'violet', 'teal'];
		$yNow = \Carbon\Carbon::now()->format('Y');
		$yPast = \Carbon\Carbon::now()->subMonths(12)->format('Y');
		?>
		@for ($i = 0; $i < count($count); $i++)
			<div class="column">
			<div style="padding: 0; border-radius: 0; margin-bottom: 5px;" class="ui segment">
				<div class="dashboard statistic">
					<?php $j = $i; ?>
					@while ($j > count($color))
						<?php $j = $j - count($color); ?>
					 @endwhile
					<div class="{{ $color[$j] }} box-icon">
						<i class="{{ $count[$i]['icon'] }} icon"></i>
					</div>
					<div class="content">
						<div class="label">
							{{$count[$i]['title']}}
						</div>
						<div class="value">
							{{$count[$i]['content']}}
						</div>
					</div>
				</div>
			</div>
	</div>
	@endfor
</div>
<div class="sixteen wide computer column">
	<h4 class="ui header top attached segment">Aktivitas Rawat Jalan</h4>
	<div class="ui attached segment">
		<p>Terdata dari Tahun {{ $yPast }} - {{ $yNow }}</p>
		<div>
			<div id="bar-chart" data-source="{{url('apoteker/dashboard/rawat-jalan')}}" style="height: 300px;"></div>
		</div>
	</div>
</div>
<div class="sixteen wide mobile sixteen wide tablet ten wide computer column">
	<h4 class="ui header top attached header">Pasien Sedang Rawat Jalan</h4>
	<div class="ui attached segment">
		<table id="table-pasien" width="100%" class="ui striped unstackable table" data-token="{{ csrf_token() }}" data-lang="{{ asset('/assets/datatables/i18n/indonesian.json') }}" data-source="{{ url('apoteker/dashboard/pasien-rawat-jalan') }}">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nama</th>
					<th>Gender</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="sixteen wide mobile sixteen wide tablet six wide computer column">
	<h4 class="ui header top attached header">Persentase Usia Rawat Jalan Pasien</h4>
	<div class="ui attached segment">
		<p>Terdata dari Tahun {{ $yPast }} - {{ $yNow }}</p>
		<div style="margin: 0 auto;">
			<div data-source="{{ url('apoteker/dashboard/usia-per-tahun') }}" id="pie-chart" style="height: 300px;">
			</div>
		</div>
	</div>
</div>
</div>
@stop

@section('sidebar')
@include('apoteker.sidebar')
@stop
@section('left-menu')
@include('apoteker.left-menu')
@stop
@section('navbar')
@include('apoteker.navbar')
@stop

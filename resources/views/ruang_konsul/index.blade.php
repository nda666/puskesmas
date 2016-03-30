@extends('default')
@section('title', 'Data Pasien')
@section('content_title','<i class="icon treatment"></i>Ruang Konsul')
@section('breadcrumbs')
<div class="ui breadcrumb">
	<div class="ui breadcrumb">
		<a class="section">Home</a>
		<i class="right arrow icon divider"></i>
		<div class="active section">Ruang Konsul</div>
	</div>
</div>
@stop
@section('content')
@if (isset($obj_ruang_konsul))
<div class="ui segments">
	{{-- TOOLBARS --}}
	<div class="ui segment">
		<div class="ui left labeled button" tabindex="0">
			<p class="ui basic right pointing label">
				Total Rows: {{ $obj_ruang_konsul->total_rows }}
			</p>
			<a href="{{ route('pasien/create') }}" class="ui positive button">
				<i class="plus icon"></i> Tambah Baru
			</a>
		</div>
	</div>
	{{-- MAIN CONTENT --}}
	<div class="ui segment table-container">
		<table id="table-ruang-konsul" class="ui definition celled sortable single line selectable compact table">
			<thead>
				<tr>
					<th></th>
					<th>ID</th>
					<th>ID Pasien</th>
					<th>Pasien</th>
					<th>Pemeriksaan Fisik</th>
					<th>Diagnosa</th>
					<th>Tindakan</th>
					<th>Tanggal</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach ($obj_ruang_konsul as $ruang_konsul)
				<tr>
					<td>
						<div class="ui small basic icon buttons">
							<a data-title="Ubah Data" data-content="Ubah" class="ui button" href="{{ route('ruang-konsul/view', $ruang_konsul->id) }}"><i class="icon eye"></i></a>
							<a data-title="Ubah Data" data-content="Ubah" class="ui button" href="{{ route('ruang-konsul') }}"><i class="icon edit"></i></a>
							<a data-title="Hapus Data" data-content="Delete" href="{{ route('ruang-konsul') }}" class="ui button confirm-delete"><i class="icon trash"></i></a>
						</div>
					</td>
					<td>{{ $ruang_konsul->id }}</td>
					<td>{{ $ruang_konsul->no_index }}</td>
					<td>{{ $ruang_konsul->pasien->nama_pasien }}</td>
					<td>{{ $ruang_konsul->pemeriksaan_fisik }}</td>
					<td>{{ $ruang_konsul->diagnosa }}</td>
					<td>{{ $ruang_konsul->tindakan }}</td>
					<td>{{ $ruang_konsul->tanggal->format('j F Y - H:i') }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div id="pagination" class="ui center aligned segment">
		{!! (new Landish\Pagination\SemanticUI($obj_ruang_konsul))->render() !!}
		<script type="text/javascript" charset="utf-8" async defer>
		$('#pagination a').on('click', function(e){
				e.preventDefault();
				var target = $(this).attr('href');
				$('#table-ruang-konsul').parents('.segments').append('<div class="ui active dimmer"><div class="ui indeterminate text loader">Menyiapkan Data</div></div>')
				$.ajax({
					url: target,
					dataType: 'html',
				})
				.done(function(data) {
					$('#table-ruang-konsul').html($(data).find('#table-ruang-konsul').html());
					$('#pagination').html($(data).find('#pagination').html())
				})
				.always(function(){
					$('#table-ruang-konsul').parents('.segments').find('.dimmer').remove();
				});
				
			})
		</script>
	</div>
</div>
@endif
@stop
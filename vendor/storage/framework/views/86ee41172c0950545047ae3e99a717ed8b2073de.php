<table style="width:100%;" id="data-pendaftar" class="cell-border nowarp row-border hover stripe"
	data-token="<?php echo e(csrf_token()); ?>" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
	data-source="<?php echo e(url('administrasi/json/pendaftar-today')); ?>">
	<thead>
		<th>ID</th>
		<th>Nama</th>
		<th>Kepala Keluarga</th>
		<th>Pekerjaan</th>
		<th>Tgl. Lahir</th>
		<th>Agama</th>
		<th>Gender</th>
		<th>Alamat</th>
		<th>Kunjungan</th>
		<th>Kepesertaan</th>
		<th>Jam</th>
		<th>Konsultasi</th>
		<th>Resep</th>
		<th>Obat</th>
	</thead>
<tbody></tbody>
</table>
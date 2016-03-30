<div class="ui grid">
	<div class="no padding top bottom sixteen wide column">
		<div id="response-message" class="ui icon hidden message">
			<i class="close icon"></i>
			<i id="icon-message" class="icon"></i>
			<div class="content">
				<div class="header"></div>
				<p></p>
				<span class="counter"></span>
			</div>
		</div>
	</div>
	<div class="sixteen wide mobile nine wide tablet ten wide computer column">
		<h3 class="ui dividing header">Tabel Konsultasi</h3>
		<div class="datatable-container">
		<table id="data-konsultasi" class="ui definition unstackable blue single line celled table" width="100%"
			data-token="<?php echo e(csrf_token()); ?>" data-lang="<?php echo e(asset('/assets/datatables/i18n/indonesian.json')); ?>"
			data-pasien = <?php echo e($id_pasien); ?>

			data-source="<?php echo e(url('dokter/json/data-konsultasi-pasien-need-resep', ['id_pasien' => $id_pasien])); ?>">
			<thead>
			<tr>
			<th></th>
				<th>ID</th>
				<th>Pemeriksaan Fisik</th>
				<th>Diagnosa</th>
				<th>Tindakan</th>
				<th>Tgl. Konsul.</th>
				<th>Petugas</th>
				</tr>
			</thead>
		<tbody></tbody>
	</table>
	</div>
</div>
<div class="sixteen wide mobile seven wide tablet six wide computer column">
	<h3 class="ui dividing header">Form Resep</h3>
	<form class="ui form" id="form-resep" action="<?php echo e(url('dokter/ajax/submit/resep')); ?>">
		<?php echo csrf_field(); ?>

		<div class="field">
			<label>Nomor Indexs Konsultasi</label>
			<input type="text" placeholder="Klik row tabel untuk mendapat nomor indexs" readonly name="id_konsul">
		</div>
		<div class="required field">
			<label>Nama Poli:</label>
			<div tabindex="1" id="nama_poli" class="ui selection dropdown">
				<input type="hidden" name="nama_poli">
				<i class="dropdown icon"></i>
				<div class="default text">Pilih Nama Poli</div>
				<div class="menu">
					<div class="item" data-value="Gigi">Gigi</div>
					<div class="item" data-value="KIA">KIA</div>
					<div class="item" data-value="Ibu Hamil dan Menyusui">Ibu Hamil & Menyusui</div>
				</div>
			</div>
		</div>
		<div class="field">
			<label>Tulis Resep:</label>
			<textarea tabindex="2" name="resep" cols="3"></textarea>
		</div>
		<div class="field">
			<div class="right aligned column">
				<button type="button" class="ui default negative delete-resep disabled icon button"><i class="icon trash"></i> Hapus</button>
				<button class="ui default reset-form icon button"><i class="icon undo"></i> Reset</button>
				<button class="ui submit positive icon button" type="submit"><i class="icon save"></i> Simpan</button>
			</div>
		</div>
	</form>
</div>

</div>
<div id="modal-insert-resept" class="ui fullscreen modal">
<i class="close icon"></i>
<div class="header">Form Resep</div>
<div class="content">
</div>
<div class="actions">
	<button type="button" class="ui cancel negative button">Batal</button>
	<button type="button" class="ui button approve positive">Simpan</button>
</div>
</div>
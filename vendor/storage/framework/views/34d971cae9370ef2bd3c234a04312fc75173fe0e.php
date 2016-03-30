<div class="ui long small modal" id="modal-update">
	<i class="close icon"></i>
	<div class="header">Ubah Data Pasien</div>
	<div class="content">
		<div id="response-message-update" class="ui icon hidden message">
			<i class="close link icon"></i>
			<i id="icon-message" class="icon"></i>
			<div class="content">
				<div class="header"></div>
				<p></p>
				<span class="counter"></span>
			</div>
		</div>
		<form id="form-pasien" class="ui equal width form" 
		action="<?php echo e(url('administrasi/ajax/management-pasien/update')); ?>"
		data-token="<?php echo e(csrf_token()); ?>">
			<?php echo csrf_field(); ?>

			<input type="hidden" name="id">
			<div class="fields">
				<div class="eight wide field required">
					<label>Nama Pasien:</label>
					<input type="text" name="nama_pasien">
				</div>
				<div class="eight wide field">
					<label>Nama Kepala Keluarga:</label>
					<input type="text" name="nama_kepala_keluarga">
				</div>
			</div>
			<div class="fields">
				<div class="eight wide field required">
					<label>Tanggal Lahir:</label>
					<div class="ui icon input">
						<input tabindex="3" type="text" class="datepicker" name="tgl_lahir" placeholder="Tanggal Lahir">
						<i class="circular calendar pick-me-date link icon"></i>
					</div>
				</div>
				<div class="eight wide required field">
					<label>Jenis Kelamin</label>
					<div tabindex="5" id="jenis_kelamin_dropdown" class="ui fluid selection dropdown">
						<input type="hidden" name="jenis_kelamin">
						<i class="dropdown icon"></i>
						<div class="default text">Jenis Kelamin</div>
						<div class="menu">
							<div class="item" data-value="1">Laki-Laki</div>
							<div class="item" data-value="2">Perempuan</div>
						</div>
					</div>
				</div>
			</div>
			<div class="fields">
				<div class="eight wide required field">
					<label>Pekerjaan:</label>
					<input tabindex="6" type="text" name="pekerjaan" placeholder="Pekerjaan">
				</div>
				<div class="eight wide required field">
					<label>Agama:</label>
					<div tabindex="7" id="agama_dropdown" class="ui fluid selection dropdown">
						<input type="hidden" name="agama">
						<i class="dropdown icon"></i>
						<div class="default text">Agama</div>
						<div class="menu">
							<div class="item" data-value="Islam">Islam</div>
							<div class="item" data-value="Kristen">Kristen</div>
							<div class="item" data-value="Katholik">Katholik</div>
							<div class="item" data-value="Hindu">Hindu</div>
							<div class="item" data-value="Budha">Budha</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="required field">
				<label>Alamat:</label>
				<textarea tabindex="8" name="alamat" rows="3" placeholder="Alamat"></textarea>
			</div>
			
			<div class="required field">
				<label>Kunjungan:</label>
				<div tabindex="9" id="jenis_kunjungan_dropdown" class="ui fluid selection dropdown">
					<input type="hidden" name="jenis_kunjungan">
					<i class="dropdown icon"></i>
					<div class="default text">Jenis Kunjungan</div>
					<div class="menu">
						<div class="item" data-value="1">Baru</div>
						<div class="item" data-value="2">Lama</div>
					</div>
				</div>
			</div>
			<div class="required field">
				<label>Kepersertaan:</label>
				<div tabindex="10" id="kepesertaan-dropdown" class="ui fluid selection dropdown">
					<input type="hidden" name="jenis_kepesertaan">
					<i class="dropdown icon"></i>
					<div class="default text">Jenis Kepesertaan</div>
					<div class="menu">
						<div class="item" data-value="Umum & BPJS">Umum & BPJS</div>
						<div class="item" data-value="AKSESOS">AKSESOS</div>
						<div class="item" data-value="AKSESIN">AKSESIN</div>
						<div class="item" data-value="AKSES">AKSES</div>
						<div class="item" data-value="BUMIL">BUMIL</div>
						<div class="item" data-value="ASPRAS">ASPRAS</div>
						<div class="item" data-value="0">Lain - Lain</div>
					</div>
				</div>
			</div>
			<div class="required field hidden">
				<label>Ketik Jenis Kepesertaan:</label>
				<input tabindex="11" style="margin-top:5px;" type="text" placeholder="Ketik Jenis Kepesertaan" name="_jenis_kepesertaan">
			</div>
		</form>
	</div>
	<div class="actions">
		<button class="ui negative button"><i class="close icon"></i>Batal</button>
		<button class="ui submit positive approve button"><i class="icon save"></i>Simpan</button>
	</div>
</div>
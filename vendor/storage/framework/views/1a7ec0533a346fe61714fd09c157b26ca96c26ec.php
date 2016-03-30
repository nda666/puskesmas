<div class="ui long small modal" id="modal-insert">
	<i class="close icon"></i>
	<div class="header"></div>
	<div class="content">
		<div id="response-message-insert" class="ui icon hidden message">
			<i class="close link icon"></i>
			<i id="icon-message" class="icon"></i>
			<div class="content">
				<div class="header"></div>
				<p></p>
				<span class="counter"></span>
			</div>
		</div>
		<form id="form-insert" class="ui equal width form"
			data-token="<?php echo e(csrf_token()); ?>"
			action="<?php echo e(url('administrasi/pegawai/create')); ?>">
			<?php echo csrf_field(); ?>

			<input type="hidden" name="id">
			<div class="required two fields">
				<div class="required field">
					<label>NIP</label>
					<input type="text" name="nip"></input>
				</div>
				<div class="required field">
					<label>Nama Pegawai:</label>
					<input type="text" name="nama_pegawai"></input>
				</div>
			</div>
			<div class="required two fields">
				<div class="field">
					<label>Password:</label>
					<input placeholder="password" type="password" name="password"></input>
				</div>
				<div class="field">
					<label>Konfirmasi Password:</label>
					<input placeholder="Ketik ulang password" type="password" name="password_confirmation"></input>
				</div>
			</div>
			<div class="required two fields">
				<div class="field">
					<label>Gender:</label>
					<div class="ui selection dropdown">
						<input type="hidden" name="jenis_kelamin">
						<i class="dropdown icon"></i>
						<div class="default text">Gender</div>
						<div class="menu">
							<div class="item" data-value="Laki-Laki">Laki-Laki</div>
							<div class="item" data-value="Perempuan">Perempuan</div>
						</div>
					</div>
				</div>
				<div class="field">
					<label>Agama:</label>
					<div class="ui selection dropdown">
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
			<div class="required two fields">
				<div class="field">
					<label>Tanggal Lahir:</label>
					<input placeholder="Tanggal Lahir" type="text" name="tgl_lahir"></input>
				</div>
				<div class="field">
					<label>Jabatan:</label>
					<div class="ui selection dropdown">
						<input type="hidden" name="jabatan">
						<i class="dropdown icon"></i>
						<div class="default text">Jabatan</div>
						<div class="menu">
							<div class="item" data-value="Administrasi">Administrasi</div>
							<div class="item" data-value="Dokter">Dokter</div>
							<div class="item" data-value="Konsultan">Konsultan</div>
							<div class="item" data-value="Apoteker">Apoteker</div>
						</div>
					</div>
				</div>
			</div>
			<div class="field">
				<label>No Telp:</label>
				<input placeholder="Nomor Telepon" type="text" name="no_telp"></input>
			</div>
			<div class="field">
				<label>Alamat:</label>
				<textarea name="alamat" rows="3"></textarea>
			</div>
			
		</form>
	</div>
	<div class="actions">
		<button class="ui negative button"><i class="close icon"></i>Batal</button>
		<button class="ui submit positive approve button"><i class="icon save"></i>Simpan</button>
	</div>
</div>
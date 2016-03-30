<div class="ui long small modal" id="modal-insert">
	<i class="close icon"></i>
	<div class="header"></div>
	<div class="content">
		<form enctype="multipart/form-data" id="form-insert" data-update="{{ url('administrasi/dokter/dokter-detail') }}" class="ui equal width form"
			data-token="{{ csrf_token() }}"
			action="{{ url('administrasi/dokter/create') }}">
			{!! csrf_field() !!}
			<input type="hidden" name="id">
			<div class="required two fields">
				<div class="required field">
					<label>Username</label>
					<input type="text" placeholder="Username" name="username"></input>
				</div>
				<div class="required field">
					<label>Nama Dokter:</label>
					<input type="text" placeholder="Nama Dokter" id="nama-dokter"  name="nama"></input>
				</div>
			</div>
			<div class="required two fields">
				<div class="field">
					<label>Password:</label>
					<input placeholder="Password" type="password" name="password"></input>
				</div>
				<div class="field">
					<label>Konfirmasi Password:</label>
					<input placeholder="Ketik Ulang Password" type="password" name="password_confirmation"></input>
				</div>
			</div>
			<div class="required two fields">
				<div class="field">
					<label>Gender:</label>
					<div id="jenis_kelamin_dropdown" class="ui selection dropdown">
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
					<div id="agama_dropdown" class="ui selection dropdown">
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
					<input placeholder="Tanggal Lahir" data-html="<b>Format: Tanggal-Bulan-Tahun</b><br><i>Contoh: 16-03-1990</i>" type="text" name="tgl_lahir"></input>
				</div>
				<div class="field">
					<label>Poli:</label>
					<div id="poli-dropdown" data-source="{{ url('administrasi/dokter/data-poli') }}" class="ui selection search dropdown">
						<input type="hidden" name="poli_id">
						<i class="dropdown icon"></i>
						<div class="default text">Pilih Poli</div>
					</div>
				</div>
			</div>
      <script type="text/javascript">
        $('#poli-dropdown').dropdown({
          apiSettings: {
            url: $('#poli-dropdown').attr('data-source')+'?find={query}',
            saveRemoteData: false
          },
          saveRemoteData: false
        });
      </script>
			<div class="two fields">
				<div class="field">
					<label>No Telp:</label>
					<input placeholder="Nomor Telepon" type="text" name="no_telp"></input>
				</div>
				<div class="field">
					<label>Foto:</label>
						<input class="ui label" type="file" name="foto" />
					</div>
			</div>
			<div class="field">
				<label>Alamat:</label>
				<textarea name="alamat" placeholder="Alamat" id="alamat"  rows="3"></textarea>
			</div>
		</form>
	</div>
	<div class="actions">
		<button class="ui negative button"><i class="close icon"></i>Batal</button>
		<button class="ui submit positive approve button"><i class="icon save"></i>Simpan</button>
	</div>
</div>

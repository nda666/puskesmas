<div class="ui long small modal" id="modal-update">
	<i class="close icon"></i>
	<div class="header"></div>
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
		<form id="form-poli" class="ui equal width form"
			data-token="<?php echo e(csrf_token()); ?>"
			action="<?php echo e(url('administrasi/ajax/management-poli/update')); ?>">
			<?php echo csrf_field(); ?>

			<input type="hidden" name="id">
			<div class="field">
				<label>ID Konsultasi:</label>
				<div tabindex="3" class="ui selection dropdown nama_poli">
					<input type="hidden" name="nama_poli"></input>
					<i class="dropdown icon"></i>
					<div class="default text">Pilih salah satu... </div>
					<div class="menu">
						<div class="item" data-value="Gigi">Gigi</div>
						<div class="item" data-value="Ibu Hamil dan Menyusui">Ibu Hamil & Menyusui</div>
						<div class="item" data-value="KIA">KIA</div>
					</div>
				</div>
			</div>

			<div class="required field">
				<label>Nama Poli:</label>
				<textarea rows="3" name="resep" placeholder="Tulis Resep"></textarea>
			</div>
			
		</form>
	</div>
	<div class="actions">
		<button class="ui negative button"><i class="close icon"></i>Batal</button>
		<button class="ui submit positive approve button"><i class="icon save"></i>Simpan</button>
	</div>
</div>
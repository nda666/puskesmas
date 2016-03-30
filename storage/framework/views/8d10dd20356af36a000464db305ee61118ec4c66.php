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
		<form id="form-konsultasi" class="ui equal width form"
			data-token="<?php echo e(csrf_token()); ?>"
			action="<?php echo e(url('administrasi/ajax/management-konsultasi/update')); ?>">
			<?php echo csrf_field(); ?>

			<input type="hidden" name="id">
			<div class="required field">
				<label>Pemeriksaan Fisik:</label>
				<textarea rows="3" name="pemeriksaan_fisik"></textarea>
			</div>
			<div class="required field">
				<label>Anamesa / Diagnosa:</label>
				<textarea rows="3" name="diagnosa"></textarea>
			</div>
			<div class="required field">
				<label>Tindakan:</label>
				<textarea rows="3" name="tindakan"></textarea>
			</div>
		</form>
	</div>
	<div class="actions">
		<button class="ui negative button"><i class="close icon"></i>Batal</button>
		<button class="ui submit positive approve button"><i class="icon save"></i>Simpan</button>
	</div>
</div>
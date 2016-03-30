$(document).ready(function () {
	$('.ui.dropdown').dropdown();
	var form = '.form-ubah-foto',
	form_update = '#form-update-profile';

	$(form_update + ' [type="submit"]').click(function(e){
		e.preventDefault();
		form_submit(form_update, false, function(res){
			$('#user-dropdown span').text(res.results);
		});
	});
	$(form_update).form({
		on: 'submit',
		inline: true,
		fields: {
			nama: 'empty',
			tgl_lahir: 'empty',
			jenis_kelamin: 'empty',
			agama: 'empty',
			no_telp: 'empty',
			alamat: 'empty'
		}
	});
	$('.special.card .image').dimmer({
		on: 'hover'
	});

	$('.ubah-foto').click(function (e) {
		$('input[name="foto"]').click();
	});

	$('.special.card').on('change', 'input[name="foto"]', function (e) {
		if ($(this).val() === '') {
			return false;
		}
		$('.special.card .image').dimmer({
			on: false
		});
		$('.ubah-foto').addClass('disabled loading');
		$('.special.card .image').dimmer('show');
		var set_t = setTimeout(function () {
			$(form).submit();
			clearTimeout(set_t)
		}, 1000)
	});

	$(form).submit(function (e) {
		e.preventDefault();
		var url = $(this).attr('action'),
			data = new FormData($(form)[0]);
		$.ajax({
			url: url,
			contentType: false,
			processData: false,
			type: 'POST',
			dataType: 'json',
			data: data,
			success: function (response) {
				if (response.response){
					$('.foto-profil').attr('src', response.results);
					var n_oke = noty({
						'text': response.message,
						type: 'success',
						layout: 'topRight',
						timeout: 5000
					});
				} else {
					var n_oke = noty({
						'text': response.message,
						type: 'warning',
						layout: 'topRight',
						timeout: 5000
					});
				}
			},
			error: function (response) {
				$('.special.card .image').dimmer('hide');
				$('.ubah-foto').removeClass('disabled loading');
				$('.special.card .image').dimmer({
					on: 'hover'
				});
				$(form + ' input[name="foto"]').val('');
				var n_error = noty({
					'text': 'Terjadi kesalahan.<br><b>Message:</b> ' + response.status + ' ' + response.statusText,
					type: 'error',
					layout: 'topRight',
					timeout: 5000
				});
			},
			complete: function () {
				$(form + ' input[name="foto"]').val('');
				$('.ubah-foto').removeClass('disabled loading');
				$('.special.card .image').dimmer('hide');
				$('.special.card .image').dimmer({
					on: 'hover'
				});
			}
		});
	});

	$('#form-password').form({
		inline: true,
		on: 'submit',
		fields: {
			password: ['minLength[6]', 'empty'],
			password_confirmation: 'match[password]',
		}
	});
});

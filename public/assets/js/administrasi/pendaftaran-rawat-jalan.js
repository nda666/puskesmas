$(document).ready(function () {
	'use strict';
	$('#data-pasien thead th').addClass('center aligned');
	var data_pasien = null;
	var global_form = true;
	var table = $('#data-pasien').DataTable({
		ajax: {
			url: $('#data-pasien').data('source'),
		},
		language: {
			url: $('#data-pasien').data('lang')
		},
		lengthMenu: [
			[10, 25, 100, 200, 500, -1],
			[10, 25, 100, 200, 500, 'Semua'],
		],
		searchDelay: 1000,
		stateSave: true,
		scrollY: '60vh',
		scrollCollapse: true,
		scrollX: true,
		dom: "<'left no padding-bottom floated aligned sixteen wide mobile eight wide computer column'l><'right no padding-bottom aligned sixteen wide mobile eight wide computer column'f>" + "<'ui button-container sixteen wide tablet ten wide toolbar-container column'>" +
			"<'sixteen wide column no padding top bottom'tr>" + "<'sixteen wide mobile four wide computer column'i><'right aligned sixteen wide mobile twelve wide computer column'p>",
		processing: true,
		pagingType: 'numbers',
		serverSide: true,
		filter: true,
		sort: true,
		info: true,
		order: [
      [2, "asc"]
    ],

		columns: [{
			data: null,
			visible: true,
			sortable: false,
			render: function (data, type, row) {
				return '<div class="ui checkbox-table checkbox"><input type="checkbox"> <label></label></div>';
			},
		}, {
			data: "id",
			name: 'id',
			className: 'collapsing text-center'
		}, {
			data: "nama",
			name: 'nama',
		}, {
			data: 'kepala_keluarga',
			name: 'kepala_keluarga',
		}, {
			data: 'no_kartu_keluarga',
			name: 'no_kartu_keluarga',
		}, {
			data: 'jenis_kelamin',
			name: 'jenis_kelamin'
		}, {
			data: "action",
			name: 'action',
			searchable: false,
			sortable: false,
			className: 'actived text-center collapsing'
		}, ],
	});
	table.on('init.dt', function () {
		$('.dataTables_filter').addClass('ui datatables-search input');
		yadcf.init(table, [{
			column_number: 1,
			filter_type: 'text',
			filter_reset_button_text: false,
		}, {
			column_number: 2,
			filter_type: "text",
			filter_reset_button_text: false,
		}, {
			column_number: 3,
			filter_type: 'text',
			filter_reset_button_text: false
		}, {
			column_number: 4,
			filter_type: 'text',
			filter_reset_button_text: false
		}, {
			column_number: 5,
			filter_type: 'select',
			filter_reset_button_text: false,
			data: [{
				value: 'Laki-Laki',
				label: 'Laki-Laki'
        }, {
				value: 'Perempuan',
				label: 'Perempuan'
        }]
		}, ]);

		$('.yadcf-filter-wrapper').addClass('ui datatables-search input').css({
			'display': 'flex',
		});
		$('#yadcf-filter-wrapper--data-pasien-0 input').css('width', '50px');
		$('#yadcf-filter-wrapper--data-pasien-1 input').css('width', '90px');
		$('#yadcf-filter-wrapper--data-pasien-2 input').css('width', '80px');
		$('#yadcf-filter-wrapper--data-pasien-3 input').css('width', '100px');
		$('#yadcf-filter-wrapper--data-pasien-4 select').css({
			'margin': '0 auto'
		});

		$('.yadcf-filter-wrapper button').html('<i class="close icon"></i>')
		$('.yadcf-filter-wrapper button').addClass('ui small icon button');
		$('[id^=yadcf]').hide();

		$('#yadcf-filter-wrapper--data-pasien-0 input').keydown(function (e) {
			$(this).focusin();
		});
		new $.fn.dataTable.Buttons(table, {
			dom: {
				container: {
					tag: 'div',
					className: 'ui left floated group buttons'
				},
				collection: {
					tag: 'div',
					className: 'dt-button-collection'
				},
				button: {
					tag: 'a',
					className: 'ui tiny icon button',
					active: 'active',
					disabled: 'disabled'
				},
				buttonLiner: {
					tag: '',
					className: ''
				}
			},
			buttons: [{
				text: '<i class="plus icon"></i>Tambah',
				className: 'positive labeled icon tambah-btn',
				action: function (e, dt, node, config) {
					$('#pendaftaran-baru form [name="id"]').val('');
					$('#pendaftaran-baru form').form('clear');
					$('#pendaftaran-baru form input[type="hidden"][name="_token"]').val($('#pendaftaran-baru form').attr('data-token'));
					$('#pendaftaran-baru .header').text('Tambah Data Pasien');
					$('#pendaftaran-baru').modal({
						closable: false,
						onApprove: function () {
							form_submit('#pendaftaran-baru form', true, function () {
								$('#rawat-jalan-field').hide();
								table.ajax.reload();
							});
							return false;
						},
						onHidden: function () {
							$('#rawat-jalan-field').hide();
						},
					}).modal('show');
				}
			}, {
				text: '<i class="trash icon"></i>Hapus',
				className: 'negative labeled icon hapus-btn',
				action: function (e, dt, node, config) {
					var data = dt.rows($('#data-pasien input:checked').parents('tr')).data();
					if (data.length <= 0) {
						return false;
					}
					var id_ar = new Array;
					$.each(data, function (index, val) {
						id_ar.push(val.id);
					});
					delete_data_pasien($('#data-pasien').attr('data-delete'), id_ar);
				}
			}, ]
		});
		new $.fn.dataTable.Buttons(table, {
			dom: {
				container: {
					tag: 'div',
					className: 'ui basic right floated buttons'
				},
				collection: {
					tag: 'div',
					className: 'dt-button-collection'
				},
				button: {
					tag: 'a',
					className: 'ui toggle tiny icon button',
					active: 'active',
					disabled: 'disabled'
				},
				buttonLiner: {
					tag: 'span',
					className: ''
				}
			},
			buttons: [{
				text: '<i class="icon refresh"></i>Refresh',
				className: 'refresh-btn',
				action: function (e, dt, node, config) {
					table.ajax.reload();
				}
			}, {
				text: '<i class="icon check"></i>Check',
				className: 'check-btn',
				action: function (e, dt, node, config) {
					$('#data-pasien .checkbox-table').checkbox('check');
				}
			}, {
				text: '<i class="icon close"></i>Un-Check',
				className: 'check-btn',
				action: function (e, dt, node, config) {
					$('#data-pasien .checkbox-table').checkbox('uncheck');
				}
			}, {
				text: '<i class="clockwise search icon"></i>Cari',
				className: 'search-btn',
				action: function (e, dt, node) {
					$(node).toggleClass('active').removeClass('toggle');
					if (!$(node).hasClass('active')) {
						$('[id^=yadcf]').hide();
					} else {
						$('[id^=yadcf]').show();
					}
					table.columns.adjust();
				}
            }, {
				text: '<i class="undo icon"></i>Clear',
				className: 'clear-search-btn',
				action: function (e, dt, node) {
					yadcf.exResetAllFilters(table)
					table.columns.adjust();
				}
        }, ],
		});

		table.buttons(0, 1).container().prependTo($('.toolbar-container'));
		$('#data-pasien').on('click', '.delete-btn', function (e) {
			e.preventDefault();
			var data = table.row($(this).parents('tr')).data();
			if (!data) {
				return false;
			}
			delete_data_pasien($('#data-pasien').attr('data-delete'), [$(this).attr('data-id')]);
		});
		$('#data-pasien').on('click', '.edit-btn', function (e) {
			e.preventDefault();
			var data = table.row($(this).parents('tr')).data();
			if (!data) {
				return false;
			}
			$('#ubah-data .header').text('Ubah Data Pasien - ID: ' + data.id);
			$('#ubah-data form').form('clear');
			$('#ubah-data form input[type="hidden"][name="_token"]').val($('#ubah-data form').attr('data-token'));
			$.each(data, function (i, v) {
				$('#ubah-data form [name="' + i + '"]').val(v);
			});
			$('#ubah-data form .dropdown').dropdown();
			$('#ubah-data').modal({
				closable: false,
				onApprove: function () {
					form_submit('#ubah-data form', false, function(){
						table.ajax.reload();
					});
					return false;
				}
			}).modal('show');
		});

		$('#data-pasien').on('click', '.view-btn', function (e) {
			var data = table.row($(this).parents('tr')).data();
			if (!data) {
				return false;
			}

			$.each(data, function (i, v) {
				$('#view-data table td[data-list="' + i + '"]').text(v);
			})
			$('#view-data').modal({
				closable: false,
			}).modal('show');

		});

		$('#data-pasien').on('click', '.daftarkan-btn', function (e) {
			var data = table.row($(this).parents('tr')).data();
			if (!data) {
				return false;
			}
			$('#daftar-rawat-jalan').modal({
				onShow: function () {
					$('#daftar-rawat-jalan form [name="_token"]').val($('#daftar-rawat-jalan form').attr('data-token'));
					$('#daftar-rawat-jalan form [name="pasien_id"]').val(data.id);
					$('#daftar-rawat-jalan form [name="nama"]').val(data.nama);
					$('#daftar-rawat-jalan form .ui.dropdown').dropdown('restore defaults');
				},
				onApprove: function () {
					form_submit('#form-rawat-jalan', true, function () {
						$('#daftar-rawat-jalan').modal('hide');
					});
					return false;
				}
			}).modal('show');
		});
		$('#daftar-rawat-jalan form').submit(function (e) {
			e.preventDefault();
			form_submit('#daftar-rawat-jalan form', false);
		});
		$('#daftar-rawat-jalan form .negative.button, #daftar-rawat-jalan .close.link').click(function (e) {
			$('#daftar-rawat-jalan').modal('hide');
		});

		$('.dataTables_scrollBody').scroll(function (e) {

		});

		$('[id^=yadcf]').hide();
		table.columns.adjust();
		tooltip_btn();
	});
	var r = true;
	$(window).resize(function () {
		if (r) {
			r = false;
			var to = setTimeout(function () {
				table.columns.adjust();
				r = true;
				clearTimeout(to);
			}, 1000);
		}
	});

	function tooltip_btn() {
		$('.tambah-btn').attr('data-content', 'Pendaftaran anggota Baru?');
		$('.colvis-btn').attr('data-content', 'Tampilkan / sembunyikan cell tabel');
		$('.refresh-btn').attr('data-content', 'Refresh tabel');
		$('.search-btn').attr('data-content', 'Tampilkan / sembunyikan kolom pencarian');
		$('.clear-search-btn').attr('data-content', 'Bersihkan field pencarian');
		$('.copy-btn').attr('data-content', 'Salin data tabel');
		$('.print-btn').attr('data-content', 'Cetak tabel');
		$('.csv-btn').attr('data-content', 'Simpan ke CSV');
		$('.excel-btn').attr('data-content', 'Simpan ke Excel');
		$('.reset-colorder-btn').attr('data-content', 'Kembalikan posisi kolom head tabel');
		$('.ui.button').popup();
	}

	function ajax_get_pasien(url) {
		$('#ubah-data form').addClass('loading');
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'json',
			success: function (data) {
				if (data[0]) {
					update_form_pasien(data[0]);
				}
			},
			error: function (xhr) {
				var n = noty({
					layout: 'topRight',
					text: 'Error: ' + xhr.status + ' ' + xhr.statusText + '<br>Coba refresh browser kembali, apabila pesan ini masih muncul silahkan hubungi Administrator',
					type: 'warning'
				});
				$('#ubah-data').modal('hide');
			},
			complete: function () {
				$('#ubah-data form').removeClass('loading');
			}
		});
	}

	function update_form_pasien(data) {
		$.each(data, function (index, val) {
			$('#ubah-data form [name="' + index + '"]').val(val);
		});
		$('#ubah-data form .ui.dropdown').dropdown();
		$('#ubah-data form').removeClass('loading');
		return true;
	}
	$('[name="tgl_lahir"]').inputmask('dd-mm-yyyy');
	$('.ui.button').popup();
	$('#jenis_kunjungan_dropdown').dropdown();
	$('#jenis_kelamin_dropdown').dropdown();
	$('#agama_dropdown').dropdown();
	$('#kepesertaan-dropdown').dropdown({
		onChange: function (value, text, $selectedItem) {
			if (value == 0) {
				$('[name="_jenis_kepesertaan"]').parent().fadeIn();
			} else {
				$('[name="_jenis_kepesertaan"]').parent().fadeOut();
				$('[name="_jenis_kepesertaan"]').val('');
			}
		}
	});




	$('#form-pendaftaran').form({
		on: 'submit',
		keyboardShortcuts: false,
		inline: true,
		fields: {
			nama: ['minLength[3]', 'maxLength[50]', 'empty'],
			kepala_keluarga: ['minLength[3]', 'maxLength[50]', 'empty'],
			no_kartu_keluarga: ['minLength[6]', 'maxLength[50]', 'empty', 'number'],
			jenis_kelamin: ['empty'],
			alamat: 'empty',
			pekerjaan: ['minLength[3]', 'maxLength[50]', 'empty'],
			tgl_lahir: ['empty', 'regExp[/[0-9]{2}-[0-9]{2}-[0-9]{4}/]'],
			agama: ['empty', 'agama'],
			jenis_kepesertaan: 'emptyif[daftar_rawat_jalan:checked]'
		}
	});

	$('#form-pendaftaran input').on('keydown', function (e) {
		var x = e.which;
		if (x === 13) {
			return false;
		}
	});
	$('#form-pendaftaran').on('change', '#daftar_rawat_jalan', function (event) {
		$('#rawat-jalan-field .ui.dropdown').dropdown('restore defaults')
		if ($(this).is(':checked')) {
			$('#rawat-jalan-field').show();
		} else {
			$('#rawat-jalan-field').hide();
		}
	});
	// FORM UBAH
	$('#form-ubah').form({
		on: 'submit',
		keyboardShortcuts: false,
		inline: true,
		fields: {
			nama: ['minLength[3]', 'maxLength[50]', 'empty'],
			kepala_keluarga: ['minLength[3]', 'maxLength[50]', 'empty'],
			no_kartu_keluarga: ['minLength[6]', 'maxLength[50]', 'empty', 'number'],
			jenis_kelamin: ['empty'],
			alamat: 'empty',
			pekerjaan: ['minLength[3]', 'maxLength[50]', 'empty'],
			tgl_lahir: ['empty', 'regExp[/[0-9]{2}-[0-9]{2}-[0-9]{4}/]'],
			agama: ['empty', 'agama'],
		}
	});

	// Form Rawat Jalan
	$('#form-rawat-jalan').form({
		on: 'submit',
		keyboardShortcuts: false,
		inline: true,
		fields: {
			jenis_kepesertaan: 'empty',
		}
	});


	var form_submit = function (form, clear, callback) {
		$(form).unbind('submit');
		$(form).submit(function (e) {
			if ($(form).hasClass('loading') || !$(form).form('is valid') || !global_form) {
				return false;
			}
			global_form = false;
			var url = $(form).attr('action'),
				data = $(form).serialize(),
				ele = $(form);
			var n = noty({
				text: 'Simpan data?',
				buttons: [{
					addClass: 'ui positive small button',
					text: '<i class="icon save"></i>Simpan',
					onClick: function ($noty, $this) {
						ele.addClass('loading');
						$(this).addClass('disabled');
						$(this).parent().find('.negative').addClass('disabled');
						var noty_button = $(this),
							cancel_button = $(this).parent().find('.negative');
						$noty.setText('<i class="icon asterisk loading"></i>Mohon tunggu sebentar');
						$.ajax({
							url: url,
							type: 'POST',
							dataType: 'json',
							data: data,
							success: function (response) {
								if (response && response.response) {
									var notif = noty({
										layout: 'topRight',
										text: response.message,
										type: 'success'
									});
									if (clear) {
										ele.form('clear');
										ele.find('[name="_token"]').val(ele.attr('data-token'));
									}
									if (callback) {
										callback();
									}
									$noty.close();
								} else if (response && !response.response) {
									$noty.close();
									var notif = noty({
										layout: 'topRight',
										text: response.message,
										type: 'warning'
									});
								}
							},
							error: function (xhr) {
								if (xhr.status == 422) {
									$noty.close();
									var err = $.parseJSON(xhr.responseText);
									var message = '<b>Form Validasi: </b>';
									message += '<ul style="text-align: left;">'
									$.each(err, function (index, item) {
										if (Array.isArray(item)) {
											$.each(item, function (idx, val) {
												message += '<li>' + val + '</li>';
											});
										} else {
											message += '<li>' + item + '</li>';
										}
									});
									message += '</ul>';
									var notif = noty({
										layout: 'topRight',
										text: message,
										type: 'warning'
									});
									return false;
								}
								$noty.setText('Simpan data?');
								var notif = noty({
									layout: 'topRight',
									text: 'Error: ' + xhr.status + ' ' + xhr.statusText + '<br>Coba refresh browser kembali, apabila pesan ini masih muncul silahkan hubungi Administrator',
									type: 'error'
								});
							},
							complete: function () {
								ele.removeClass('loading');
								noty_button.removeClass('disabled');
								cancel_button.removeClass('disabled');
								global_form = true;
							}
						});
					}
				}, {
					addClass: 'ui negative small button',
					text: 'Cancel',
					onClick: function ($noty) {
						$noty.close();
						global_form = true;
					}
				}],
				modal: true,
				layout: 'center',
			});
			e.preventDefault();
		});
		return $(form).submit();
	}

	function delete_data_pasien(url, id) {
		var conf = false;
		var n = noty({
			modal: true,
			text: '<h4>Peringatan</h4>Data Pasien merupakan parent dari data Rawat Jalan.<br>Apabila menghapus data ini, server akan otomatis menghapus semua data Rawat Jalan pasien ini.<br>Anda yakin menghapus data ini?',
			buttons: [{
					addClass: 'ui negative small button',
					text: '<i class="icon close"></i>Tidak',
					onClick: function ($noty, $this) {
						n.close();
					}
				},
				{
					addClass: 'ui positive small button',
					text: '<i class="icon check"></i>Iya',
					onClick: function ($noty, $this) {
						var ele = $(this);
						ele.addClass('loading disabled');
						$.post(url, {
							id: id,
							_token: $('#data-pasien').attr('data-token')
						}, function (res) {
							if (res.response) {
								var not = noty({
									'text': res.message,
									timeout: 5000,
									layout: 'topRight',
									type: 'success'
								});
								table.ajax.reload();
								n.close();
							} else {
								var not = noty({
									'text': res.message,
									timeout: 5000,
									layout: 'topRight',
									type: 'warning'
								});
							}
						}).fail(function (res) {
							var r = $.parseJSON(res.responseText);
							if (r.message) {
								var not = noty({
									'text': r.message,
									layout: 'topRight',
									type: 'error'
								});
								return false;
							}
							var not = noty({
								'text': res.statusText,
								layout: 'topRight',
								type: 'error'
							});
						}).done(function () {
							ele.removeClass('loading disabled');
						});
					}
							}]
		});
	}

});

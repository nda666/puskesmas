$(document).ready(function (event) {
	$('.ui.dropdown.id_pasien').dropdown({
		apiSettings: {
			url: '/administrasi/pegawai/data-dokter-detail'
		}
	});

		$('[name="tgl_lahir"]').inputmask('dd-mm-yyyy');
	var modal = '#modal-insert',
		form = '#form-insert';
		$(form + ' [name="tgl_lahir"]').popup();
	var data_pegawai = null;
	var table = $('#data-dokter').DataTable({
		ajax: {
			url: $('#data-dokter').data('source'),
		},
		language: {
			url: $('#data-dokter').data('lang')
		},
		lengthMenu: [
		[10, 25, 100, 200, 500, -1],
		[10, 25, 100, 200, 500, 'Semua'],
	],
		searchDelay: 1000,
		stateSave: false,
		scrollY: '60vh',
		scrollCollapse: true,
		scrollX: true,
		dom: "<'left no padding-bottom floated aligned sixteen wide mobile eight wide computer column'l><'right no padding-bottom aligned sixteen wide mobile eight wide computer column'f>" + "<'ui button-container sixteen wide tablet ten wide toolbars column'>" +
			"<'sixteen wide column no padding top bottom'tr>" + "<'sixteen wide mobile four wide computer column'i><'right aligned sixteen wide mobile twelve wide computer column'p>",
		processing: true,
		pagingType: 'numbers',
		serverSide: true,
		filter: true,
		sort: true,
		info: true,
		order: [[1, 'asc']],
		columns: [{
			data: null,
			visible: true,
			sortable: false,
			searchable: false,
			width: '7px',
			className: 'text-center collapsing',
			render: function (data, type, row) {
				return '<div style="margin-left: 7px;" class="ui checkbox-table checkbox"><input type="checkbox"> <label></label></div>';
			},
		}, {
			data: "id",
			name: 'id',
        }, {
			data: 'username',
			name: 'username',
        }, {
			data: 'nama',
			name: 'nama'
        }, {
			data: 'jenis_kelamin',
			name: 'jenis_kelamin'
        }, {
			data: 'nama_poli',
			name: 'poli.nama'
		}, {
			data: 'action',
			name: 'action',
			className: 'right aligned collapsing',
			searchable: false,
			sortable: false
		}, ],
			drawCallback: function(){$('.buttons .button').popup();}
	});

	table.on('init.dt', function () {
		yadcf.init(table, [{
			column_number: 1,
			filter_type: 'text',
			filter_reset_button_text: false
      }, {
			column_number: 2,
			filter_type: 'text',
			filter_reset_button_text: false
        }, {
			column_number: 3,
			filter_type: 'text',
			filter_reset_button_text: false
      }, {
			column_number: 4,
			filter_type: 'select',
			filter_reset_button_text: false,
			data: [{
				value: 'Laki-Laki',
				label: 'Laki-Laki'
        }, {
				value: 'Perempuan',
				label: 'Perempuan'
        }]
      }, {
			column_number: 5,
			filter_type: 'text',
			filter_reset_button_text: false,
      }, ]);
		$('.yadcf-filter-wrapper').addClass('ui datatables-search input').css({
			'display': 'flex',
		});
		$('#yadcf-filter-wrapper--data-dokter-0').find('input').css('width', '30px');
		$('#yadcf-filter-wrapper--data-dokter-1').find('input').css('width', '60px');
		$('#yadcf-filter-wrapper--data-dokter-2').find('input').css('width', '60px');
		$('#yadcf-filter-wrapper--data-dokter-3').find('select').css('height', '28px');
		$('#yadcf-filter-wrapper--data-dokter-4').find('input').css('width', '70px');
		$('#yadcf-filter-wrapper--data-dokter-5').find('input').css('width', '80px');
		$('#yadcf-filter-wrapper--data-dokter-6').find('input').css('width', '80px');
		$('#yadcf-filter-wrapper--data-dokter-7').find('select').css('height', '28px');
		new $.fn.dataTable.Buttons(table, {
			dom: {
				container: {
					tag: 'div',
					className: 'ui group buttons'
				},
				collection: {
					tag: 'div',
					className: 'dt-button-collection'
				},
				button: {
					tag: 'a',
					className: 'ui tiny labeled icon button',
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
				className: 'primary icon tambah-btn',
				action: function (e, dt, node, config) {
					$(modal + ' .header').text('Tambah Data Dokter');
					$(modal).modal({
						closable: false,
						onApprove: function () {
							$(form).form('validate form');
							form_submit(form, false, function () {
								$(form).form('clear');
								$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
								$(form + ' [name="rawat_jalan_id"]').val($(form).attr('data-id'));
								table.ajax.reload();
							});
							return false;
						},
						onShow: function () {
							$(form).form('clear');
							$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
							$(form + ' [name="rawat_jalan_id"]').val($(form).attr('data-id'));
							$(form).find('#-dropdown').addClass('multiple');
						}
					}).modal('show');
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
					$('#data-dokter .checkbox-table').checkbox('check');
				}
			}, {
				text: '<i class="icon close"></i>Un-Check',
				className: 'check-btn',
				action: function (e, dt, node, config) {
					$('#data-dokter .checkbox-table').checkbox('uncheck');
				}
			}, {
				text: '<i class="search icon"></i>Cari',
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
				}, ]
		});

		table.buttons(0, 1).container().prependTo($('.toolbars'));
		$('[id^=yadcf]').hide();
		table.columns.adjust();
		table.on('select', function (e, dt, type, indexes) {
			$('.ubah-btn, .hapus-btn').removeClass('disabled');
			$('.hapus-btn').attr('data-content', 'Hapus data resep obat yang Anda pilih?');
			$('.ubah-btn').attr('data-content', 'Ubah data obat yang Anda pilih?')
		}).on('deselect', function (e, dt, type, indexes) {
			var data = dt.row({
				selected: true
			}).data();
			if (!data) {
				$('.ubah-btn, .hapus-btn').addClass('disabled');
			}

		});
	});
	$('.buttons .button').popup();
	$(form + ' .dropdown').dropdown();
	$(form).form({
		on: 'submit',
		inline: true,
		fields: {
			username: ['empty','minLength[4]'],
			nama: 'empty',
			password: ['minLength[5]', 'maxLength[50]', 'empty'],
			password_confirmation: ['match[password]', 'minLength[5]', 'maxLength[50]', 'empty'],
			kepala_keluarga: ['minLength[3]', 'maxLength[50]', 'empty'],
			no_kartu_keluarga: ['minLength[6]', 'maxLength[50]', 'empty', 'number'],
			jenis_kelamin: ['empty'],
			alamat: 'empty',
			jabatan: 'empty',
			no_telp: ['empty', 'minLength[6]', 'integer'],
			tgl_lahir: ['empty', 'regExp[/[0-9]{2}-[0-9]{2}-[0-9]{4}/]'],
			agama: ['empty', 'agama'],
		}
	});

	$('#data-dokter').on('click', '.edit-btn', function(e){
		e.preventDefault();
		table.ajax.reload();
		var data = table.row($(this).parents('tr')).data();
		if (!data) {
			return false;
		}
		$(modal + ' .header').text('Ubah Data Resep - ID: ' + data.id);
		$(form).form('clear');
		$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
		$.each(data, function(i, v){
				$(form + ' [name="'+ i +'"]:not([type="file"])').val(v);
		});
		$(form + ' [name="password"]').val('');
		$(form + ' .dropdown').dropdown();
		$(modal).modal({
			closable: false,
			onApprove: function () {
				form_submit(form, false, function () {
					dt.ajax.reload();
				});
				return false;
			},
			onShow: function () {
				$(form).find('[name="obat_id"]').val(data.obat_id);
				$(form).find('#dropdown').dropdown('set text', data.nama_obat);
				$(form).find('#dropdown').removeClass('multiple');
			}
		}).modal('show');
	});
	$('#data-dokter').on('click', '.view-btn', function(e){
		e.preventDefault();
		var data = table.row($(this).parents('tr')).data();
		if (!data) {
			return false;
		}
		$('#modal-view .header').text('Dokter: '+ data.nama);

		$.each(data, function(i, v){
			if (i != 'foto'){
				$('#modal-view [data-name="'+ i +'"]').text(v);
			}
		});
		if (data.foto != null){
			$('#modal-view [data-name="foto"]').attr('src',$('#modal-view [data-name="foto"]').attr('data-url') + data.foto);
		} else {
			$('#modal-view [data-name="foto"]').attr('src',$('#modal-view [data-name="foto"]').attr('data-male'));
		}
		$('#modal-view').modal({
			observeChanges: true
		}).modal('show');
		$('#modal-view').modal('refresh');
	});
});

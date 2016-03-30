$(document).ready(function () {
	'use strict';
	$('#data-konsultasi thead th').addClass('center aligned');
	var form = '#modal-konsultasi-insert form',
	modal = '#modal-konsultasi-insert';
	$('#selesai-rawat-jalan').click(function (e) {
		e.preventDefault();
		var btn_rjalan = $('#selesai-rawat-jalan');
		var default_text = 'Tandai "Selesai" untuk rawat jalan ini?';
		if ($(this).attr('data-progres') == '0'){
			default_text = 'Tandai "Belum Selesai" untuk rawat jalan ini?';
		}
		var notif = noty({
			modal: true,
			text: default_text,
			buttons: [{
					addClass: 'ui negative small button',
					text: '<i class="icon close"></i>Tidak',
					onClick: function ($noty, $this) {
						$noty.close();
						if ($('#selesai-rawat-jalan').attr('data-progres') == 1){
							$('#selesai-rawat-jalan').attr('data-force', 'false');
						}
					}
      }, {
					addClass: 'ui positive small button',
					text: '<i class="icon check"></i>Iya',
					onClick: function ($noty, $this) {
						var btn = $(this);
						var force = btn_rjalan.attr('data-force'),
						progres = btn_rjalan.attr('data-progres')
						$noty.setText('<i class="icon loading asterisk"></i>Mohon Tunggu sebentar...');
						if (!$(this).hasClass('disabled')) {
							$(this).addClass('disabled loading');
							$.post($('#selesai-rawat-jalan').attr('data-action'), {
								'id': btn_rjalan.attr('data-id'),
								'force': force,
								'progres': progres,
								'_token': btn_rjalan.attr('data-token'),
							}).done(function(response){
									if (response.response) {
										$noty.close();
										var not = noty({
											layout: 'topRight',
											type: 'success',
											timeout: 10000,
											text: response.message
										});
										if (response.result == 1){
											btn_rjalan.attr('data-force', 'true').attr('data-progres', '0').html('<i class="close icon"></i>Batalkan Selesai').removeClass('green').addClass('red');
											$('#status-rawat-jalan').removeClass('red').addClass('green').text('Sudah');
										} else {
											btn_rjalan.attr('data-force', 'false').attr('data-progres', '1').html('<i class="check icon"></i>Selesai Rawat Jalan').removeClass('red').addClass('green');
											$('#status-rawat-jalan').removeClass('green').addClass('red').text('Belum');
										}
										btn.removeClass('disabled loading');
										if (response.redirect){
											window.location.href = response.redirect
										}
									} else {
										if (response.reconfirm) {
											var to = setTimeout(function () {
												$noty.setText(response.message);
												btn_rjalan.attr('data-force', 'true');
												btn.removeClass('disabled loading');
												clearTimeout(to);
											}, 1000);
										} else {
										var not = noty({
											layout: 'topRight',
											text: response.message,
											timeout: 10000
										});
										}
									}
							}).fail(function(xhr){
								var not = noty({
									layout: 'topRight',
									text: 'Error: '+ xhr.status + ' ' + xhr.statusText
								});
								$noty.setText(default_text);
								btn.removeClass('disabled loading');
							});
						}
					}
      }
      ]
		});
	});

	$('#tab-rawat-jalan a.item').tab({
		history: true,
		onLoad: function (tabPath) {
			$(window).trigger('resize');
			if (tabPath == 'data-tindakan') {
					$(window).trigger('look');
			}
		},
	});
	$('#kasus-dropdown').dropdown();
	$('#pegawai-dropdown').dropdown({
		apiSettings: {
			url: '/administrasi/rawat-jalan/petugas?find={query}&role=konsultan',
			saveRemoteData: false
		},

		saveRemoteData: false
	});
	$('#poli-dropdown').dropdown({
		apiSettings: {
			url: $('#poli-dropdown').attr('data-source')+'?find={query}',
			saveRemoteData: false
		},
		saveRemoteData: false
	});
	var global_form = true;
	var eTable = '#data-konsultasi';
	var table = $('#data-konsultasi').DataTable({
		ajax: {
			url: $('#data-konsultasi').data('source'),
		},
		language: {
			url: $('#data-konsultasi').data('lang')
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
		columns: [{
			data: "id",
			name: 'ruang_konsul.id',
    }, {
			data: "pemeriksaan_fisik",
			name: 'pemeriksaan_fisik',
			render: function(s){
				s = (s.length >= 50) ? s.substr(0, 50) + '...' : s ;
				return s;
			}
    }, {
			data: 'diagnosa',
			name: 'diagnosa',
			render: function(s){
				s = (s.length >= 50) ? s.substr(0, 50) + '...' : s ;
				return s;
			}
    },  {
			data: 'kasus',
			name: 'kasus',
    }, {
			data: 'nama_poli',
			name: 'poli.nama'
    }, {
			data: 'keterangan',
			name: 'keterangan',
			render: function(s){
				s = (s.length >= 50) ? s.substr(0, 50) + ' ...' : s ;
				return s;
			}
    },{
			data: 'action',
			name: 'action',
			sortable: false,
			searchable: false,
    },  ],
		drawCallback: function () {
			tooltip_btn();
		},
	});
	table.on('init.dt', function () {
		yadcf.init(table, [{
			column_number: 0,
			filter_type: 'text',
			filter_reset_button_text: false,
    }, {
			column_number: 1,
			filter_type: 'text',
			filter_reset_button_text: false,
    }, {
			column_number: 2,
			filter_type: 'text',
			filter_reset_button_text: false,
    }, {
			column_number: 3,
			filter_type: 'select',
			filter_reset_button_text: false,
			data: [{
				value: 'Baru',
				label: 'Baru'
        }, {
				value: 'Lama',
				label: 'Lama'
        }]
    }, {
			column_number: 4,
			filter_type: 'text',
			filter_reset_button_text: false,
    },  {
			column_number: 5,
			filter_type: 'text',
			filter_reset_button_text: false,
    }, ]);
			$('.dataTables_filter').addClass('ui datatables-search input');
			$('.yadcf-filter-wrapper').addClass('ui datatables-search input').css({
				'display': 'flex',
			});
		$('#yadcf-filter-wrapper--data-konsultasi-0 input').css('width', '50px');
		$('#yadcf-filter-wrapper--data-konsultasi-1 input').css('width', '90px');
		$('#yadcf-filter-wrapper--data-konsultasi-2 input').css('width', '80px');
		$('#yadcf-filter-wrapper--data-konsultasi-3 input').css('width', '100px');
		$('#yadcf-filter-wrapper--data-konsultasi-4 input').css('width', '70px');
		$('#yadcf-filter-wrapper--data-konsultasi-5 input').css('width', '100px');

		$('.yadcf-filter-wrapper button').html('<i class="close icon"></i>')
		$('.yadcf-filter-wrapper button').addClass('ui small icon button');
		$('[id^=yadcf]').hide();

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
		// Button Table
		$(eTable).on('click','.view-btn', function(e){
			e.preventDefault();
			var data = table.row($(this).parents('tr')).data(),
			a = '#modal-konsultasi-view';
			if (!data) {
				return false;
			}
			$.each(data, function(i, v){
				$(a + ' [data-name="'+ i +'"]').text(v);
			});

			$(a + ' td').css('text-align', 'justify');
			$(a).modal('show');
		});


	$(eTable).on('click','.edit-btn', function(e){
		e.preventDefault();
		table.ajax.reload();
		var data = table.row($(this).parents('tr')).data(),
		form = '#modal-konsultasi-insert form',
		modal = '#modal-konsultasi-insert';
		if (!data) {
			return false;
		}
		$('#ubah-data form .ui.dropdown').dropdown();
		$(modal + ' .content').css({'height': ($(window).height() - 200) + 'px', 'overflow-x': 'auto'});
		$(modal + ' .header').text('Ubah Data Konsultasi - ID: ' + data.id);
		$(form).form('clear');

		$.each(data, function(i, v){
			$(form + ' [name="'+ i +'"]').val(v);
		});
		$(form + ' [name="poli_id"]').parent('.ui.dropdown').dropdown('set text', data.nama_poli);
		$(form + ' [name="kasus"]').parent('.ui.dropdown').dropdown();

		$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
		$(modal).modal({
			closable: false,
			onApprove: function () {
				form_submit('#modal-konsultasi-insert form', false, function(){
					table.ajax.reload();
				});
				return false;
			}
		}).modal('show');
	});

	// End of Button Table
	table.buttons(0, 1).container().prependTo($('.toolbar-container'));
	table.columns.adjust();

});


	var tooltip_btn = function () {
		$('.view-btn').attr('data-content', 'Lihat Detail');
		$('.delete-btn').attr('data-content', 'Hapus Data');
		$('.edit-btn').attr('data-content', 'Ubah Data');
		$('.ui.button').popup();
	}

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


});

$(document).ready(function (event) {
	var modal = '#modal-insert',
		form = '#form-insert';
	$(modal + ' .closer-modal, ' + modal + ' .negative.button').click(function (e) {
		e.preventDefault();
		$(modal).modal('hide');
	});
	$(form + ' input').keydown(function (e) {
		if (e.keyCode === 13) {
			return false;
		}
	});
	var data_obat = null;
	var table = $('#data-obat').DataTable({
		ajax: {
			url: $('#data-obat').data('source'),
		},
		language: {
			url: $('#data-obat').data('lang')
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
			data: 'kode',
			name: 'kode',
        }, {
			data: 'nama',
			name: 'nama',
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
        }, ]);
		$('.yadcf-filter-wrapper').addClass('ui datatables-search input').css({
			'display': 'flex',
		});
		$('#yadcf-filter-wrapper--data-obat-0').find('input').css('width', '30px');
		$('#yadcf-filter-wrapper--data-obat-1').find('input').css('width', '60px');
		$('#yadcf-filter-wrapper--data-obat-2').find('input').css('width', '60px');
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
					$(modal + ' .header').text('Tambah Data Obat');
					$(modal).modal({
						closable: false,
						onApprove: function () {
							return false;
						},
						onShow: function () {
							$(form + ' input[name="id"],' + form + ' input[name="nama"], ' + form + ' input[name="kode"]').val('');
						}
					}).modal('show');
				}
	        }, {
				text: '<i class="trash icon"></i>Hapus',
				className: 'negative hapus-btn',
				action: function (e, dt, node, config) {
					var data = dt.rows($('#data-obat input:checked').parents('tr')).data();
					if (data.length <= 0) {
						return false;
					}
					var id_ar = new Array,
						ele = node;
					$.each(data, function (index, val) {
						id_ar.push(val.id);
					});
					delete_poli(id_ar);
				}

				}]
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
					$('#data-obat .checkbox-table').checkbox('check');
				}
			}, {
				text: '<i class="icon close"></i>Un-Check',
				className: 'check-btn',
				action: function (e, dt, node, config) {
					$('#data-obat .checkbox-table').checkbox('uncheck');
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

	$(form + ' .dropdown').dropdown();
	$(form).form({
		on: 'submit',
		inline: true,
		fields: {
			nama: 'empty'
		}
	});
	$(modal + ' .approve').click(function (e) {
		form_submit(form, false, function () {
			table.ajax.reload();
			$(form).form('clear');
			$(form + ' input[name="_token"]').val($(form).attr('data-token'));
		});
	});

	$('#data-obat').on('click', '.edit-btn', function (e) {
		e.preventDefault();
		table.ajax.reload();
		var data = table.row($(this).parents('tr')).data();
		if (!data) {
			return false;
		}
		$(modal + ' .header').text('Ubah Data obat - ID: ' + data.id);
		$(modal).modal({
			closable: false,
			onApprove: function () {

				return false;
			},
			onShow: function () {
				$(form + ' input[name="id"]').val(data.id);
				$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
				$(form + ' input[name="nama"]').val(data.nama);
				$(form + ' input[name="kode"]').val(data.kode);
			}
		}).modal('show');
	});

	$('#data-obat').on('click', '.edit-btn', function (e) {
		e.preventDefault();
		table.ajax.reload();
		var data = table.row($(this).parents('tr')).data();
	});

	function delete_poli(id) {
		var n = noty({
			modal: true,
			text: 'Anda hendak menghapus data obat?',
			buttons: [{
				addClass: 'ui positive small button',
				text: '<i class="icon trash"></i>Hapus',
				onClick: function ($noty, $this) {
					var noty_button = $(this),
						cancel_button = $(this).parent().find('.negative');
					noty_button.addClass('loading disabled');
					cancel_button.addClass('disabled');
					$.post($(form).attr('data-delete'), {
							"id": id,
							"_token": $(form + ' [name="_token"]').val()
						}, function (response) {
							if (response && response.response) {
								table.ajax.reload();
								var notif = noty({
									text: response.message,
									layout: 'topRight',
									timeout: 5000,
									type: 'success'
								});
								$noty.close();
							} else {
								var notif = noty({
									text: response.message,
									layout: 'topRight',
									timeout: 5000,
									type: 'warning'
								});
							}
						})
						.error(function (xhr) {
							console.log(xhr)
							var notif = noty({
								text: xhr.status + ' ' + xhr.statusText,
								layout: 'topRight',
								timeout: 5000,
								type: 'warning'
							});

						})
						.always(function () {
							noty_button.removeClass('disabled loading');
							cancel_button.removeClass('disabled');
						});
				}
					}, {
				addClass: 'ui negative small button',
				text: '<i class="icon close"></i>Tidak',
				onClick: function ($noty, $this) {
					$noty.close();
				}
		}]
		});
	}
});

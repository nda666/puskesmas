$(document).ready(function () {
	$('#resep-dropdown').dropdown({
		apiSettings: {
				url: $('#resep-dropdown').attr('data-source') + '?id='+ $('#resep-dropdown').attr('data-id') +'&find={query}'
		}
	});
	$('#data-konsultasi-resep thead th').addClass('center aligned');
	var form = '#modal-resep-insert form';
		var modal = '#modal-resep-insert';
	$(form + ' input').keydown(function(e){
		if (e.keyCode === 13){
			return false;
		}
	});
	$(form + ' input').change(function(){
			$(modal).modal('refresh');
	});
		var eTableR = '#data-konsultasi-resep';
		var table_resep = $('#data-konsultasi-resep').DataTable({
			ajax: {
				url: $('#data-konsultasi-resep').data('source'),
			},
			language: {
				url: $('#data-konsultasi-resep').data('lang')
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
		dom: "<'left no padding-bottom floated aligned sixteen wide mobile eight wide computer column'l><'right no padding-bottom aligned sixteen wide mobile eight wide computer column'f>" + "<'ui button-container sixteen wide tablet ten wide toolbars-resep column'>" +
			"<'sixteen wide column no padding top bottom'tr>" + "<'sixteen wide mobile four wide computer column'i><'right aligned sixteen wide mobile twelve wide computer column'p>",
		processing: true,
		pagingType: 'numbers',
		serverSide: true,
		filter: true,
		sort: true,
		order: [[1, 'asc']],
		info: true,
			columns: [{
				data: null,
				visible: true,
				sortable: false,
				searchable: false,
				width: '7px',
				className: 'text-center',
				render: function (data, type, row) {
					return '<div style="margin-left: 7px;" class="ui checkbox-table checkbox"><input type="checkbox"> <label></label></div>';
				},
			},{
				data: "id",
				name: 'resep.id',
    },  {
				data: "nama_obat",
				name: 'obat.nama',
    }, {
				data: 'nama',
				name: 'pegawai.nama',
    }, {
				data: 'created_at',
				name: 'resep.created_at',
    }, {
			data: 'action',
			name: 'action',
			sortable: false,
			searchable: false,
			width: '70px',
			className: 'actived text-center'
    }, ],
			drawCallback: function () {},
		});
	table_resep.on('init.dt', function () {
		yadcf.init(table_resep, [{
			column_number: 0,
			filter_type: 'text',
    },  {
			column_number: 1,
			filter_type: 'text'
    }, {
			column_number: 2,
			filter_type: 'text'
    }, {
			column_number: 3,
			filter_type: 'range_date',
			date_format: 'yyyy-mm-dd'
    }, ]);
		$('.yadcf-filter-wrapper').addClass('ui small action datatables-search input').css({
			'display': 'flex',
		});
		$('.yadcf-filter-wrapper button').html('<i class="close icon"></i>')
		$('.yadcf-filter-wrapper button').addClass('ui small icon button');
		$('[id^=yadcf]').hide();
		new $.fn.dataTable.Buttons(table_resep, {
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
				className: 'primary icon tambah-resep-btn',
				titleAttr: 'Tambah Resep Baru',
				action: function (e, dt, node, config) {
					$(form).form('clear');
					$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
					$(form + ' [name="rawat_jalan_id"]').val($(form).attr('data-id'));
					$(modal + ' .header').text('Tambah Data Resep');
					$(modal).modal({
						closable: false,
						onApprove: function () {
							form_submit(form, false, function () {
								$(form).form('clear');
								$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
								$(form + ' [name="rawat_jalan_id"]').val($(form).attr('data-id'));
								table_resep.ajax.reload();
							});
							return false;
						},
						onShow: function(){
							$(form).find('#resep-dropdown').addClass('multiple');
						}
					}).modal('show');
				}
      }, {
				text: '<i class="trash icon"></i>Hapus',
				className: 'negative hapus-resep-btn',
				titleAttr: 'Hapus Resep Yang di Checklist',
				action: function (e, dt, node, config) {
					var data = dt.rows($('#data-konsultasi-resep input:checked').parents('tr')).data();
					if (data.length <= 0) {
						return false;
					}
					var id_ar = new Array,
						ele = node;
					$.each(data, function (index, val) {
						id_ar.push(val.id);
					});
					delete_resep(id_ar);
				}
      }, ]
		});
		new $.fn.dataTable.Buttons(table_resep, {
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
					$('#data-konsultasi-resep .checkbox-table').checkbox('check');
				}
			}, {
				text: '<i class="icon close"></i>Un-Check',
				className: 'check-btn',
				action: function (e, dt, node, config) {
					$('#data-konsultasi-resep .checkbox-table').checkbox('uncheck');
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
		table_resep.buttons(0, 1).container().prependTo($('.toolbars-resep'));
		$('.ui.button').popup();
	});

	$(form).form({
		inline: true,
		on: 'submit',
		fields: {

			resep_id: ['empty'],
		}
	});

	$(eTableR).on('click','.delete-btn', function(e){
		e.preventDefault();
		table_resep.ajax.reload();
		var data = table_resep.row($(this).parents('tr')).data();
		var id = [data.id];
		if (!data) {
			return false;
		}
		delete_resep(id);
	});
	$(eTableR).on('click', '.edit-btn', function(e){
		var data = table_resep.row($(this).parents('tr')).data();
		if (!data) {
			return false;
		}
		$(modal + ' .header').text('Ubah Data Resep - ID: ' + data.id);
		$(form).form('clear');
		table_resep.ajax.reload();
		$(form + ' input[type="hidden"][name="_token"]').val($(form).attr('data-token'));
		$(form + ' [name="rawat_jalan_id"]').val(data.rawat_jalan_id);
		$(form + ' [name="resep"]').val(data.resep);
		$(form + ' [name="id"]').val(data.id);
		$(modal).modal({
			closable: false,
			onApprove: function () {
				form_submit(form, false, function () {
					table_resep.ajax.reload();
				});
				return false;
			},
			onShow: function(){
				$(form).find('[name="obat_id"]').val(data.obat_id);
				$(form).find('#resep-dropdown').dropdown('set text', data.nama_obat);
				$(form).find('#resep-dropdown').removeClass('multiple');
			}
		}).modal('show');

	});
	function delete_resep(id){
		var n = noty({
			modal: true,
			text: 'Hapus resep obat yang anda pilih?',
			buttons: [{
				addClass: 'ui positive small button',
				text: '<i class="icon trash"></i>Hapus',
				onClick: function ($noty, $this) {
					var noty_button = $(this),
						cancel_button = $(this).parent().find('.negative');
					noty_button.addClass('loading disabled');
					cancel_button.addClass('disabled');
					$.get($('#form-resep').attr('data-hapus'), {
							"id": id
						}, function (response) {
							if (response && response.response) {
								table_resep.ajax.reload();
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

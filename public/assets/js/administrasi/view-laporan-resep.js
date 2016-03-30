$(document).ready(function () {
	$('#resep-dropdown').dropdown({
		apiSettings: {
			url: $('#resep-dropdown').attr('data-source') + '?id=' + $('#resep-dropdown').attr('data-id') + '&find={query}'
		}
	});
	$('#data-konsultasi-resep thead th').addClass('center aligned');
	var form = '#modal-resep-insert form';
	var modal = '#modal-resep-insert';
	$(form + ' input').keydown(function (e) {
		if (e.keyCode === 13) {
			return false;
		}
	});
	$(form + ' input').change(function () {
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
		stateSave: true,
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
		info: true,
		columns: [{
			data: "id",
			name: 'resep.id',
			className: 'collapsing'
    }, {
			data: "nama_obat",
			name: 'obat.nama',
    }, {
			data: 'nama',
			name: 'pegawai.nama',
    }, {
			data: 'created_at',
			name: 'resep.created_at',
			className: 'collapsing'
    }, ],
		drawCallback: function () {},
	});
	table_resep.on('init.dt', function () {
		yadcf.init(table_resep, [{
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
			filter_type: 'range_date',
			date_format: 'yyyy-mm-dd',
			filter_reset_button_text: false,
    }, ]);
		$('.yadcf-filter-wrapper').addClass('ui datatables-search input').css({
			'display': 'flex',
		});
		$('#yadcf-filter-wrapper--data-konsultasi-resep-0 input').css('width', '50px');
		$('[id^=yadcf]').hide();

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
					table_resep.ajax.reload();
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
					table_resep.columns.adjust();
				}
						}, {
				text: '<i class="undo icon"></i>Clear',
				className: 'clear-search-btn',
				action: function (e, dt, node) {
					yadcf.exResetAllFilters(table_resep)
					table_resep.columns.adjust();
				}
				}, ]
		});
		table_resep.buttons(0, 1).container().prependTo($('.toolbars-resep'));
		table_resep.columns.adjust();
	});
});

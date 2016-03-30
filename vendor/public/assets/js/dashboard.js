$(document).ready(function () {
	function labelFormatter(label, series) {
		return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
	}
	var table = $('#table-pasien').DataTable({
		ajax: {
			url: $('#table-pasien').data('source'),
		},
		language: {
			url: $('#table-pasien').data('lang')
		},
		dom: "<'sixteen wide column'tr>",
		processing: true,
		serverSide: true,
		filter: true,
		sort: true,
		info: true,
		columns: [{
			data: "id",
			name: 'id',
			orderable: false,
			searchable: false
		}, {
			data: 'pasien.nama',
			name: 'pasien.nama',
			orderable: false,
			searchable: false
		}, {
			data: 'pasien.jenis_kelamin',
			name: 'pasien.jenis_kelamin',
			orderable: false,
			searchable: false
		}, ],
	});
	$.ajax({
		url: $('#bar-chart').attr('data-source'),
		type: 'GET',
		dataType: 'json',
		success: function (res) {
			var b_data = [];
			$.each(res, function (index, val) {
				b_data.push([index, val]);
			});
			var bar_data = {
				data: b_data,
				color: "#2185d0",
			};
			var bar_option = {
				grid: {
					borderWidth: 1,
					borderColor: "#efefef",
					tickColor: "#efefef",
					hoverable: true,
				},

				series: {
					lines: {
						show: true
					},
					points: {
						show: true
					},
				},
				lines: {
					lineWidth: 2,
					fill: true,
					steps: false
				},
				xaxis: {
					mode: "categories",
					tickLength: 0,
				}

			};
			$.plot("#bar-chart", [bar_data], bar_option);

			$(window).resize(function () {
				$.plot("#bar-chart", [bar_data], bar_option);
			});
			$('<div class="ui inverted flowing top small center popup" id="bar-chart-tooltip"></div>').css({
				width: '80px',
				textAlign: 'center'
			}).appendTo("body");

			$("#bar-chart").bind("plothover", function (event, pos, item) {
				if (item) {
					var x = item.series.data[item.dataIndex][0],
						y = item.series.data[item.dataIndex][1];
					$("#bar-chart-tooltip").html('<div><b>' + x + ":</b> " + y + '</div>')
						.css({
							top: item.pageY - ($("#bar-chart-tooltip").height() + 35),
							left: item.pageX - 41
						})
						.show();

				} else {
					$("#bar-chart-tooltip").hide();
				}
			});

		}
	});

	$.ajax({
		url: $('#pie-chart').attr('data-source'),
		type: 'GET',
		dataType: 'json',
		success: function (res) {
			var data = res.data;
			var option = {
				series: {
					pie: {
						show: true,
						radius: 1,
						label: {
							show: true,
							radius: 3 / 4,
							formatter: labelFormatter,
							background: {
								opacity: 0.5,
								color: '#000'
							}
						}
					}
				},
				legend: {
					show: false
				},
				grid: {
					hoverable: true,
					clickable: true
				}
			};
			$.plot('#pie-chart', data, option);
			$(window).resize(function () {
				$.plot('#pie-chart', data, option);
			});
		}
	});

});

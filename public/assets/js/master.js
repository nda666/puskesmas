function uppercase_word(e){
	e.value = e.value.toUpperCase();
}

$(function () {
	var ev = new Event("look", {"bubbles":true, "cancelable":false});
	document.dispatchEvent(ev);

	function PrintPage(element) {
		var head = $('head'),
			css = '';
		$(head).find('link').each(function (index, el) {
			css += '<link rel="stylesheet" media="all" type="text/css" href="' + $(el).attr('href') + '">';
		});
		Popup(element, css);
	}

	function Popup(data, css) {
		var m_window = window.open();
		m_window.document.write('<html><head>' + css + '</head>');
		m_window.document.write('<body><div class="container">' + $(data).html() + '</div></body></html>');
		m_window.document.getElementById('export-tool').remove();
		$(m_window.document).find('.breadcrumb').remove();
		m_window.document.close();
		setTimeout(function () {
			m_window.print();
			m_window.close();
		}, 200)
		return false;
	}
});
$(document).ready(function () {
  var global_form = true;
	$.fn.form.settings.rules.emptyif = function (value, option) {
		var sOptions = option.split(':');

		if ($('[name="' + sOptions[0] + '"]').is(':' + sOptions[1])) {
			if (value == '') {
				return false;
			}
			return true;
		} else {
			return true;
		}
	}
	$.fn.form.settings.rules.agama = function (value) {
		switch (value) {
		case 'Islam':
			return true;
			break;
		case 'Kristen':
			return true;
		case 'Katholik':
			return true;
		case 'Hindu':
			return true;
		case 'Budha':
			return true;
		case 'Lain-Lain':
			return true;
		default:
			return false;
			break;
		}
		return false;
	}
	$.fn.form.settings.text = {
		unspecifiedRule: 'Dimohon untuk mengisi dengan isian yang valid',
		unspecifiedField: 'Field ini'
	}
	$.fn.form.settings.prompt = {
		empty: '{name} harus di isi',
		checked: '{name} harus di check',
		email: '{name} harus email yang valid',
		url: '{name} harus url yang valid',
		regExp: '{name} tidak terformat dengan benar',
		integer: '{name} harus berisi integer',
		decimal: '{name} harus berisi angka desimal',
		number: '{name} harus berisa angka',
		is: '{name} harus seperti "{ruleValue}"',
		isExactly: '{name} harus persis seperti "{ruleValue}"',
		not: '{name} tidak bisa seperti "{ruleValue}"',
		notExactly: '{name} tidak bisa persis seperti "{ruleValue}"',
		contain: '{name} tidak bisa berisi "{ruleValue}"',
		containExactly: '{name} tidak bisa berisi persis "{ruleValue}"',
		doesntContain: '{name} harus berisi  "{ruleValue}"',
		doesntContainExactly: '{name} harus berisi persis "{ruleValue}"',
		minLength: '{name} harus lebih dari {ruleValue} karakter',
		length: '{name} harus paling sedikit {ruleValue} karakter',
		exactLength: '{name} harus persis {ruleValue} karakter',
		maxLength: '{name} tidak bisa lebih dari {ruleValue} karakter',
		match: '{name} harus cocok dengan field {ruleValue}',
		different: '{name} harus berbeda dengan field {ruleValue}',
		creditCard: '{name} harus nomor kartu kredit yang valid',
		minCount: '{name} harus paling sedikit memiliki {ruleValue} pilihan',
		exactCount: '{name} harus memiliki {ruleValue} pilihan',
		maxCount: '{name} harus memiliki {ruleValue} pilihan atau kurang'
	}
	$.fn.modal.settings.observeChanges = true;
	$('#user-dropdown').dropdown();
	if ($.noty) {
		$.noty.defaults = {
			layout: 'center',
			theme: 'relax', // or 'relax'
			text: '', // can be html or string
			dismissQueue: true, // If you want to use queue feature set this true
			template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
			animation: {
				open: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceInLeft'
				close: {height: 'toggle'}, // or Animate.css class names like: 'animated bounceOutLeft'
				easing: 'swing',
				speed: 100 // opening & closing animation speed
			},
			timeout: false, // delay for closing event. Set false for sticky notifications
			force: false, // adds notification to the beginning of queue when set to true
			modal: false,
			maxVisible: 5, // you can set max visible notification for dismissQueue true option,
			killer: false, // for close all notifications before show
			closeWith: ['click'], // ['click', 'button', 'hover', 'backdrop'] // backdrop click will close all notifications
			callback: {
				onShow: function () {},
				afterShow: function () {},
				onClose: function () {},
				afterClose: function () {},
				onCloseClick: function () {},
			},
			buttons: false // an array of buttons
		};
	}
	$('.left-menu-toggle').click(function (e) {
		console.log('asu')
		if ($('.toc').hasClass('hide')) {
			$('.toc').removeClass('hide');
			$('.right-navbar').css({
				width: 'calc(100% - 250px)',
				left: '250px'
			});

			$('.datatable-container').removeClass('toggled');
		} else {
			$('.toc').addClass('hide');
			$('.right-navbar').css({
				width: '100%',
				left: '0'
			});

			$('.datatable-container').addClass('toggled');
		}
		$(window).trigger('resize');
		event.preventDefault();
	});

	$('.sidebar-toggle').click(function (e) {
		$('.ui.sidebar').sidebar('toggle');
	});

	$('.left-menu').change(function(){
		alert('oi')
	})
	var forms_update = function (url, form, callback) {
		if (url == null || form == null) {
			return false;
		}
		var _form = form,
			_url = url;
		$(form).addClass('disabled loading');
		$.ajax({
			method: 'GET',
			url: _url,
			dataType: "json",
			success: function (response) {
				if (response && response.results) {
					$.each(response.results, function (index, value) {
						$(_form + ' [name="' + index + '"]').val(value);
					});
					if (callback != null) {
						callback();
					}
					return true;
				}
				var notif = noty({
					layout: 'topRight',
					text: 'Terjadi kesalahan, coba ulangi lagi',
					timeout: 5000
				});
			},
			error: function (xhr) {
				var notif = noty({
					layout: 'topRight',
					text: 'Terjadi kesalahan<br>' + xhr.status + ' ' + xhr.statusText,
					timeout: 5000
				});
			},
			complete: function () {
				$(_form).removeClass('disabled loading');
			}
		});
		return false;
	}
	$('.helper').popup({
		hoverable: true,
		on: 'click',
	});
	window.forms_update = forms_update;

  var form_submit = function(form, clear, callback) {
    $(form).unbind('submit');
    $(form).submit(function(e) {
			if (! $(form).form('is valid')){
				return false;
			}
      if ($(form).hasClass('loading') || /*!$(form).form('is valid') ||*/ !global_form) {
        return false;
      }
      global_form = false;

			var url = $(form).attr('action');
      var data = new FormData($(form)[0]),
        ele = $(form);
      var n = noty({
        text: 'Simpan data?',
        buttons: [{
          addClass: 'ui positive small button',
          text: '<i class="icon save"></i>Simpan',
          onClick: function($noty, $this) {
            ele.addClass('loading');
            $(this).addClass('disabled');
            $(this).parent().find('.negative').addClass('disabled');
            var noty_button = $(this),
              cancel_button = $(this).parent().find('.negative');
            $noty.setText('<i class="icon asterisk loading"></i>Mohon tunggu sebentar');
            $.ajax({
              url: url,
							contentType: false,
							processData: false,
              type: 'POST',
              dataType: 'json',
              data: data,
              success: function(response) {
                if (response && response.response) {
                  var notif = noty({
                    layout: 'topRight',
                    text: response.message,
                    timeout: 5000,
                    type: 'success'
                  });
                  if (clear) {
                    ele.form('clear');
                    ele.find('[name="_token"]').val(ele.attr('data-token'));
                  }
                  if (callback) {
                    callback(response);
                  }
                  $noty.close();
                } else if (response && !response.response) {
                  $noty.close();
                  var notif = noty({
                    layout: 'topRight',
                    text: response.message,
                    timeout: 10000,
                    type: 'warning'
                  });
                }
              },
              error: function(xhr) {
                if (xhr.status == 422) {
                  $noty.close();
                  var err = $.parseJSON(xhr.responseText);
                  var message = '<b>Form Validasi: </b>';
                  message += '<ul style="text-align: left;">'
                  $.each(err, function(index, item) {
                    if (Array.isArray(item)) {
                      $.each(item, function(idx, val) {
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
                  type: 'error',
                  timeout: 10000,
                });
              },
              complete: function() {
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
          onClick: function($noty) {
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
  window.form_submit = form_submit;

});

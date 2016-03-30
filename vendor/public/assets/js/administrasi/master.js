var load_script,
    loaded_script = [],
    form_api,
    load_page, refresher;
(function() {
    jQuery.cachedScript = function(url, options) {
        options = $.extend(options || {}, {
            dataType: "script",
            cache: false,
            url: url
        });
        return jQuery.ajax(options);
    };
    load_script = function($data, $index) {
        $i = ($index == null ? 0 : $index)
        while ($i < $data.length) {
            $.cachedScript($data[$i]).done(function() {
                load_script($data, $i + 1);
            });
            return false;
        }
    }
    is_script_loaded = function(script_name) {
        var founded = false;
        if (loaded_script.length > 0) {
            for (var i = 0; i < loaded_script.length; i++) {
                if (loaded_script[$i] == script_name) {
                    founded = true;
                }
            }
        }
        if (!founded) {
            loaded_script.push(script_name);
        }
        return founded;
    }
    load_page = function(url) {
        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function() {
                clearInterval(refresher)
            },
            success: function(data) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
                history.pushState({}, '', url);
                document.title = $(data).filter('title').text();
                $('#loaded-content').html($(data).find('#loaded-content').html());
                $('html, body').scrollTop(0)
            }
        })
    }
}());
$(document).ready(function() {
    var sidebar = $('.ui.sidebar').sidebar({
        transition: 'slide along',
    });
    $('.sidebar-toggle').click(function(e) {
        $('.ui.sidebar').sidebar('toggle');
    });

    $(window).resize(function() {
        $('.main.content .ui.row.grid').css('min-height', $('.ui.sidebar').height() + 'px');
    })
    $(window).trigger('resize');

});

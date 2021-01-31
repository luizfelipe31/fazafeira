$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('form[name="login"]').submit(function (event) {
        event.preventDefault();

        const form = $(this);
        const action = form.attr('action');
        const email = form.find('input[name="email"]').val();
        const password = form.find('input[name="password_check"]').val();

        var load = $(".ajax_load");

        load.fadeIn(200).css("display", "flex");

        $.post(action, {email: email, password: password}, function (response) {

            if(response.message) {
                load.fadeOut(200);
                ajaxMessage(response.message, 3);
            }

            if(response.redirect) {
                window.location.href = response.redirect;
            }
        }, 'json');

    });


    // $("form:not('.login')").submit(function (event) {
    //     event.preventDefault();
    //
    //     var form = $(this);
    //     var load = $(".ajax_load");
    //
    //     form.ajaxSubmit({
    //         url: form.attr("action"),
    //         type: "POST",
    //         dataType: "json",
    //         beforeSend: function () {
    //             load.fadeIn(200).css("display", "flex");
    //         },
    //         uploadProgress: function (event, position, total, completed) {
    //             var loaded = completed;
    //             var load_title = $(".ajax_load_box_title");
    //             load_title.text("Enviando (" + loaded + "%)");
    //
    //             if (completed >= 100) {
    //                 load_title.text("Aguarde, carregando...");
    //             }
    //         },
    //         success: function (response) {
    //             if(response.message) {
    //                 load.fadeOut(200);
    //                 ajaxMessage(response.message, 3);
    //             }
    //
    //             if(response.redirect) {
    //                 window.location.href = response.redirect;
    //             }
    //         },
    //         error: function (response) {
    //             load.fadeOut(200);
    //         }
    //     });
    // });

    // AJAX RESPONSE
    var ajaxResponseBaseTime = 3;

    function ajaxMessage(message, time) {
        var ajaxMessage = $(message);

        ajaxMessage.append("<div class='message_time'></div>");
        ajaxMessage.find(".message_time").animate({"width": "100%"}, time * 1000, function () {
            $(this).parents(".message").fadeOut(200);
        });

        $(".ajax_response").append(ajaxMessage);
    }

    // AJAX RESPONSE MONITOR
    $(".ajax_response .message").each(function (e, m) {
        ajaxMessage(m, ajaxResponseBaseTime += 1);
    });

    // AJAX MESSAGE CLOSE ON CLICK
    $(".ajax_response").on("click", ".message", function (e) {
        $(this).effect("bounce").fadeOut(1);
    });
});

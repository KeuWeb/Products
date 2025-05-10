import $ from 'jquery';

    $(function() {
        window.msgPopup = function(tipo, texto) {
            if (tipo != null && texto != null) {
                if (tipo == "alert" || tipo == "excluse") {
                    var icon = 'bi-exclamation-triangle-fill'
                    var corIcon = "#F27935";
                } else if (tipo == "error" || tipo == "firewall") {
                    var icon = "bi-x-circle-fill";
                    var corIcon = "#E83B53";
                } else if (tipo == "delete") {
                    var icon = "bi-question-circle-fill";
                    var corIcon = "#F27935";
                } else if (tipo == "success") {
                    var icon = 'bi-check-circle-fill'
                    var corIcon = "#209645";
                } else if (tipo == "info") {
                    var icon = "bi-info-circle-fill";
                    var corIcon = "#00AFD1";
                } else {
                    var icon = "bi-dash-circle-fill";
                    var corIcon = "#000000";
                }

                $('#msg-popup span').html(texto);
                $('#msg-popup i').css({
                    'color':corIcon
                });

                $('#container-products').css({
                'filter':'blur(5px)'
                });

                if ($('#msg-popup').attr("data-status") == "on") {
                    $('#msg-popup').removeClass("animate__fadeInDownBig").addClass("animate__fadeOutUpBig").attr('data-status',"off");

                    clearTimeout(timePopup);

                    setTimeout(function() {
                        if (tipo == "delete") {
                            $('.btns-delete').removeClass('d-none');
                        }

                        $('#msg-popup').css({
                            'display':"block"
                        }).removeClass('animate__fadeOutUpBig').addClass('animate__fadeInDownBig').attr('data-status',"on");

                        $('.time-bar').html("<div></div>");
                    }, 500);

                } else {
                    $('#container-loader').addClass('d-none');

                    if (tipo == "delete") {
                        $('.btns-delete').removeClass('d-none');
                    }

                    $('#msg-popup i').removeAttr('class').attr('class','bi ' + icon).css({
                        'color':corIcon
                    });

                    $('#msg-popup').css({
                        'display':"block"
                    }).removeClass('animate__fadeOutUpBig').addClass('animate__fadeInDownBig').attr('data-status',"on");

                    $('.time-bar').html("<div></div>");


                    timePopup = setTimeout(
                        function() {
                            $('#msg-popup').removeClass('animate__fadeInDownBig').addClass('animate__fadeOutUpBig').attr('data-status',"off");
                            $('#container-products').css({
                                'filter':'blur(0)'
                        });
                    }, 10000);
                }

                return false;
            }
        }

        var timePopup;

        $(document).on('click', '#msg-popup,.no', function () {
            $(this).removeClass('animate__fadeInDownBig').addClass('animate__fadeOutUpBig').attr('data-status',"off");
            $('.btns-delete').addClass('d-none');
            $('#container-products').css({ 'filter':'blur(0)' });
            clearTimeout(timePopup);
        });
    });


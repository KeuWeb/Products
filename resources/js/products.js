import $ from 'jquery';

$(document).ready(function () {
    let preco = $('#preco').val();
    if (preco && preco.includes('.')) {
        preco = preco.replace('.', ',');
        $('#preco').val(preco);
    }

    $('#preco').mask('000.000.000,00', {reverse: true});
    $('#quantidade').mask('000000000');

    // Ação para abertura da modal de informações (Booth > Eleição)
    $(document).on('click', '.info-product', function (e) {
        e.preventDefault();

        let idProduct = $(this).attr('data-product');

        $.ajax({
            url: "/product/info",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                idProduct: idProduct
            },
            dataType: "json",
            success: function(response) {
                $('#container-products').css({
                    'filter':'blur(5px)'
                });

                setTimeout(function() {
                    $('#container-info').html(response.html);

                    $('#modal-info').css({
                        'display':"block"
                    }).removeClass('animate__fadeOutUpBig').addClass('animate__fadeInDownBig').attr('data-status',"on");
                }, 300);
            },
            error: function(xhr) {
                msgPopup(response.status, response.message);
            },
            statusCode: {
                500: function() {
                    msgPopup('error', 'Ops! Erro ao efetuar solicitação, tente mais tarde.');
                }
            }
        });
    });
    // Ação para fechar a modal de informações (Booth > Eleição)
    $(document).on('click', '.btn-close-modal-info', function() {
        $('#modal-info').removeClass('animate__fadeInDownBig').addClass('animate__fadeOutUpBig').attr('data-status',"off");

        setTimeout(function() {
            $('#modal-info').css({
                'display':"none"
            });

            $('#container-info').html('');

            $('#container-products').css({
                'filter':'none'
            });
        }, 400);
    });
});

$(function() {
    // Questionamento quanto a exclusão do registro
    $(document).on('click', '.delete', function() {
        let id = $(this).attr('data-id');
        let module = $(this).attr('data-module');

        $('#idDelete').val(id);

        msgPopup('delete', 'Tem certeza que deseja excluir?');

        return false;
    });
    // Efetivação da exclusão do registro
    $('body').on('submit', '#form-delete', function(event) {
        event.preventDefault();

        $.ajax({
            url: $('#route-delete').val(),
            type: "put",
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {

                if (response.status == 'success') {
                    $('#line-' + $('#idDelete').val()).addClass('d-none');
                }

                msgPopup(response.status, response.message);

                return false;
            },
            error: function(response) {

                msgPopup(response.status, response.message);

                return false;
            },
            statusCode: {
                500: function() {
                    msgPopup('error', 'Ops! Erro ao efetuar solicitação, tente mais tarde.');
                }
            }
        });
    });
    // Buscador de registros
    $(document).on('click', '#btn-search', function() {
        let search = $('#src').val();
        let module = $('#src').attr('data-module');

        window.location = window.location.href + '?module=' + module + '&src=' + search;
    });
    // Salvar ou editar dados
    $('body').on('submit', '#form-product', function(event) {
        event.preventDefault();

        $('#salvar').val('AGUARDE...').attr('disabled','disabled');

        $.ajax({
            url: $('#route').val(),
            type: "put",
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {

                msgPopup(response.status, response.message);

                if (response.status == "success") {
                    if($('#id').val() == ""){

                        $('#nome, #preco').val('');
                        $('#quantidade').val(1);
                        $('#descricao').html('').val('');
                    }
                }

                $('#salvar').val('SALVAR').removeAttr('disabled');

                return false;
            },
            error: function(response) {

                msgPopup(response.status, response.message);

                $('#salvar').val('SALVAR').removeAttr('disabled');

                return false;
            },
            statusCode: {
                500: function() {
                    msgPopup('error', 'Ops! Erro ao efetuar solicitação, tente mais tarde.');
                }
            }
        });
    });
});

$(function(){
    var message = $('.response');
    message.hide();
    $('.create').on('click',function(){
        var route = $(this).data('root');
        $('.content').load( route + '/create');
    });
    $('#btn-save').on('click',function(e){
        e.preventDefault();
        $('#btn-save').prop('disabled',true);
        var form = $('#form-create');
        var tipo = form.prop('method');
        var url = form.attr('data-url');
        var data = form.serialize();
        $.ajax({
            url: url,
            type: tipo,
            data: data,
            success: function(response) {
                console.log(response);
                if(response) {
                    if(response.success){
                        console.log(response.message);
                        $('.response strong').css('color','black');
                        $('.response strong').text(response.message);
                        message.show();
                    }else{
                        console.log(response.message);
                        $('.response strong').text('Error al guardar el registro');
                        $('.response strong').css('color','orange');
                        message.show();

                    }
                    if(url === "bitacoraPagos")
                    {
                        url = 'pagos';
                    }

                    setTimeout(function(){
                        window.location.href = url;
                    },2000)
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                console.log(xhr.status);
                console.error(thrownError);
            }
        });
    });


    $('.edit').on('click',function(e){
        e.preventDefault();
        id = $(this).data('id');
        url= $(this).data('url');
        url = url + '/'+ id;
        $('#div-modal').load(url,'action=edit',function(){
            $('#modal-edit').modal({show:true});
            $('#btn-edit').on('click',function(){
                var form = $('#form-edit');
                var url = form.attr('data-url')
                var url2 = url +'/'+ id ;
                var data = form.serialize();
                $.ajax({
                    url: url2,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        if(response) {
                            if(response.success){
                                console.log(response.message);
                                $('.response strong').css('color','black');
                                $('.response strong').text(response.message);
                                message.show();
                            }else{
                                console.log(response.message);
                                $('.response strong').text('Error al guardar el registro');
                                $('.response strong').css('color','orange');
                                message.show();

                            }
                            setTimeout(function(){
                                window.location.href = url;
                            },2000)
                        }
                    },
                    error: function(xhr,ajaxOptions,thrownError){
                        console.log(xhr.status);
                        console.error(thrownError);
                    }
                });
            })
        })
    });
    $('.delete').on('click',function(e) {
        e.preventDefault();
        id = $(this).data('id');
        url = $(this).data('url');
        url = url + '/' + id;
        $('#div-modal').load(url, 'action=delete', function () {
            $('#modal-delete').modal({show: true});
            $('#btn-delete').on('click',function(){
                var form = $('#form-delete');
                var url = form.attr('data-url');
                var id = form.attr('data-id');
                var url2 = url +'/'+ id ;
                $.ajax({
                    url: url2,
                    type: 'DELETE',
                    success: function(response) {
                        console.log(response);
                        if(response) {
                            if(response.success){
                                console.log(response.message);
                                $('.response strong').css('color','black');
                                $('.response strong').text(response.message);
                                message.show();
                            }else{
                                console.log(response.message);
                                $('.response strong').text('Error al guardar el registro');
                                $('.response strong').css('color','orange');
                                message.show();

                            }
                            setTimeout(function(){
                                window.location.href = url;
                            },2000)
                        }
                    },
                    error: function(xhr,ajaxOptions,thrownError){
                        console.log(xhr.status);
                        console.error(thrownError);
                    }
                });
            })
        });
    });

    $('.monthlyFee').change(function(){
        var interesCalculado = 0;
        var noCuotasCalculado = 0;
        var cantidad = $('.share').val();
        var interes = $('.interest').val();
        var noCuotas = $('.no_share').val();

        if (interes !=0 && noCuotas !=0)
        {
            interesCalculado = ( ( cantidad * interes ) / 100 );
            noCuotasCalculado = ( (cantidad / noCuotas) + interesCalculado);
            $('.shareFinal').val(noCuotasCalculado.toFixed(2));

        }



    })

    $('#codigo').keypress(function(e){
        if(e.keyCode == 13)
        {
            var codigo = $(this).val();
            getInfo(codigo);
        }

    });

    function getInfo(code)
    {
        var url = 'clientes/' + code + '/edit';
        $.ajax({
            url: url,
            type: 'get',
            success: function(response) {

                console.log(response);

                if(response.success)
                {
                    $('#dpi').val(response['client']['dpi']);
                    $('#nombre').val(response['client']['nombre'] + ' ' + response['client']['apellido']);
                    $('#direccion').val(response['client']['direccion']);
                    $('#monto').val(response['share']['montoCuota']);
                    $('#fechaCuota').val(response['share']['fechaPago']);
                    $('#idCredito').val(response['creditMaster']['id']);
                    $('#idShare').val(response['shareMaster']['id']);
                    $('#idCreditoBranch').val(response['credit']['id']);
                    $('#idShareBranch').val(response['share']['id']);
                    var id = $('#selectMoneda').val();
                    getInfoMoneda(id);
                    $("#selectMoneda").removeAttr("disabled");
                }
                else{
                    $('#dpi').val('');
                    $('#nombre').val('');
                    $('#direccion').val('');
                    $('#monto').val('');
                    $('#fechaCuota').val('');
                    $('#montoMoneda').val('');
                    $("#selectMoneda").prop('disabled', 'disabled');
                }

            },
            error: function(xhr,ajaxOptions,thrownError){
                console.log(xhr.status);
                console.error(thrownError);
            }
        });
    }

    $('#selectMoneda').on('change',function(){
        var id = $(this).val();
        getInfoMoneda(id);

    });

    function getInfoMoneda(id){
        var url = 'tipoMonedas/' + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(response) {
                var moneda = response.cantidad;
                var monto = $('#monto').val();
                var montoMoneda = monto / moneda;
                $('#montoMoneda').val(montoMoneda.toFixed(2));

            },
            error: function(xhr,ajaxOptions,thrownError){
                console.log(xhr.status);
                console.error(thrownError);
            }
        });
    }


    $('#btn-leer').on('click',function(e){
        e.preventDefault();
        var id = $(this).data('id');

        var url = 'sincronizar/' + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(response) {
              console.log(response);
                if(response) {
                    if(response.success){
                        console.log(response.message);
                        $('.response strong').css('color','black');
                        $('.response strong').text(response.message);
                        message.show();
                    }else{
                        console.log(response.message);
                        $('.response strong').text('Error al guardar el registro');
                        $('.response strong').css('color','orange');
                        message.show();

                    }
                    setTimeout(function(){
                        window.location.href = 'sincronizar';
                    },2000)
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                console.log(xhr.status);
                console.error(thrownError);
            }
        });


    })

    $('#btn-enviar').on('click',function(e){
        var id = $(this).data('id');
        var url = 'sendData/' + id;
        $.ajax({
            url: url,
            type: 'get',
            success: function(response) {
                console.log(response);
                if(response) {
                    if(response.success){
                        console.log(response.message);
                        $('.response strong').css('color','black');
                        $('.response strong').text(response.message);
                        message.show();
                    }else{
                        console.log(response.message);
                        $('.response strong').text('Error al guardar el registro');
                        $('.response strong').css('color','orange');
                        message.show();

                    }
                    setTimeout(function(){
                        window.location.href = 'sincronizar';
                    },2000)
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                console.log(xhr.status);
                console.error(thrownError);
            }
        });
    });




});

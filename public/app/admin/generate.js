$(function(){

    $('#btn-open-wizard').click(function(e) {
        $("#page").load("ballots/create");
    });

    $('#btn-cancel-wizard').click(function(e){
        $('#page').load('ballots');
    });

    $('[name = "finish"]').click(function(){
        $('[name = "finish"]').prop('disabled',true);
        CRUD.action('#form-create', function(response){
            $('[name = "finish"]').prop('disabled',false);
            window.open('pdf/' + response.id,'_blank');
            $('#page').load('ballots');
        });
    });

    $('.fieldBallot').click(function(){
         var id =$(this).data('id');
           $("#page").load("ballotsDetail/" + id );
    });

    $('#btnSaveDetailBallot').click(function(e){
        $('#btnSaveDetailBallot').prop('disabled',true);
        $.ajax({
            url: 'ballotsDetailSave',
            data: $("#form-create-Detail").serialize(),
            success: function(data){
                console.info(data);
                if(data.success) {
                    window.open('pdfDetail/' + data.id,'_blank');
                    $('#page').load('ballots');
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                console.log(xhr.status);
                console.error(thrownError);
            }
        });
    });

    $('.downloadDetalle').click(function(e){
        alert("hola como estas");
    });


});

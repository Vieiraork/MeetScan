(function () {
    function init() {
        events();
        $(".cep").mask("00.000-000");
    }

    function events() {
        $(document).on('change', '#sg_uf', loadMunicipio);
        $(document).on('keyup blur focus click', '#nr_cep', loadEndereco);
    }

    function loadMunicipio(){
        var url = $(this).attr('data-href');

        $("#cd_municipio").prop("disabled", true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type	: "GET",
            url		: url,
            data    : {
                _token: $('meta[name="csrf-token"]').attr('content'),
                sg_uf : $(this).val()
            },
            beforeSend: function() {
                $("#cd_municipio").val('').trigger('change')
                $('#carregar').html("<img src='/img/preloader.gif' style='width: 40px;' style='display: none; text-align: center;'> CARREGANDO");
            },
            complete: function(){
                $('#carregar').html("");
                $("#cd_municipio").prop("disabled", false);
            },
            success	: function(retorno) {
                $('#cd_municipio').html('Carregando...')
                    .find('option')
                    .remove()
                    .end();
                $('#cd_municipio').append('<option value="">Selecione</option>');
                $.each(retorno,function(key, value){
                    $('#cd_municipio').append('<option value="'+ key +'">'+ value+'</option>');

                    if($('#cdMunicipio').val() != null){
                        $('#cd_municipio').val($('#cdMunicipio').val());
                    }

                });

            }
        });
    }

    function loadEndereco(){
        let cep = $(this).val().replace(/\D/g,'');
        $(".endereco").prop("disabled", true);
        if(cep.length === 8){
            let url = $('input[name=inputRouteCep]').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type	: "GET",
                url		: url,
                data    : {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    nr_cep : cep
                },
                success	: function(retorno) {
                    if(retorno.endereco == null){
                        $(".endereco").prop("disabled", false).val('');
                        $("#nr_cep,#cdMunicipio").val('');
                        $("#cd_municipio,#sg_uf").val('').trigger('change')
                        $('#carregar').html("");
                    }
                    $('#cdMunicipio').val(retorno.endereco.nr_localidade_dne);
                    $('#sg_uf').val(retorno.endereco.sg_uf);
                    $('#sg_uf').trigger('change');
                    $('#ds_logradouro').val(retorno.endereco.no_logradouro_reduzido)
                    $('#no_bairro').val(retorno.endereco.no_bairro)
                    $(".endereco:not(#cd_municipio)").prop("disabled", false);
                },
                beforeSend: function() {
                    $('#carregar').html("<img src='/img/preloader.gif' style='width: 40px;' style='display: none; text-align: center;'> CARREGANDO");
                },
                complete: function(){
                    $('#carregar').html("");
                },
            });
        }

    }


    init();
})();

(function () {
    function init() {
        events();
        config();
    }

    function events() {
        $(document).on('change', '#cd_modulo', loadPerfilModulo);
    }

    function loadPerfilModulo(){
        var url = $(this).attr('data-href');
        $("#cd_perfil").prop("disabled", true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type	: "POST",
            url		: url,
            data    : {
                _token: $('meta[name="csrf-token"]').attr('content'),
                cd_modulo : $(this).val()
            },
            beforeSend: function() {
                $('#carregar').html("<img src='/img/preloader.gif' style='width: 40px;' style='display: none; text-align: center;'> CARREGANDO");
            },
            complete: function(){
                $('#carregar').html("");
            },
            success	: function(retorno) {
                $('#cd_perfil').html('Carregando...')
                    .find('option')
                    .remove()
                    .end();
                $('#cd_perfil').append('<option value="">Selecione</option>');
                $.each(retorno,function(key, value){
                    $('#cd_perfil').append('<option value="'+ value.perfil.cd_perfil +'">'+ value.perfil.no_perfil+'</option>');
                });
                $("#cd_perfil").prop("disabled", false);
            }
        });
    }

    function config() {
        moment.locale('pt-br');

        $("input[type=reset]").click(function(val, e, field, options){
            $(".select2-hidden-accessible").val('').trigger('change')
        });


        $("select:not(.simulador)").select2({
            theme: "bootstrap4",
            width: "resolve"
        });

        var behavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00)00000-0000' : '(00)0000-00009';
            },
            options = {
                onKeyPress: function (val, e, field, options) {
                    field.mask(behavior.apply({}, arguments), options);
                }
            };

        $("#ds_telefone").mask(behavior, options);
        $(".telefoneMask").mask(behavior, options);
        $("#nr_cpf").mask("000.000.000-00");
        $("#nr_cnpj").mask("00.000.000/0000-00");
        $(".moneyMask").mask("#.##0,00", {reverse: true});

        $('.datatable').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)",
                "search": "Pesquisar",
                "paginate": {
                    "next": "Próximo",
                    "previous": "Anterior",
                    "first": "Primeiro",
                    "last": "Último"
                },
            }
        });

        $.datepicker.regional["pt-BR"] = {
            closeText: "Fechar",
            prevText: "&#x3c;Anterior",
            nextText: "Pr&oacute;ximo&#x3e;",
            currentText: "Hoje",
            monthNames: [
                "Janeiro",
                "Fevereiro",
                "Mar&ccedil;o",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro",
            ],
            monthNamesShort: [
                "Jan",
                "Fev",
                "Mar",
                "Abr",
                "Mai",
                "Jun",
                "Jul",
                "Ago",
                "Set",
                "Out",
                "Nov",
                "Dez",
            ],
            dayNames: [
                "Domingo",
                "Segunda-feira",
                "Ter&ccedil;a-feira",
                "Quarta-feira",
                "Quinta-feira",
                "Sexta-feira",
                "Sabado",
            ],
            dayNamesShort: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
            weekHeader: "Sm",
            dateFormat: "dd/mm/yy",
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: "",
            changeMonth: true,
            changeYear: true,

        };
        $.datepicker.setDefaults($.datepicker.regional["pt-BR"]);
    }


    init();
})();

(function(){
    function init() {
        events();
    }

    function events() {
        $(document).on('click', '#btnSearchUser', search);
    }

    function search() {
        let url = $('#searchUsers').val();

        $.ajax({
            type: 'POST',
            url: url,
            data: $('#formSearchUsers').serializeArray(),
            success: function (result) {
                if ($.fn.dataTable.isDataTable('#tbUsers')) {
                    var table = $('#tbUsers').DataTable();
                    table.destroy();
                }

                showResults(JSON.parse(result));
            }
        })
    }

    function showResults(result) {
        $('#tbUsers tbody>tr').remove();

        $.each(result, function (key, value) {
            let row = [`<tr>`];
            row.push(`<td>${value.id_usuarios}</td>`);
            row.push(`<td>${value.no_usuario}</td>`);
            row.push(`<td>${value.ds_email}</td>`);
            row.push(`<td>${value.perfil.ds_perfil}</td>`);
            row.push(`<td>${moment(value.dt_registro).format('DD/MM/YYYY')}</td>`);
            row.push(`<td>Todas as ações</td>`);
            row.push(`</tr>`);
            $(['#tbUsers tbody'].join("")).append(row.join(""));
        });

        $('#tbUsers').DataTable({
            language: {
                lengthMenu: "Mostrando _MENU_ registros por página",
                zeroRecords: "Nenhum registro encontrado",
                info: "Mostrando página _PAGE_ de _PAGES_",
                infoEmpty: "Nenhum registro encontrado",
                infoFiltered: "(filtrado de _MAX_ registros no total)",
                search: "Pesquisar",
                paginate: {
                    next: "Proximo",
                    previous: "Anterior",
                    first: "Primeiro",
                    last: "Último"
                },
            } 
        });
    }

    init();
})();
(function() {
    function init() {
        events();
        search();
    }

    function events() {
        $(document).on('click', '#btnSearchAnexos', search);
    }

    function search() {
        let url = $('#searchAnexos').val();

        $.ajax({
            type: 'POST',
            url: url,
            data: $('#formAnexos').serializeArray(),
            success: function (result) {
                if ($.fn.dataTable.isDataTable('#tbAnexos')) {
                    var table = $('#tbAnexos').DataTable();
                    table.destroy();
                }

                showResults(JSON.parse(result));
            }
        });
    }

    function showResults(result) {
        $('#tbAnexos tbody>tr').remove();    

        $.each(result, function (key, value) {
            let show = `/anexos/show/${value.id_anexo}`;
            let destroy = `/anexos/destroy/${value.id_anexo}`;
            let edit = `/anexos/edit/${value.id_anexo}`;

            let actions = `
            <a href="${show}" class="btn btn-primary btn-sm" title="Visualizar usuário"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a href="${edit}" class="btn btn-info btn-sm" title="Editar usuário"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href="${destroy}" class="btn btn-danger btn-sm" title="Apagar anexo"><i class="fa fa-trash" aria-hidden="true"></i></a>
            `;
            let row = [`<tr>`];
            row.push(`<td class='text-center'>${value.id_anexo}</td>`);
            row.push(`<td class='text-center'>${value.ds_arquivo}</td>`);
            row.push(`<td class='text-center'>${value.usuario.no_usuario}</td>`);
            row.push(`<td class='text-center'>${moment(value.dt_registro).format('DD/MM/YYYY')}</td>`);
            row.push(`<td class='text-center'>${actions}</td>`);
            row.push(`</tr>`);
            $(['#tbAnexos tbody'].join("")).append(row.join(""));
        });

        $('#tbAnexos').DataTable({
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
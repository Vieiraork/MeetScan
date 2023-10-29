(function () {
    function init() {
        events();
        search();
    }

    function events() {
        $(document).on('click', '#btnSearchCodigos', search);
        $(document).on('click', '#', destroy);
    }

    function search() {
        let url = $('#searchCodigos').val();

        $.ajax({
            type: 'POST',
            url: url,
            data: $('#formSearchCodigos').serializeArray(),
            success: function (result) {
                if ($.fn.dataTable.isDataTable('#tbCodigo')) {
                    var table = $('#tbCodigo').DataTable();
                    table.destroy();
                }

                showResults(JSON.parse(result));
            }
        });
    }

    function showResults(result) {
        $('#tbCodigo tbody>tr').remove();

        $.each(result, function (key, value) {
            let show = `/codigos/show/${value.id_codigo_acesso}`;
            let edit = `/codigos/edit/${value.id_codigo_acesso}`;
            let destroy = `/codigos/destroy/${value.id_codigo_acesso}`;

            let actions = `
            <a href="${show}" class="btn btn-primary btn-sm" title="Visualizar código"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a href="${edit}" class="btn btn-info btn-sm" title="Editar código"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <button class="btn btn-danger btn-sm" title="Excluir código" data-href="${destroy}"><i class="fa fa-trash" aria-hidden="true"></i></button>
            `;

            let row = [`<tr>`];
            row.push(`<td class='text-center'>${value.usuario.id_usuarios}</td>`);
            row.push(`<td class='text-center'>${value.ds_codigo_acesso}</td>`);
            row.push(`<td class='text-center'>${moment(value.dt_registro).format('DD/MM/YYYY')}</td>`);
            row.push(`<td class='text-center'>${value.dt_alteracao == null ? '' : moment(value.dt_alteracao).format('DD/MM/YYYY')}</td>`);
            row.push(`<td class='text-center'>${value.usuario.no_usuario}</td>`);
            row.push(`<td class='text-center'>${actions}</td>`);
            row.push(`</tr>`);
            $(['#tbCodigo tbody'].join("")).append(row.join(""));
        });

        $('#tbCodigo').DataTable({
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

    function destroy() {
        let url = $(this).data("href");

        Swal.fire({
            title: '',
            text: '',
            icon: 'warning',
            cancelButtonText: 'Não',
            calcelButtonColor: '#32CD32',
            confirmButtonColor: '#FF4500',
            confirmButtonText: 'Sim'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#destroyCodigo').serializeArray(),
                    success: function (result) {
                        window.location.reload
                    }
                });
            }
        })
    }

    init();
})();
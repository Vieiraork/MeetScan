(function() {
    function init() {
        events();
        search();
    }

    function events() {
        $(document).on('click', '#btnSearchAnexos', search);
        $(document).on('click', '#btnDelete', destroy);
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
            let destroy = $('#destroyAnexos').val();
            let show    = $('#showAnexos').val();
            let edit    = $('#editAnexos').val();
            destroy = destroy.substring(0, destroy.length - 1) + value.id_anexo;
            show    = show.substring(0, show.length - 1) + value.id_anexo;
            edit    = edit.substring(0, edit.length - 1) + value.id_anexo;

            let actions = `
            <button class="btn btn-primary btn-sm" title="Visualizar usuário" onclick="location.href='${show}'"><i class="fa fa-eye" aria-hidden="true"></i></button>
            <button class="btn btn-info btn-sm" title="Editar usuário" onclick="location.href='${edit}'"><i class="fa fa-pencil" aria-hidden="true"></i></button>
            <button class="btn btn-danger btn-sm" title="Apagar anexo" id="btnDelete" data-href="${destroy}"><i class="fa fa-trash" aria-hidden="true"></i></button>
            `;
            let row = [`<tr>`];
            row.push(`<td class='text-center'>${value.id_anexo}</td>`);
            row.push(`<td class='text-center'>${value.ds_arquivo}</td>`);
            row.push(`<td class='text-center'>${moment(value.dt_registro).format('DD/MM/YYYY')}</td>`);
            row.push(`<td class='text-center'>${value.usuario.no_usuario}</td>`);
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

    function destroy(e) {
        e.preventDefault();

        let url = $(this).data('href');

        Swal.fire({
            title: 'Tem certeza que deseja excluir o anexo selecionado?',
            text: '',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Não',
            cancelButtonColor: '#228B22',
            confirmButtonText: 'Sim',
            confirmButtonColor: '#FF0000'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: $('#formDeleteAnexos').serializeArray(),
                    success: (retorno) => {
                        let resposta = typeof retorno == 'string' ? JSON.parse(retorno) : retorno;
    
                        if (resposta.type == 'success') {
                            window.location.reload();
                            Swal.fire({
                                title: 'Sucesso',
                                text: resposta.msg,
                                icon: 'success'
                            });
                        } else {
                            Swal.fire({
                                title: 'Erro',
                                text: resposta.msg,
                                icon: 'error'
                            });
                        }
                    }
                });
            }
        });
    }

    init();
})();
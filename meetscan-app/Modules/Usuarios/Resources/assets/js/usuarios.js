(function(){
    function init() {
        events();
        search();
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
        });
    }

    function showResults(result) {
        $('#tbUsers tbody>tr').remove();    

        $.each(result, function (key, value) {
            let show = `/usuarios/show/${value.id_usuarios}`;
            let changeStatus = `/usuarios/change/${value.id_usuarios}`;
            let edit = `/usuarios/edit/${value.id_usuarios}`;
            let btnIcon  = value.st_status == 'A' ? 'ban' : 'check';
            let btnClass = value.st_status == 'A' ? 'danger' : 'success';
            let btnText  = value.st_status == 'A' ? 'Inativar' : 'Ativar';

            let actions = `
            <a href="${show}" class="btn btn-primary btn-sm" title="Visualizar usuário"><i class="fa fa-eye" aria-hidden="true"></i></a>
            <a href="${edit}" class="btn btn-info btn-sm" title="Editar usuário"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            <a href="${changeStatus}" class="btn btn-${btnClass} btn-sm" title="${btnText} usuário"><i class="fa fa-${btnIcon}" aria-hidden="true"></i></a>
            `;
            let row = [`<tr>`];
            row.push(`<td class='text-center'>${value.id_usuarios}</td>`);
            row.push(`<td class='text-center'>${value.no_usuario}</td>`);
            row.push(`<td class='text-center'>${value.ds_email}</td>`);
            row.push(`<td class='text-center'>${value.perfil.ds_perfil}</td>`);
            row.push(`<td class='text-center'>${moment(value.dt_registro).format('DD/MM/YYYY')}</td>`);
            row.push(`<td class='text-center'>${value.st_status == 'A' ? 'Ativo' : 'Inativo'}</td>`)
            row.push(`<td class='text-center'>${actions}</td>`);
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
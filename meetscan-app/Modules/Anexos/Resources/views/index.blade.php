@extends('layout.main')

@section('title')
    
@endsection

@section('script')
    <script type="text/javascript" src="{{ Module::asset('anexos:js/anexo.js') }}"></script>
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form id="formAnexos">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="no_arquivo">Nome do arquivo</label>
                            <input type="text" name="no_arquivo" id="no_arquivo" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="dt_inicio">Data início</label>
                            <input type="date" name="dt_inicio" id="dt_inicio" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="dt_fim">Data fim</label>
                            <input type="date" name="dt_fim" id="dt_fim" class="form-control">
                        </div>
                    </div>
                </form>
                <input type="hidden" name="searchAnexos" id="searchAnexos" value="{{ route('anexos.search') }}">
                <input type="hidden" name="showAnexos" id="showAnexos" value="{{ route('anexos.show', 0) }}">
                <input type="hidden" name="editAnexos" id="editAnexos" value="{{ route('anexos.edit', 0) }}">
                <input type="hidden" name="destroyAnexos" id="destroyAnexos" value="{{ route('anexos.destroy', 0) }}">
                <div class="row float-right">
                    <div class="col-md-12">
                        <a href="{{ route('anexos.create') }}" class="btn btn-success" title="Cadastrar novo usuário">Novo Anexo</a>
                        <button id="btnSearchAnexos" title="Pesquisar anexos" class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Resultado</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm" id="tbAnexos">
                    <thead class="bg-primary">
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Descrição</th>
                        <th scope="col" class="text-center">Data registro</th>
                        <th scope="col" class="text-center">Usuario</th>
                        <th scope="col" class="text-center">Ações</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
    <form id="formDeleteAnexos">
        @csrf
    </form>
@endsection
@extends('layout.main')

@section('title')
    
@endsection

@section('script')
    <script type="text/javascript" src="{{ Module::asset('codigos:js/codigo.js') }}"></script>
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Pesquisar codigo</h3>
            </div>
            <div class="card-body">
                <form id="formSearchCodigos">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="ds_codigo">Código</label>
                            <input type="text" name="ds_codigo" id="ds_codigo" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="no_usuario">Usuario</label>
                            <input type="text" name="no_usuario" id="no_usuario" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="dt_inicio">Data inicio</label>
                            <input type="date" name="dt_inicio" id="dt_inicio" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="dt_fim">Data fim</label>
                            <input type="date" name="dt_fim" id="dt_fim" class="form-control">
                        </div>
                    </div>
                </form>
                <div class="carregar"></div>
                <input type="hidden" name="searchCodigos" id="searchCodigos" 
                value="{{ route('codigos.search') }}">
                <input type="hidden" name="showCodigo" value="{{ route('codigos.show', 0) }}" id="showCodigo">
                <input type="hidden" name="editCodigo" value="{{ route('codigos.edit', 0) }}" id="editCodigo">
                <input type="hidden" name="destroyCodigo" value="{{ route('codigos.destroy', 0) }}" id="destroyCodigo">
                <div class="row float-right">
                    <div class="col-md-12">
                        <a href="{{ route('codigos.create') }}" class="btn btn-success" 
                        title="Cadastrar novo código">Novo Código</a>
                        <button id="btnSearchCodigos" title="Pesquisar códigos"
                        class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Resultado da pesquisa</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm" id="tbCodigo">
                    <thead class="bg-primary">
                        <th scope="col" class='text-center'>#</th>
                        <th scope="col" class='text-center'>Código</th>
                        <th scope="col" class='text-center'>Data Registro</th>
                        <th scope="col" class='text-center'>Data Alteração</th>
                        <th scope="col" class='text-center'>Usuário</th>
                        <th scope="col" class='text-center'>Ação</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
    <form id="formDestroyCodigo">
        @csrf
    </form>
@endsection
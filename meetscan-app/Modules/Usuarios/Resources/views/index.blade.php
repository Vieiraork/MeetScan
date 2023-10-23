@extends('layout.main')

@section('title')
    Usuários
@endsection

@section('styles')
    <style>
        .tableContent {
            margin: 1rem;
        }
    </style>
@endsection

@section('script')
    <script type="text/javascript" src="{{ Module::asset('usuarios:js/usuarios.js') }}"></script>
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Pesquisa de usuários</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST" id="formSearchUsers">
                    @csrf
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="no_usuario">Nome</label>
                            <input type="text" name="no_usuario" id="no_usuario" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="ds_email">E-mail</label>
                            <input type="text" name="ds_email" id="ds_email" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="cd_perfil">Perfil</label>
                            <select name="cd_perfil" id="cd_perfil" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($perfis as $perfil)
                                    <option value="{{ $perfil->cd_perfil }}">{{ $perfil->ds_perfil }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="st_status">Status</label>
                            <select name="st_status" id="st_status" class="form-control">
                                <option value="">Selecione</option>
                                <option value="A">Ativo</option>
                                <option value="I">Inativo</option>
                            </select>
                        </div>
                    </div>
                </form>
                <input type="hidden" name="searchUsers" id="searchUsers" value="{{ route('usuarios.search') }}">

                <div class="row float-right">
                    <div class="col-md-12">
                        <a href="{{ route('usuarios.create') }}" class="btn btn-success" title="Cadastrar novo usuário">Novo Usuário</a>
                        <button id="btnSearchUser" data-href="{{ route('usuarios.search') }}" title="Pesquisar usuários"
                        class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-primary table-responsive">
            <div class="card-header">
                <h3 class="card-title">Resultado da pesquisa</h3>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm" id="tbUsers">
                    <thead class="bg-primary">
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Nome</th>
                        <th scope="col" class="text-center">E-mail</th>
                        <th scope="col" class="text-center">Perfil</th>
                        <th scope="col" class="text-center">Data Cadastro</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Ações</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

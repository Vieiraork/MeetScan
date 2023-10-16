@extends('layout.main')

@section('title')
    
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item bg-primary"><strong>Usuário</strong></li>
                    <li class="list-group-item">Nome: <strong>{{ $usuario->no_usuario }}</strong></li>
                    <li class="list-group-item">Perfil: <strong>{{ $usuario->perfil->ds_perfil }}</strong></li>
                    <li class="list-group-item">Status: <strong>{{ $usuario->st_status == 'A' ? 'Ativo' : 'Inativo' }}</strong></li>
                    <li class="list-group-item">Data de cadastro: {{ is_null($usuario->dt_registro) ? '' : date('d/m/Y H:i:s', strtotime($usuario->dt_registro)) }}</li>
                    <li class="list-group-item">Data alteração: {{ is_null($usuario->dt_alteracao) ? '' : date('d/m/Y H:i:s', strtotime($usuario->dt_alteracao)) }}</li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group float-right">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
@endsection
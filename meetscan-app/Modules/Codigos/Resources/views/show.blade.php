@extends('layout.main')

@section('title')
    Visualizar Código
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item bg-primary"><strong>Código</strong></li>
                    <li class="list-group-item">Código: <strong>{{ $codigo->ds_codigo_acesso }}</strong></li>
                    <li class="list-group-item">Usuário: <strong>{{ $codigo->usuario->no_usuario }}</strong></li>
                    <li class="list-group-item">Data de cadastro: {{ is_null($codigo->dt_registro) ? '' : date('d/m/Y H:i:s', strtotime($codigo->dt_registro)) }}</li>
                    <li class="list-group-item">Data alteração: {{ is_null($codigo->dt_alteracao) ? '' : date('d/m/Y H:i:s', strtotime($codigo->dt_alteracao)) }}</li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group float-right">
                            <a href="{{ route('codigos.index') }}" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>   
@endsection
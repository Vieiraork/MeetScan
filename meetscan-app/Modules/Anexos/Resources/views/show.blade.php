@extends('layout.main')

@section('title')
    
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Visualizar Informações Anexo</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item bg-primary">Anexo</li>
                    <li class="list-group-item">
                        <span><strong>Imagem: </strong></span><img src="{{ $image }}" alt="Imagem" class="img-thumbnail" style="width: 500px; heigth: 500px;">
                    </li>
                    <li class="list-group-item">
                        <span><strong>Data Cadastro: </strong></span>{{ date('d/m/Y H:i:s', strtotime($anexo->dt_registro)) }}
                    </li>
                    <li class="list-group-item">
                        <span><strong>Usuário Associado: </strong></span>{{ $anexo->usuario->no_usuario }}
                    </li>
                </ul>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group float-right">
                            <a href="{{ route('anexos.index') }}" class="btn btn-default">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
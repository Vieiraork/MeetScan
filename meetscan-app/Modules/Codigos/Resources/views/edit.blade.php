@extends('layout.main')

@section('title')
    Editar Código
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Cadastrar código</h3>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h6 class="alert-heading">Corriga os seguintes erros!</h6>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('codigos.update', $codigo->id_codigo_acesso) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="ds_codigo_acesso">Código <span class="text-danger">*</span></label>
                            <input type="text" name="ds_codigo_acesso" id="ds_codigo_acesso" class="form-control" 
                            value="{{ is_null($codigo->ds_codigo_acesso) ? old('ds_codigo_acesso') : $codigo->ds_codigo_acesso }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="id_usuario">Usuário <span class="text-danger">*</span></label>
                            <select name="id_usuario" id="id_usuario" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($usuarios as $key => $value)
                                    <option value="{{ $value }}" {{ $codigo->id_usuario == $value ? 'selected' : '' }}>{{ $key }}</option>                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row float-right">
                        <div class="col-md-12">
                            <a href="{{ route('codigos.index') }}" class="btn btn-default" 
                            title="Voltar para a listagem de códigos">Voltar</a>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@extends('layout.main')

@section('title')
    Cadastro de códigos
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"></h3>
            </div>
            <div class="card-body">
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="ds_codigo_acesso">Código</label>
                            <input type="text" name="ds_codigo_acesso" id="ds_codigo_acesso" class="form-control">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="id_usuario">Usuário</label>
                            <select name="id_usuario" id="id_usuario" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($usuarios as $key => $value)
                                    <option value="{{ $value }}">{{ $key }}</option>                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row float-right">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-success" title="Cadastrar novo usuário">Novo Usuário</a>
                            <button id="btnSearchUser" data-href="{{ route('usuarios.search') }}" title="Pesquisar usuários"
                            class="btn btn-primary">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
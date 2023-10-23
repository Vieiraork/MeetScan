@extends('layout.main')

@section('title')
    Cadastro de moradores
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Cadastrar usuário</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="no_usuario">Nome</label>
                            <input type="text" name="no_usuario" id="no_usuario" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="ds_email">E-mail</label>
                            <input type="text" name="ds_email" id="ds_email" class="form-control">
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="ds_senha">Senha</label>
                            <input type="password" name="ds_senha" id="ds_senha" class="form-control">
                        </div>
                    </div>
                    <div class="row float-right">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success" title="Cadastrar novo usuário">
                                Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
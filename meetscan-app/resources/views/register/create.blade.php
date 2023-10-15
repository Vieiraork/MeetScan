@extends('layout.mainlogin')

@section('title')
    Administrador
@endsection

@section('content')
    <section class="content-header">
        <div class="container">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h5>Registrar Administrador</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @if ($errors->any())
                            <div class = "alert alert-danger" role = "alert">
                                Por favor corrija os seguintes erros
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="no_usuario">Nome</label>
                                <input type="text" name="no_usuario" id="no_usuario" class="form-control" value="{{ old('no_usuario') }}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="ds_email">E-mail</label>
                                <input type="email" name="ds_email" id="ds_email" class="form-control" value="{{ old('ds_email') }}">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="ds_senha">Senha</label>
                                <input type="password" name="ds_senha" id="ds_senha" class="form-control" value="{{ old('ds_senha') }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-success" title="Permite o registro de administrador">Registrar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
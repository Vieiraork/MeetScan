@extends('layout.mainlogin')

@section('title')
    Login
@endsection

@section('content')
    <section class="content-header">
        <div class="container">
            <div class="card card-outline card-primary">
                <div class="card-body">
                    <form action="{{ route('login-post') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class = "alert alert-danger" role = "alert">
                                Por favor corrija os seguintes erros
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="ds_email">E-mail <span style='color:#FF1A1A'>*</span></label>
                            <input type="text" name="ds_email" id="ds_email" class="form-control" value="{{ old('ds_email') }}">
                            @if($errors->has('ds_email'))
                                <span class = "help-block">{{ $errors->first('ds_email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="ds_senha">Senha <span style='color:#FF1A1A'>*</span></label>
                            <input type="password" name="ds_senha" id="ds_senha" class="form-control" value="{{ old('ds_senha') }}">
                            @if($errors->has('ds_senha'))
                                <span class = "help-block">{{ $errors->first('ds_senha') }}</span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group float-right">
                                    <button type="submit" class="btn btn-success" title="Permite ao usuário acessar o sistema">Logar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@extends('layout.main')

@section('title')
    
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">Cadastro de arquivo</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('anexos.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-7 form-group">
                            <label for="ds_arquivo">Descrição do arquivo</label>
                            <input type="text" name="ds_arquivo" id="ds_arquivo" class="form-control">
                        </div>
                        <div class="col-md-2 form-group">
                            <label for="id_usuario">Usuário</label>
                            <select name="id_usuario" id="id_usuario" class="form-control">
                                <option value="">Selecione</option>
                                @foreach ($usuarios as $key => $value)
                                    <option value="{{ $value }}">{{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="vl_arquivo">Arquivo</label>
                            <input type="file" name="vl_arquivo" id="vl_arquivo" class="form-control">
                        </div>
                    </div>

                    <div class="row float-right">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
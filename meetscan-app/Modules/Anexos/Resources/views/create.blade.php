@extends('layout.main')

@section('title')
    
@endsection

@section('script')
    
@endsection

@section('content')
    <section class="content">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="ds_arquivo"></label>
                            <input type="text" name="ds_arquivo" id="ds_arquivo" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
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
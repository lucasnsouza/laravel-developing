@extends('layout')

@section('titulo')
    Adicionar filme
@endsection

@section('cabecalho')
    Novo filme
@endsection

@section('conteudo')

@include('erros', ['errors' => $errors])

        <form method="post">
            @csrf
            <div class="row">
                <div class="col col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control mb-2" name="nome">
                </div>

                <div class="col col-md-2">
                    <label for="qtd_temporadas" class="form-label">Temporadas</label>
                    <input type="number" class="form-control mb-2" name="qtd_temporadas">
                </div>

                <div class="col col-md-2">
                    <label for="qtd_episodios" class="form-label">Episódios</label>
                    <input type="number" class="form-control mb-2" name="qtd_episodios">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>
@endsection
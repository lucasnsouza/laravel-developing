@extends('layout')

@section('titulo')
    Temporadas 
@endsection

@section('cabecalho')
    Temporadas de <?=$nomeDaSerie?>
@endsection

@section('conteudo')
        <ul class="list-group">
            <?php foreach($numeroDeTemporadas as $temporada): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="/temporada/{{$temporada->id}}/episodios" class="link-primary">
                        Temporada <?= $temporada->numero_temporada;?>
                    </a>
                    <span class="badge bg-secondary">
                        {{$temporada->getEpisodiosAssistidos()->count()}} / {{ $temporada->episodios->count() }}
                    </span>
                </li>
            <?php endforeach ?>
        </ul>                
@endsection
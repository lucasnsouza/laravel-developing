@extends('layout')

@section('titulo')
    Temporadas 
@endsection

@section('cabecalho')
    Temporadas de <?=$nomeDaSerie?>
@endsection

@section('conteudo')

        @if($serie->capa)
            <div class="row mb-4">
                <div class="col-md-12 text-center">
                    <a href="{{$serie->capa_url}}" target="_blank">
                    <img src="{{$serie->capa_url}}" class="img-thumbnail" height="400px" width="400px" alt="capa">
                    </a>
                </div>
            </div>
        @endif

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
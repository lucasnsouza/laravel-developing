@extends('layout')

@section('titulo')
    Temporadas 
@endsection

@section('cabecalho')
    Episodios
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])

    <form method="POST" action="/temporada/{{$temporadaId}}/episodios/assistir">
    @csrf    
    <ul class="list-group">
            <?php foreach($episodios as $episodio): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episódio <?= $episodio->numero_episodio;?>
                    <input  type="checkbox" 
                            name="episodios[]" 
                            value="{{$episodio->id}}"
                            {{ $episodio->assistido ? 'checked' : '' }}>
                </li>
            <?php endforeach ?>
        </ul>           
        <button class="btn btn-primary m-2">Salvar</button>   
    </form>      
@endsection

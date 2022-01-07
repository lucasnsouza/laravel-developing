@extends('layout')

@section('titulo')
    Minhas séries
@endsection

@section('cabecalho')
    Séries
@endsection

@section('conteudo')

@include('mensagem', ['mensagem' => $mensagem])
    @auth
    <a class="btn btn-dark mb-2" href="<?= route('form_nova_serie'); ?>">Adicionar série</a>
    @endauth
        <ul class="list-group mb-3">
            <?php foreach($series as $serie): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">

                <div>
                    <img src="{{$serie->capa_url}}" class="img-thumbnail" height="100px" width="100px" alt="capa">
                    <span id="nome-serie-<?= $serie->id ?>"><?= $serie->nome ?></span>
                </div>

                @auth
                <div class="input-group w-50" hidden id="input-nome-serie-<?= $serie->id ?>">
                    <input type="text" class="form-control" value="<?= $serie->nome ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" onclick="editarSerie(<?= $serie->id ?>)">
                            <i class="fas fa-check"></i>
                        </button>
                        @csrf
                    </div>
                </div>
                

                <span class="d-flex">
                <button class="btn btn-info btn-sm me-1" onclick="toggleInput(<?= $serie->id ?>)">
                    <i class="fas fa-edit"></i>
                </button>
                @endauth

                    <a href="/series/<?=$serie->id;?>/temporadas" class="btn btn-info btn-sm me-1">
                        <i class="fas fa-external-link-alt"></i>
                    </a>

                    @auth
                    <form method="post" action="/series/remover/<?= $serie->id; ?>"
                    onsubmit="return confirm('Tem certeza que deseja remover a série <?=addslashes($serie->nome);?>?')">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                    @endauth
                </span>
                </li>
            <?php endforeach ?>
        </ul>
        <div class="d-flex justify-content-center mb-4">
            {{$series->links()}}
        </div>
<script>
    //input para edição está como hidden
    //essa função permite alterar o estado do input
    function toggleInput(serieId) {

        const nomeDoElemento = document.getElementById(`nome-serie-${serieId}`);
        //pegamos a div em que o input está pelo id da div
        const inputEdicaoDeNome = document.getElementById(`input-nome-serie-${serieId}`);

        //se o nome da série estiver oculto e o input sendo exibido
        //toggle some com a div do input e exibe o nome
        if(nomeDoElemento.hasAttribute('hidden')) {
            nomeDoElemento.removeAttribute('hidden');
            inputEdicaoDeNome.hidden = true;
        } else {
        //queremos exibir o input
        inputEdicaoDeNome.removeAttribute('hidden');
        //queremos esconder o nome da série
        nomeDoElemento.hidden = true;
        }
    }

    function editarSerie(serieId) {
        let formData = new FormData();

        //pegar o input através do id da div
        //o input é filho da div, div>input 
        const nomeNoInput = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
        const tokenLaravel = document.querySelector('input[name="_token"]').value;
        //criamos dados de formulário para o post http
        formData.append('nomeNovo', nomeNoInput);
        formData.append('_token', tokenLaravel);
        
        //enviar para uma rota
        const url = `/series/${serieId}/editaNome`;
        //fazer uma requisição
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nomeNoInput;
        });
    }
</script>        
@endsection
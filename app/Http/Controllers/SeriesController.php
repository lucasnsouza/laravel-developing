<?php

namespace App\Http\Controllers;

use App\Events\NovaSerie as EventsNovaSerie;
use App\Serie;
use App\Http\Requests\SeriesFormRequest;
use App\Mail\NovaSerie;
use App\Models\Episodio;
use App\Models\Temporada;
use App\Models\User;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller 
{
    //método para listar os Series
    public function index(Request $request) 
    {
        //método all do eloquent vai trazer todos os dados da classe Serie
        //método query()->orderBy('coluna', 'desc')->get()
        //retorna de maneira ordenada a partir de uma coluna
        $series = Serie::query()
        ->orderBy('nome', 'asc')
        ->simplePaginate(8);

        //pegar mensagem de sessão difinida ao adionar Serie com sucesso
        $mensagem = $request->session()->get('mensagem');
        //remove sessão depois de exibir
        $request->session()->remove('mensagem');
        
        //acessando a pasta resources/views/series/index.php
        //segundo parâmetro informa os dados que a view vai ter acesso
        //no nosso caso a variável $series
        //função php compact cria um array onde a chave e o elemento tem o mesmo nome
        //no nosso caso ['series' => $series]
        //enviamos também os dados da mensagem
        return view('series.index', compact('series', 'mensagem'));
    }

    //método para abrir página de adicionar novos Series
    public function create()
    {
        return view('series.create');
    }

    //método para salvar no banco
    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome, 
            $request->qtd_temporadas, 
            $request->qtd_episodios
        );

        //criando evento
        $eventoNovaSerie = new EventsNovaSerie(
            $request->nome, 
            $request->qtd_temporadas, 
            $request->qtd_episodios
        );
        //disprando evento
        event($eventoNovaSerie);

        //acessar métodos de sessão
        //usar flash para métodos que vão durar apenas uma requisção
        //como nossa mensagem de sucesso
        $request->session()
            ->flash(
            'mensagem', 
            "Série {$serie->id} adicionada com sucesso: {$serie->nome}"
        );

        return redirect()->route('listar_series');
    }

    //método para excluir
    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $serie = $removedorDeSerie->removerSerie($request->id);

        //excluir através do id passado na url
        //vide rota /Series/remover/{id}
        //Serie::destroy($request->id);

        //mensagem de exclusão
        $request->session()
            ->flash(
                'mensagem',
                "Série {$serie} excluída com sucesso."
            );

        return redirect()->route('listar_series');   
    }

    //método para editar nome de série
    //já que o id vem definido como atributo na url
    //podemos passar como parâmetro 
    public function editaNome($id, Request $request)
    {
        //pegar novo nome através do formData criado com JS
        $novoNome = $request->nomeNovo;
        //pegar serie através do id da url
        $serie = Serie::find($id);

        $serie->nome = $novoNome;

        $serie->save();
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use App\Serie;
use Illuminate\Http\Request;

class TemporadasController extends Controller
{
    //método para exibir as temporadas da série
    //pela url recebemos o id da série
    public function index(int $serieId)
    {
        //Instead of returning a collection of models, the find() method return a single model instance
        //no nosso caso estamos retornando uma instancia de Serie e buscando
        //o número de temporadas através do id
        //$temporadas = Serie::find($serieId)->temporadas;
        
        //nós também podemos buscar o número de temporadas diretamente do model Temporada
        //onde a chave estrangeira serie_id é igual a $serieId recebido na url
        //daí ordenamos esse valor pela coluna numero_temporada na tabela
        $numeroDeTemporadas = Temporada::query()->where('serie_id', $serieId)->orderBy('numero_temporada')->get();

        $serie = Serie::find($serieId);
        $nomeDaSerie = $serie->nome;

        return view('temporadas/index', compact('numeroDeTemporadas', 'nomeDaSerie'));
    }
}

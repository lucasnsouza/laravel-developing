<?php

namespace App\Services;

use App\Models\Temporada;
use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeDaSerie,int $qtdTempordas, int $qtdEpisodios): Serie
    {
        //pega os dados passados no input nomeDoSerie
        //$nome = $request->get('nomeDaSerie');
        /*$serie = serie::create([
            'nome' => $nome
        ]);*/
        
        //inicia transação
        DB::beginTransaction();
            //método final
            $serie = Serie::create(['nome' => $nomeDaSerie]);
            $this->criarTemporadas($serie, $qtdTempordas, $qtdEpisodios);
        //envia o código de transação para o banco
        DB::commit();
    
        return $serie;
    }

    private function criarTemporadas(Serie $serie,int $qtdTempordas,int $qtdEpisodios)
    {
        //garantir que o número inserido seja salvo como cada temporada individual
        for ($i=1; $i <= $qtdTempordas ; $i++) { 
            $temporada = $serie->temporadas()->create(['numero_temporada' => $i]);
            $this->criarEpisodios($temporada, $qtdEpisodios);
        }
    }

    private function criarEpisodios(Temporada $temporada,int $qtdEpisodios)
    {
        //garantir que o número de episódios inseirdo seja salvo como episódios individuais
        for ($j=1; $j <= $qtdEpisodios; $j++) { 
            $temporada->episodios()->create(['numero_episodio' => $j]);
        }
    }
}
<?php

namespace App\Services;

use App\Events\SerieApagada;
use App\Models\Episodio;
use App\Models\Temporada;
use App\Serie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string
    {
        $nomeDaSerie = '';
        //garantir que todo o código seja executado
        //se um erro for lançado todo o código completo não é executado
        //ou seja, ou exclui todos os dados ou nenhum
        //usamos DB::transaction()
        DB::transaction(function () use ($serieId, &$nomeDaSerie){
            //buscar serie pelo id que veio da url
            $serie = Serie::find($serieId);
            //depois de encontrar a serie no banco
            //vamos salvar os seus dados em um array
            //e daí criar um novo objeto
            $serieObj = (object) $serie->toArray();
            
            $nomeDaSerie = $serie->nome;
            //chamar método para remover temporadas
            $this->removeTemporadas($serie);
            //por fim excluir a serie
            $serie->delete();

            //criando um evento que será disparado após a remoção da série
            //o evento terá um listener que fará a exclusão da capa no BD
            //vamos usar o serieObj porque ele contém todos os dados da model excluída
            $eventoApagaSerie = new SerieApagada($serieObj);
            //emitindo evento
            //configurar provider associando evento e listener
            event($eventoApagaSerie);
        });    
        return $nomeDaSerie;
    }

    private function removeTemporadas(Serie $serie)
    {
        //daí para essa serie nos vamamos buscar suas temporadas
        $serie->temporadas->each(function (Temporada $temporada) {
            //primeiro chmada método para excluir episódios
            $this->removeEpisodios($temporada);
            //em seguida podemos excluir cada temporada
            $temporada->delete();
        });
    }

    private function removeEpisodios(Temporada $temporada)
    {
        //para cada temporada nós vamos buscar o seus episódios
        $temporada->episodios()->each(function (Episodio $episodio) {
            //daí vamos excluir os episodios da temporada
            $episodio->delete();
        });
    }
}
<?php

namespace App\Listeners;

use App\Events\SerieApagada;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ExcluirCapaSerie implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SerieApagada  $event
     * @return void
     */
    public function handle(SerieApagada $event)
    {
        //podemos acessar a variável série porque ela está declarada no evento SerieApagada
        $serie = $event->serie;
        //depois de excluir a série, vamos excluir o arquivo de capa
        if($serie->capa) {
            Storage::delete($serie->capa);
        }
    }
}

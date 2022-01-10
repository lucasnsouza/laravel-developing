<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class JobExcluirCapaSerie implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $serie;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($serie)
    {
        $this->serie = $serie;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //usamos jobs quando sua ação está diretamente ligada com o método do controller
        //a exclusão da capa é inerente a exclusão de uma série
        //se uma série foi excluída, sua capa também deve ser
        //nesses casos usamos jobs
        $serie = $this->serie;
        //depois de excluir a série, vamos excluir o arquivo de capa
        if($serie->capa) {
            Storage::delete($serie->capa);
        }
    }
}

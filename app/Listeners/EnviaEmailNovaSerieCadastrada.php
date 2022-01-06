<?php

namespace App\Listeners;

use App\Events\NovaSerie;
use App\Mail\NovaSerie as MailNovaSerie;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class EnviaEmailNovaSerieCadastrada
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
     * @param  \App\Events\NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        //pegando todos os usuarios cadastrados
        $users = User::all();

        foreach($users as $indice => $user) {

            $multiplicador = $indice + 1;
            $nome = $event->nome;
            $qtd_temporadas = $event->qtd_temporadas;
            $qtd_episodios = $event->qtd_episodios; 

            //passando infromações do corpo do email
            $email = new MailNovaSerie(
                $nome,
                $qtd_temporadas,
                $qtd_episodios
            );

            //tempo para envio dos emails
            $tempoDeDelay = now()->addSecond($multiplicador * 10);
            //disparo do email pra cada usuário, através de fila 
            Mail::to($user)->later($tempoDeDelay, $email);
            //define um intervalo de tempo para o envio de cada email
            //aqui serão 3s
            //sleep(3);
        }
    }
}

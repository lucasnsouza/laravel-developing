<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NovaSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nome;
    public $qtd_temporadas;
    public $qtd_episodios;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($nome, $qtd_temporadas, $qtd_episodios)
    {
        $this->nome = $nome;
        $this->qtd_temporadas = $qtd_temporadas;
        $this->qtd_episodios = $qtd_episodios;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace Tests\Unit;

use App\Models\Episodio;
use App\Models\Temporada;
use Tests\TestCase;

class TemporadaTest extends TestCase
{
    /**
     * @var Temporada
     */
    private $temporada;

    protected function setUp(): void
    {
        parent::setUp();
        $temporada = new Temporada();

        $episodio1 = new Episodio();
        $episodio1->assistido = true;

        $episodio2 = new Episodio();
        $episodio2->assistido = true;

        $episodio3 = new Episodio();
        $episodio3->assistido = false;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_busca_episodios_assistidos()
    {
        //testando recuperação de episódios assitidos  
        $episodiosAssitidos = $this->temporada->getEpisodiosAssistidos();

        $this->assertCount(2, $episodiosAssitidos);

        //testar se a prorpiedade assistido dos episódios é verdadeira 
        //para todos os episódios marcados como assistidos
        foreach ($episodiosAssitidos as $episodio) {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function test_busca_episodios_inseridos()
    {
        $episodios = $this->temporada->episodios;
        $this->assertCount(3, $episodios);
    }
}

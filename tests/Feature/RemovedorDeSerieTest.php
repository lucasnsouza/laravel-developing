<?php

namespace Tests\Feature;

use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @var Serie
     */
    private $serie;

    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeSerie = new CriadorDeSerie();
        $this->serie = $criadorDeSerie->criarSerie('Serie de Teste', 1, 1);
    }

    public function test_remover_serie()
    {
        //veriifcar primeiro se a série existe na tabela
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);

        $removedorDeSerie = new RemovedorDeSerie();
        $nomeDaSerie = $removedorDeSerie->removerSerie($this->serie->id);

        //método remove série retorna uma string com nome da série removida
        //teste abaixo verifica isso
        $this->assertIsString($nomeDaSerie);

        //verificar se o nome da serie criada é o mesmo salvo
        $this->assertEquals('Serie de Teste', $this->serie->nome);

        //verificar então se a série foi mesmo excluida do banco
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}

<?php

namespace App;

use App\Models\Temporada;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    
    
    //laravel não vai tentar adicionar colunas coom informações 
    //data de criação e update da tabela
    public $timestamps = false;

    //informa quais atributos podemos inserir através do comando Serie::create
    protected $fillable = ['nome', 'capa'];

    //definindo relação entre a model Serie e a model Temporada
    public function temporadas()
    {
        //uma série pode ter muitas temporadas
        return $this->hasMany(Temporada::class);
    }
}
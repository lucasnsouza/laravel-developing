<?php

namespace App\Models;

use App\Serie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['numero_temporada'];

    //definindo relação entre Temporada e Episodio
    public function episodios()
    {
        return $this->hasMany(Episodio::class);
    }

    //vamos definir agora a relação de Temporada com Serie
    //as temporadas pertencem a uma única série
    public function serie()
    {
        //a temporada pertence há uma série
        return $this->belongsTo(Serie::class);
    }

    //método para pegar os episódios salvos como assitidos no banco
    //retorna uma Collection
    public function getEpisodiosAssistidos(): Collection
    {
        return $this->episodios->filter(function (Episodio $episodio) {
            return $episodio->assistido;
        });
    }
}

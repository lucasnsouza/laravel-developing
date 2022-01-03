<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['numero_episodio'];

    //definir a qual temporada o episódio pertence
    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}

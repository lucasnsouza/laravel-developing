<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request)
    {
        $episodios = $temporada->episodios;
        $temporadaId = $temporada->id;

        $mensagem = $request->session()->get('mensagem');

        return view('episodios.index', compact('episodios', 'temporadaId', 'mensagem'));
    }

    public function assistir(Temporada $temporada, Request $request)
    {   
        if ($request->episodios == null) {
            $episodiosAssitidos = array();
        } else {
        //pega os episodios marcados como assitidos
        //aqui episodios é o input name
        $episodiosAssitidos = $request->episodios;
        }

        //daí usando o método each do laravel
        //vamo verificar quais ids de episodios estão no array de $episodiosAssitidos
        $temporada->episodios->each(function (Episodio $episodio) use ($episodiosAssitidos) {
            $episodio->assistido = in_array(
                $episodio->id, 
                $episodiosAssitidos
            );
        });

        //como todas as modificações afetam uma temporada e suas tabelas relacionais
        //podemos usar o seguinte método
        $temporada->push();

        $request->session()->flash('mensagem', 'Episódios marcados como assitidos.');

        //redireciona para página anterior, a lista de episodios
        return redirect()->back();
    }
}

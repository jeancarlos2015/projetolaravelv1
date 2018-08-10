<?php

namespace App\Http\Repositorys;


use App\Http\Models\Projeto;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProjetoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Projeto::class);
    }

    public static function listar()
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {
            $result =  Projeto::all();
            return $result;
        } else if (!empty(Auth::user()->repositorio)) {
            $organizacao = Auth::user()->repositorio;
            return Projeto::whereCodorganizacao($organizacao->codrepositorio)
                ->where('visibilidade', 'true')
                ->get();
        }
        return collect(array());

    }

    public static function listar_por_organizacao($codrepositorio)
    {
        if (Auth::user()->email === 'jeancarlospenas25@gmail.com') {
            return Projeto::whereCodorganizacao($codrepositorio)
                ->get();
        }
        return Projeto::whereCodorganizacao($codrepositorio)
            ->orwhere('visibilidade', 'true')
            ->get();
    }

    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $codprojeto)
    {
        $value = Projeto::findOrFail($codprojeto);
        $value->update($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_projetos');
    }

    public static function incluir(Request $request)
    {
        $value = Projeto::create($request->all());
        self::limpar_cache();
        return $value;
    }

    public static function excluir($codprojeto)
    {
        $value = null;
        try {
            $doc = Projeto::findOrFail($codprojeto);
            $value = $doc->delete();
            self::limpar_cache();
        } catch (Exception $e) {

        }
        return $value;
    }

    public static function projeto_existe($nome_do_projeto)
    {
        $projetos = self::listar();
        return $projetos->where('nome', $nome_do_projeto)->count() > 0;
    }
}

<?php

namespace App\Http\Repositorys;


use App\Http\Models\Documentacao;
use App\Http\Models\Repositorio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DocumentacaoRepository extends Repository
{

    public function __construct()
    {
        $this->setModel(Repositorio::class);
    }

    public static function listar()
    {
        return Cache::remember('listar_documentacao', 2000, function () {
            return Documentacao::all();
        });
    }


    public static function count()
    {
        return collect(self::listar())->count();
    }

    public static function atualizar(Request $request, $coddocumentacao)
    {
        $repositorio = Documentacao::findOrFail($coddocumentacao);
        $repositorio->update($request->all());
        return $repositorio;
    }

    public static function limpar_cache()
    {
        Cache::forget('listar_documentacao');
    }

    public static function incluir(Request $request)
    {

        $documentacao = Documentacao::create($request->all());
        self::limpar_cache();
        return $documentacao;
    }

    public static function excluir($coddocumentacao)
    {
        $doc = Documentacao::findOrFail($coddocumentacao);
        $value = $doc->delete();
        self::limpar_cache();
        return $value;
    }

    public static function excluir_todos()
    {
        $documentacoes = Documentacao::all();
        foreach ($documentacoes as $documentacao) {
            $documentacao->delete();
        }
        self::limpar_cache();
    }

}

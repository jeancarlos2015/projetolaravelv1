<?php

namespace App\Http\Controllers;

use App\Http\Models\Modelo;
use App\Http\Models\Organizacao;
use App\Http\Models\Projeto;
use App\Http\Models\Regra;
use App\Http\Models\Tarefa;
use App\Http\Repositorys\RegraRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegraController extends Controller
{
    public function index($organizacao_id, $projeto_id, $modelo_id)
    {
        $regras = RegraRepository::listar_regras_por_modelo($organizacao_id, $projeto_id, $modelo_id);
        $titulos = Regra::titulos();
        $organizacao = Organizacao::findOrFail($organizacao_id);
        $projeto = Projeto::findOrFail($projeto_id);
        $modelo = Modelo::findOrFail($modelo_id);
        $tipo = 'regra';
        return view('controle_regras.index', compact('titulos', 'organizacao', 'projeto', 'modelo', 'regras', 'tipo'));
    }

    public function todas_regras()
    {
        $regras = RegraRepository::listar();
        $titulos = Regra::titulos();
        return view('controle_regras.all', compact('regras', 'titulos'));
    }

    public function create($organizacao_id, $projeto_id, $modelo_id)
    {
        $dados = Regra::dados();
        $organizacao = Organizacao::findOrFail($organizacao_id);
        $projeto = Projeto::findOrFail($projeto_id);
        $modelo = Modelo::findOrFail($modelo_id);
        $tarefas = Tarefa::all();
        return view('controle_regras.create', compact('dados', 'organizacao', 'projeto', 'modelo', 'tarefas'));
    }


    public function store(Request $request)
    {
        $projeto = Projeto::findOrFail($request->projeto_id);
        $organizacao = Organizacao::findOrFail($request->organizacao_id);
        $modelo = Modelo::findOrFail($request->modelo_id);
        if (empty($request->regra_id)) {
            $request->request->add([
                'regra_id' => 0,
                'user_id' => Auth::user()->id
            ]);
        }
        $regra = Regra::create($request->all());
        if (isset($regra)) {
            flash('Regra Criada com sucesso!!!');
        } else {
            flash('Regra Não Foi Criada com sucesso!!!');
        }
        return redirect()->route('controle_regras_index', [
            'organizacao_id' => $organizacao->id,
            'projeto_id' => $projeto->id,
            'modelo_id' => $modelo->id
        ]);
    }


    public function show($id)
    {
        $tarefa = Tarefa::findOrFail($id);
        return view('controle_tarefas.show', compact('tarefa'));
    }



//'Tarefa 1',
//'Operador',
//'Tarefa 2',
//'Nome da Regra'

    public function edit($id)
    {
        $regra = Regra::findOrFail($id);
        $dados = Regra::dados();
        $dados[0]->valor = $regra->tarefa1->id;
        $dados[1]->valor = $regra->operador;
        $dados[2]->valor = $regra->tarefa2->id;
        $dados[3]->valor = $regra->nome;
        $organizacao = $regra->organizacao;
        $projeto = $regra->projeto;
        $modelo = $regra->modelo;
        $tarefas = [];
        array_push($tarefas, $regra->tarefa1);
        array_push($tarefas, $regra->tarefa2);
        return view('controle_regras.edit', compact('dados', 'regra', 'organizacao', 'projeto', 'modelo', 'tarefas'));
    }


    public function update(Request $request, $id)
    {
        $regra = Regra::findOrFail($id);
        $regra->update($request->all());
        if (isset($tarefa)) {
            flash('Regra atualizada com sucesso!!');
        } else {
            flash('Regra não foi atualizada!!');
        }
        return redirect()->route('controle_regras_index', [
            'organizacao_id' => $regra->organizacao_id,
            'projeto_id' => $regra->projeto_id,
            'modelo_id' => $regra->modelo_id
        ]);
    }


    public function destroy($id)
    {
        $regra = Regra::findOrFail($id);
        $projeto = $regra->projeto;
        $organizacao = $regra->organizacao;
        $modelo = $regra->modelo;
        try {
            $regra->delete();
            if (!$regra->exists) {
                flash('Regra excluída com sucesso!!');
            } else {
                flash('Regra não foi excluída!!')->warning();
            }
        } catch (\Exception $e) {
            flash('Error!!')->error();
        }
        if (!empty($projeto) || !empty($organizacao) && !empty($modelo)) {
            $titulos = Regra::titulos();
            $regras = Regra::join('users', 'users.id', '=', 'regras.user_id')->get();
            return view('controle_regras.all', compact('titulos', 'regras'));
        } else {
            return redirect()->route('controle_regras_index', [
                'organizacao_id' => $organizacao->id,
                'projeto_id' => $projeto->id,
                'modelo_id' => $modelo->id
            ]);
        }

    }
}

@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'sub_titulo' =>
                   'Repositório/'.$repositorio->nome.
                   'Projeto/'.$projeto->nome.
                   'ModeloDiagramatico'.$modelo->nome.
                   'ModeloDiagramatico',
                   'rota' => 'controle_repositorios.index'
    ])

    <form action="{!! route('controle_modelos_diagramaticos.update',['id' => $modelo->codmodelodiagramatico]) !!}" method="post">
        {{ method_field('PUT')}}
        @includeIf('controle_modelos_diagramaticos.form',
        [
        'acao' => 'Atualizar e Proseguir',
        'dados' => $dados,
        'MAX' => 2,
        'organizacao_id' => $repositorio->codrepositorio,
        'projeto_id' => $projeto->codprojeto
        ]
        )

    </form>


@endsection

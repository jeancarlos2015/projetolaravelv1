@extends('layouts.layout_admin_new.layouts.main')

@section('content')
    {!! csrf_field() !!}
    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                   'titulo' => 'Painel',
                   'rota' => 'painel',
                   'sub_titulo' => 'Novo Repositório'
   ])

    <form action="{!! route('controle_repositorios.store') !!}" method="post">
        @method('POST')
        @includeIf('controle_repositorios.form',
        [
        'acao' => 'Salvar e Proseguir',
        'dados' => $dados,
        'MAX' => 2
        ])
    </form>

@endsection

@section('modo')
    @includeIf('componentes.descricao',[
        'descricao_titulo_menu' => 'Controle de Repositórios',
        'nome_titulo_menu' => 'Modo de Criação do Repositório'
    ])
@endsection
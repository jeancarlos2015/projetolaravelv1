<form action="{!! route('controle_atribuicao_projeto_usuarios.store') !!}" method="post">
    @method('POST')
    @csrf
    @includeIf('controle_atribuicao_projeto_usuarios.form',
    [
    'acao' => 'Salvar',
    'dados' => $dados,
    'MAX' => 1,
    'cod_repositorio' => $repositorio->cod_repositorio
    ]
    )


</form>
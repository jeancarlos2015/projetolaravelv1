@extends('layouts.layout_admin_new.layouts.main')

@section('content')

    @includeIf('layouts.layout_admin_new.componentes.breadcrumb',[
                      'titulo' => 'Paianel',
                    'sub_titulo' => 'Configuracao Do Versionamento',
                    'rota' => 'todas_tarefas',
                    'branch_atual' => $branch_atual
    ])
    <form action="{!! route('controle_github.store') !!}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label>Usuário Github</label>
            <input type="text" class="form-control" name="usuario_github" required>
        </div>

        <div class="form-group">
            <label>Email Github</label>
            <input type="text" class="form-control" name="email_github" required>
        </div>

        <div class="form-group">
            <label>Token Github</label>
            <input type="text" class="form-control" name="token_github" required>
        </div>

        <div class="form-group">
            <label>Senha Github</label>
            <input type="password" class="form-control" name="senha_github" required>
        </div>

        <input type="hidden" class="form-control" name="codusuario" value="{!! $codusuario !!}">

        <input type="submit" class="btn btn-dark form-control" value="Salvar">

    </form>
    
@endsection
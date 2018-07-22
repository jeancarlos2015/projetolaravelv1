{!! csrf_field() !!}
@for($indice=0;$indice<$MAX;$indice++)
    <div class="form-group">
        @if(($dados[$indice]->campo!=="Ações") && !isset($dados[$indice]->value))
            <label>{!! $dados[$indice]->campo !!}</label>
            <input name="{!! $dados[$indice]->atributo !!}" class="form-control"
                   placeholder="{!! $dados[$indice]->campo !!}" value="{!! $dados[$indice]->valor !!}" required>
        @endif
    </div>
@endfor
@if(!empty($codorganizacao))
    <input type="hidden" name="codorganizacao" class="form-control"
           value="{!! $codorganizacao !!}">
@endif
<button type="submit" class="btn btn-dark form-control">{!! $acao !!}</button>
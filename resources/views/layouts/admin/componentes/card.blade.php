<div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-dark o-hidden h-100">
        @if($tipo==='modelos')
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                </div>
                @if(!empty($funcionalidades))
                    <div class="mr-5">{!! $funcionalidades[$indice]->titulo !!}</div>
                @else
                    <div class="mr-5">{!! $titulos[$index] !!}</div>
                    <div class="mr-5">Quantidade: {!! $quantidades[$index] !!}</div>
                @endif

            </div>
            @if(!empty($funcionalidades))
                <a class="card-footer text-white clearfix small z-1" href="{!! route($funcionalidades[$indice]->rota,[$modelodeclarativo->cod_modelo_declarativo]) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            @else
                <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas[$index],[$modelodeclarativo->cod_modelo_declarativo]) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            @endif
        @else
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fa fa-fw fa-list"></i>
                </div>
                @if(!empty($funcionalidades))
                    <div class="mr-5">{!! $funcionalidades[$indice]->titulo !!}</div>
                @else
                    <div class="mr-5">{!! $titulos[$index] !!}</div>
                    <div class="mr-5">Quantidade: {!! $quantidades[$index] !!}</div>
                @endif

            </div>
            @if(!empty($funcionalidades))
                <a class="card-footer text-white clearfix small z-1"
                   href="{!! route($funcionalidades[$indice]->rota) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            @else
                <a class="card-footer text-white clearfix small z-1" href="{!! route($rotas[$index]) !!}">
                    <span class="float-left">Visualizar</span>
                    <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                </a>
            @endif
        @endif
    </div>
</div>
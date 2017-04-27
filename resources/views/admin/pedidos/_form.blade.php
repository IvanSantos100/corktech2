{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('tipo', $errors) !!}
{!! Form::label('tipo', 'Tipo', ['class' => 'control-label']) !!}
{!! Form::select('tipo', $opcao, null, ['class' => 'form-control', 'onchange' => 'alteraFormPedido(this.value)']) !!}
{!! Form::error('tipo', $errors) !!}
{!! Html::closeFormGroup() !!}

@if(checkPermission(['nacional']))
{!! Html::openFormGroup('origem_id', $errors) !!}
{!! Form::label('origem_id', 'Origem', ['class' => 'control-label']) !!}
{!! Form::select('origem_id', $origens, null, ['class' => 'form-control']) !!}
{!! Form::error('origem_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('destino_id', $errors) !!}
{!! Form::label('destino_id', 'Destino', ['class' => 'control-label']) !!}
{!! Form::select('destino_id', $destinos, null, ['class' => 'form-control']) !!}
{!! Form::error('destino_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('desconto', $errors) !!}
{!! Form::label('desconto', 'Desconto', ['class' => 'control-label']) !!}
{!! Form::text('desconto', null, ['class' => 'form-control']) !!}
{!! Form::error('desconto', $errors) !!}
{!! Html::closeFormGroup() !!}
@endif

@if(!empty($pedido))
    {!! Html::openFormGroup('cliente_id', $errors) !!}
@else
    {!! Html::openFormGroup('cliente_id', $errors, "display: none") !!}
@endif
{!! Form::label('cliente_id', 'Cliente', ['class' => 'control-label']) !!}
{!! Form::select('cliente_id', $clientes, null, ['class' => 'form-control']) !!}
{!! Form::error('cliente_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('forma_pagamento', $errors) !!}
{!! Form::label('forma_pagamento', 'Forma de pagamento', ['class' => 'control-label']) !!}
{!! Form::text('forma_pagamento', null, ['class' => 'form-control']) !!}
{!! Form::error('forma_pagamento', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('obs', $errors) !!}
{!! Form::label('obs', 'Observação', ['class' => 'control-label']) !!}
{!! Form::text('obs', null, ['class' => 'form-control']) !!}
{!! Form::error('obs', $errors) !!}
{!! Html::closeFormGroup() !!}


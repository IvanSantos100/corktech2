{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Form::hidden('tipo', $tipo) !!}
<br>
@if(checkPermission(['nacional']))
    @if($tipo == 2 || $tipo == 3)
        {!! Html::openFormGroup('origem_id', $errors) !!}
        {!! Form::label('origem_id', 'Origem', ['class' => 'control-label']) !!}
        {!! Form::select('origem_id', $origens, null, ['class' => 'form-control']) !!}
        {!! Form::error('origem_id', $errors) !!}
        {!! Html::closeFormGroup() !!}
    @endif
    @if($tipo == 2 )
        {!! Html::openFormGroup('destino_id', $errors) !!}
        {!! Form::label('destino_id', 'Destino', ['class' => 'control-label']) !!}
        {!! Form::select('destino_id', $destinos, null, ['class' => 'form-control']) !!}
        {!! Form::error('destino_id', $errors) !!}
        {!! Html::closeFormGroup() !!}
    @endif
    {!! Html::openFormGroup('desconto', $errors) !!}
    {!! Form::label('desconto', 'Desconto (%)', ['class' => 'control-label']) !!}
    {!! Form::text('desconto', null, ['class' => 'form-control']) !!}
    {!! Form::error('desconto', $errors) !!}
    {!! Html::closeFormGroup() !!}
@endif

@if($tipo == 3)
    {!! Html::openFormGroup('cliente_id', $errors) !!}
    {!! Form::label('cliente_id', 'Cliente', ['class' => 'control-label']) !!}
    {!! Form::select('cliente_id', $clientes, null, ['class' => 'form-control']) !!}
    {!! Form::error('cliente_id', $errors) !!}
    {!! Html::closeFormGroup() !!}
@endif

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


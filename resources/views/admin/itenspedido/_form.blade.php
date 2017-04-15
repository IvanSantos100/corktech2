{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('pedido_id', $errors) !!}
{!! Form::label('pedido_id', 'Pedido', ['class' => 'control-label']) !!}
{!! Form::select('pedido_id', $estampas, null, ['class' => 'form-control']) !!}
{!! Form::error('pedido_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('preco', $errors) !!}
{!! Form::label('preco', 'Preço', ['class' => 'control-label']) !!}
{!! Form::text('preco', null, ['class' => 'form-control']) !!}
{!! Form::error('preco', $errors) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup('classe_id', $errors) !!}
{!! Form::label('classe_id', 'Classe', ['class' => 'control-label']) !!}
{!! Form::select('classe_id', $classes, null, ['class' => 'form-control']) !!}
{!! Form::error('classe_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('tipoproduto_id', $errors) !!}
{!! Form::label('tipoproduto_id', 'Tipo produto', ['class' => 'control-label']) !!}
{!! Form::select('tipoproduto_id', $tipoprodutos, null, ['class' => 'form-control']) !!}
{!! Form::error('tipoproduto_id', $errors) !!}
{!! Html::closeFormGroup() !!}


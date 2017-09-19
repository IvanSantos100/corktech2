{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('codigo', $errors) !!}
{!! Form::label('codigo', 'Codigo', ['class' => 'control-label']) !!}
{!! Form::text('codigo', null, ['class' => 'form-control']) !!}
{!! Form::error('codigo', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('descricao', $errors) !!}
{!! Form::label('descricao', 'Descricao', ['class' => 'control-label']) !!}
{!! Form::text('descricao', null, ['class' => 'form-control']) !!}
{!! Form::error('descricao', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('tamanho', $errors) !!}
{!! Form::label('tamanho', 'Tamanho', ['class' => 'control-label']) !!}
{!! Form::text('tamanho', null, ['class' => 'form-control']) !!}
{!! Form::error('tamanho', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('preco', $errors) !!}
{!! Form::label('preco', 'Preço', ['class' => 'control-label']) !!}
{!! Form::text('preco', null, ['class' => 'form-control']) !!}
{!! Form::error('preco', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('estampa_id', $errors) !!}
{!! Form::label('estampa_id', 'Estampa', ['class' => 'control-label']) !!}
{!! Form::select('estampa_id', $estampas, null, ['class' => 'form-control']) !!}
{!! Form::error('estampa_id', $errors) !!}
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


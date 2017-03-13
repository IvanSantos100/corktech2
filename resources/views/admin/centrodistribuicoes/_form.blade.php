{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('descricao', $errors) !!}
{!! Form::label('descricao', 'Descricao', ['class' => 'control-label']) !!}
{!! Form::text('descricao', null, ['class' => 'form-control']) !!}
{!! Form::error('descricao', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('tipo', $errors) !!}
{!! Form::label('tipo', 'Tipo', ['class' => 'control-label']) !!}
{!! Form::select('tipo', ['Nacional', 'Distribuidora', 'Revenda'], null, ['class' => 'form-control']) !!}
{!! Form::error('tipo', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('prazo_fabrica', $errors) !!}
{!! Form::label('prazo_fabrica', 'Prazo de fabrica', ['class' => 'control-label']) !!}
{!! Form::text('prazo_fabrica', null, ['class' => 'form-control']) !!}
{!! Form::error('prazo_fabrica', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('prazo_nacional', $errors) !!}
{!! Form::label('prazo_nacional', 'Prazo da nacional', ['class' => 'control-label']) !!}
{!! Form::text('prazo_nacional', null, ['class' => 'form-control']) !!}
{!! Form::error('prazo_nacional', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('prazo_regional', $errors) !!}
{!! Form::label('prazo_regional', 'Prazo da regional', ['class' => 'control-label']) !!}
{!! Form::text('prazo_regional', null, ['class' => 'form-control']) !!}
{!! Form::error('prazo_regional', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('valor_base', $errors) !!}
{!! Form::label('valor_base', 'Valor base', ['class' => 'control-label']) !!}
{!! Form::text('valor_base', null, ['class' => 'form-control']) !!}
{!! Form::error('valor_base', $errors) !!}
{!! Html::closeFormGroup() !!}
{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('descricao', $errors) !!}
{!! Form::label('descricao', 'Descricao', ['class' => 'control-label']) !!}
{!! Form::text('descricao', null, ['class' => 'form-control']) !!}
{!! Form::error('descricao', $errors) !!}
{!! Html::closeFormGroup() !!}

<!--
{!! Html::openFormGroup('descricao', $errors) !!}
{!! Form::label('estampa', 'Estampa', ['class' => 'control-label']) !!}
{!! Form::file('Estampa', null, ['class' => 'form-control']) !!}
{!! Form::error('descricao', $errors) !!}
{!! Html::closeFormGroup() !!}
-->
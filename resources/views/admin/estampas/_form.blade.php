{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('descricao', $errors) !!}
{!! Form::label('descricao', 'Descricao', ['class' => 'control-label']) !!}
{!! Form::text('descricao', null, ['class' => 'form-control']) !!}
{!! Form::error('descricao', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('estampa_file', $errors) !!}
{!! Form::label('estampa_file', 'Estampa', ['class' => 'control-label']) !!}
{!! Form::file('estampa_file', ['class' => 'form-control']) !!}
{!! Form::error('estampa_file', $errors) !!}
{!! Html::closeFormGroup() !!}

@if(file_exists("images/thumbnail/estampa-{$estampa->id}.png"))
{!! Form::label('estampa', 'Estampa', ['class' => 'control-label']) !!}
{{ HTML::image("/images/thumbnail/estampa-{$estampa->id}.png") }}
@endif

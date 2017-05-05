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

@if(!empty($estampa))
{!! Html::openFormGroup() !!}
{!! Form::label('estampa', 'Estampa', ['class' => 'control-label']) !!}
{!! Form::hidden('estampa',null, ['style' => 'witdh:100%']) !!}
{{ HTML::image("/images/thumbnail/Session::get('estampa-26.png')") }}
{!! Form::error('descricao', $errors) !!}
{!! Html::closeFormGroup() !!}
@endif
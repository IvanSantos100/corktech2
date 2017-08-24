{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('descricao', $errors) !!}
{!! Form::label('descricao', 'Descrição', ['class' => 'control-label']) !!}
{!! Form::text('descricao', null, ['class' => 'form-control']) !!}
{!! Form::error('descricao', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('tamanho', $errors) !!}
{!! Form::label('tamanho', 'Tamanho', ['class' => 'control-label']) !!}
{!! Form::text('tamanho', null, ['class' => 'form-control']) !!}
{!! Form::error('tamanho', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('espessura', $errors) !!}
{!! Form::label('espessura', 'Espessura', ['class' => 'control-label']) !!}
{!! Form::text('espessura', null, ['class' => 'form-control']) !!}
{!! Form::error('espessura', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('atacado', $errors) !!}
{!! Form::label('atacado', 'Atacado', ['class' => 'control-label']) !!}
{!! Form::text('atacado', null, ['class' => 'form-control']) !!}
{!! Form::error('atacado', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('varejo', $errors) !!}
{!! Form::label('varejo', 'Varejo', ['class' => 'control-label']) !!}
{!! Form::text('varejo', null, ['class' => 'form-control']) !!}
{!! Form::error('varejo', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('granel', $errors) !!}
{!! Form::label('granel', 'Granel', ['class' => 'control-label']) !!}
{!! Form::text('granel', null, ['class' => 'form-control']) !!}
{!! Form::error('granel', $errors) !!}
{!! Html::closeFormGroup() !!}
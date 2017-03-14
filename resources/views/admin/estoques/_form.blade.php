{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('produto_id', $errors) !!}
{!! Form::label('produto_id', 'Produtos', ['class' => 'control-label']) !!}
{!! Form::select('produto_id', $produtos, null, ['class' => 'form-control']) !!}
{!! Form::error('produto_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('centrodistribuicao_id', $errors) !!}
{!! Form::label('centrodistribuicao_id', 'Centro distribuição', ['class' => 'control-label']) !!}
{!! Form::select('centrodistribuicao_id', $centrodistribuicoes, null, ['class' => 'form-control']) !!}
{!! Form::error('centrodistribuicao_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('lote', $errors) !!}
{!! Form::label('lote', 'Lote', ['class' => 'control-label']) !!}
{!! Form::text('lote', null, ['class' => 'form-control']) !!}
{!! Form::error('lote', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('valor', $errors) !!}
{!! Form::label('valor', 'Valor', ['class' => 'control-label']) !!}
{!! Form::text('valor', null, ['class' => 'form-control']) !!}
{!! Form::error('valor', $errors) !!}
{!! Html::closeFormGroup() !!}


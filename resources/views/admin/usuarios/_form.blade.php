{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('name', $errors) !!}
{!! Form::label('name', 'Nome', ['class' => 'control-label']) !!}
{!! Form::text('name', null, ['class' => 'form-control']) !!}
{!! Form::error('name', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('email', $errors) !!}
{!! Form::label('email', 'E-mail', ['class' => 'control-label']) !!}
{!! Form::email('email', null, ['class' => 'form-control']) !!}
{!! Form::error('email', $errors) !!}
{!! Html::closeFormGroup() !!}

@if(empty($usuario))
{!! Html::openFormGroup('´password', $errors) !!}
{!! Form::label('password', 'Senha', ['class' => 'control-label']) !!}
{!! Form::password('password', ['class' => 'form-control']) !!}
{!! Form::error('password', $errors) !!}
{!! Html::closeFormGroup() !!}
@endif

{!! Html::openFormGroup('centrodistribuicao_id', $errors) !!}
{!! Form::label('centrodistribuicao_id', 'Centro de Distribuição', ['class' => 'control-label']) !!}
{!! Form::select('centrodistribuicao_id', $centroDistribuicoes, null, ['class' => 'form-control']) !!}
{!! Form::error('centrodistribuicao_id', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('endereco', $errors) !!}
{!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
{!! Form::text('endereco', null, ['class' => 'form-control']) !!}
{!! Form::error('endereco', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('bairro', $errors) !!}
{!! Form::label('bairro', 'Bairro', ['class' => 'control-label']) !!}
{!! Form::text('bairro', null, ['class' => 'form-control']) !!}
{!! Form::error('bairro', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('cidade', $errors) !!}
{!! Form::label('cidade', 'Cidade', ['class' => 'control-label']) !!}
{!! Form::text('cidade', null, ['class' => 'form-control']) !!}
{!! Form::error('cidade', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('uf', $errors) !!}
{!! Form::label('uf', 'UF', ['class' => 'control-label']) !!}
{!! Form::text('uf', null, ['class' => 'form-control']) !!}
{!! Form::error('uf', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('cep', $errors) !!}
{!! Form::label('cep', 'CEP', ['class' => 'control-label']) !!}
{!! Form::text('cep', null, ['class' => 'form-control']) !!}
{!! Form::error('cep', $errors) !!}
{!! Html::closeFormGroup() !!}


{!! Html::openFormGroup('fone', $errors) !!}
{!! Form::label('fone', 'Fone', ['class' => 'control-label']) !!}
{!! Form::text('fone', null, ['class' => 'form-control']) !!}
{!! Form::error('fone', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('celular', $errors) !!}
{!! Form::label('celular', 'Celular', ['class' => 'control-label']) !!}
{!! Form::text('celular', null, ['class' => 'form-control']) !!}
{!! Form::error('celular', $errors) !!}
{!! Html::closeFormGroup() !!}



{!! Form::hidden('redirect_to', URL::previous()) !!}

{!! Html::openFormGroup('tipo', $errors) !!}
{!! Form::label('tipo', 'Tipo', ['class' => 'control-label']) !!}
{!! Form::select('tipo', $opcao, null, ['class' => 'form-control']) !!}
{!! Form::error('tipo', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('nome', $errors) !!}
{!! Form::label('nome', 'Nome', ['class' => 'control-label']) !!}
{!! Form::text('nome', null, ['class' => 'form-control']) !!}
{!! Form::error('nome', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('documento', $errors) !!}
{!! Form::label('documento', 'Documento', ['class' => 'control-label']) !!}
{!! Form::text('documento', null, ['class' => 'form-control']) !!}
{!! Form::error('documento', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('endereco', $errors) !!}
{!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
{!! Form::text('endereco', null, ['class' => 'form-control']) !!}
{!! Form::error('endereco', $errors) !!}
{!! Html::closeFormGroup() !!}

{!! Html::openFormGroup('bairro', $errors) !!}
{!! Form::label('bairro', 'Endereço', ['class' => 'control-label']) !!}
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

{!! Html::openFormGroup('responsavel', $errors) !!}
{!! Form::label('responsavel', 'Responsavel', ['class' => 'control-label']) !!}
{!! Form::text('responsavel', null, ['class' => 'form-control']) !!}
{!! Form::error('responsavel', $errors) !!}
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



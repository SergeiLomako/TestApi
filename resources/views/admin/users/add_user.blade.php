@extends('admin.layouts.admin')

@section('content')
    {!! Form::open(['url' => route('add_user'), 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('first_name', 'Имя', ['class' => 'control-label']) !!}
                {!! Form::text('first_name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_name', 'Фамилия', ['class' => 'control-label']) !!}
                {!! Form::text('last_name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'email', ['class' => 'control-label']) !!}
                {!! Form::text('email', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('login', 'Логин', ['class' => 'control-label']) !!}
                {!! Form::text('login', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Пароль', ['class' => 'control-label']) !!}
                {!! Form::text('password', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role', 'Должность', ['class' => 'control-label']) !!}
                {!! Form::select('role', $roles, 0, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city', 'Город', ['class' => 'control-label']) !!}
                {!! Form::text('city', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('address', 'Адрес', ['class' => 'control-label']) !!}
                {!! Form::text('address', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('tel', 'Телефон', ['class' => 'control-label']) !!}
                {!! Form::text('tel', null, ['class'=>'form-control tel_number']) !!}
            </div>
            {!! Form::submit('Добавить') !!}
        </div>
        <div class="col-sm-4"></div>
    </div>
    {!! Form::close() !!}
@endsection
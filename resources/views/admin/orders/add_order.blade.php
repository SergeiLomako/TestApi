@extends('admin.layouts.admin')

@section('content')
    {!! Form::open(['url' => route('store_order'), 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('user', 'Пользователь', ['class' => 'control-label']) !!}
                {!! Form::select('user_id', $users, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('service', 'Услуга', ['class' => 'control-label']) !!}
                {!! Form::select('service_id', $services, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Описание', ['class' => 'control-label']) !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'Статус', ['class' => 'control-label']) !!}
                {!! Form::select('status', $statuses, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('payment', 'Оплата', ['class' => 'control-label']) !!}
                {!! Form::select('payment', $payments, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('payment_status', 'Статус оплаты', ['class' => 'control-label']) !!}
                {!! Form::select('payment_status', $payment_statuses, null, ['class'=>'form-control']) !!}
            </div>
            {!! Form::submit('Добавить') !!}
        </div>
        <div class="col-sm-4"></div>
    </div>
    {!! Form::close() !!}
@endsection
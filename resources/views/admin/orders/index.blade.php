<a href="{{route('store_order_form')}}" class="btn btn-default pull-right" style="margin-bottom: 10px">Добавить заказ</a>

{!! Form::open(['url' => route('search_order'), 'method' => 'get']) !!}
{!! Form::text('search', old('search'), ['class'=>'form-control']) !!}
@role('super_admin|moderator') {!! Form::checkbox('search_id', null, ['style' => 'margin-top: 5px']) !!} <b>поиск клиента по номеру заказа</b> @endrole
{!! Form::submit('найти', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top: 5px; margin-bottom: 5px']) !!}
{!! Form::close() !!}

<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th class="error error_name">Клиент</th>
        <th><a href="?field=services.title&sort={{$sort}}" data-type="order" class="error error_name">Услуга</a></th>
        <th><a href="?field=status&sort={{$sort}}" data-type="order" class="error error_city">Статус</a></th>
        <th><a href="?field=payment&sort={{$sort}}" data-type="order" class="error error_address">Оплата</a></th>
        <th><a href="?field=payment_status&sort={{$sort}}" data-type="order" class="error error_tel">Статус<br>оплаты</a></th>
        <th><a href="?field=seal_number&sort={{$sort}}" data-type="order" class="error error_login">Номер<br>пломбы</a></th>
        <th>Действие</th>
    </tr>
    @foreach($orders as $order)
        <tr class="list_item" id="{{$order->id}}">
            <td>{{$order->id}}</td>
            <td>{{$order->user->data->full_name}}</td>
            <td>{!! Form::select('service', $services, $order->service_id, ['disabled' => 'disabled', 'style' => 'border: none;',
                    'class' => 'input_item service_id list']) !!}</td>
            <td>{!! Form::select('status', $statuses, $order->status, ['disabled' => 'disabled', 'style' => 'border: none;',
                    'class' => 'input_item status list']) !!}</td>
            <td>{!! Form::select('payment', $payments, $order->payment, ['disabled' => 'disabled', 'style' => 'border: none;',
                    'class' => 'input_item payment list']) !!}</td>
            <td>{!! Form::select('payment_status', $payment_statuses, $order->payment_status, ['disabled' => 'disabled', 'style' => 'border: none;',
                    'class' => 'input_item payment_status list']) !!}</td></td>
            <td>{{ $order->seal_number }}</td>
            <td>
                @role('super_admin|admin')
                <a href="javascript:void(0)" class="btn btn-xs btn-success read_item" title="Сделать активным">
                    <span class=" glyphicon glyphicon-pencil"></span>
                </a>
                <a href="javascript:void(0)" class="btn btn-xs btn-info update_order" title="Обновить">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a><br>
                <a href="javascript:void(0)" class="btn btn-xs btn-danger delete_item" title="Удалить" data-id="{{$order->id}}">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
                @endrole
                <a href="javascript:void(0)" class="btn btn-xs btn-warning info_item" data-type="order"
                    data-toggle="modal" data-target="#myModal{{$order->id}}" id="{{$order->id}}" title="Подробнее">
                    <span class="glyphicon glyphicon-list"></span>
                </a>
                <div id="myModal{{$order->id}}" class="modal fade" role="dialog"><div class="modal-dialog modal-lg" id="popup{{$order->id}}"></div></div>
            </td>
        </tr>
    @endforeach
</table>
<div class="text-center">
    @if(count($orders) > 1)
        {{ $orders->links() }}
    @endif
</div>

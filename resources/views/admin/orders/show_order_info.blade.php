<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <p>Клиент: <b>{{$order->user->data->full_name}}</b></p>
                <p>Услуга: <b>{{$lists['services'][$order->service_id]}}</b></p>
                <p>Статус: <b>{{$lists['statuses'][$order->status]}}</b></p>
                <p>Оплата: <b>{{$lists['payments'][$order->payment]}}</b></p>
                <p>Статус оплаты: <b>{{$lists['payment_statuses'][$order->payment_status]}}</b></p>
                <p>Терминал: <b>{{$lists['terminals'][$order->terminal_id]}}</b></p>
                <p>Дата поступления: <b>{{$order->date_receipt}}</b></p>
                <p>Номер пломбы: <b>{{$order->seal_number}}</b></p>
                <p>Номер коробки: <b>{{$order->box_number}}</b></p>
                <p>Описание: <b>{{$order->title}}</b></p>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <div class="modal-footer"></div>
</div>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">{{$user->data->full_name}}</h3>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <p>Логин: <b>{{$user->login}}</b></p>
                <p>Email: <b>{{$user->email}}</b></p>
                <p>Город: <b>{{$user->data->city}}</b></p>
                <p>Адрес: <b>{{$user->data->address}}</b></p>
                <p>Телефон: <b>{{$user->data->tel}}</b></p>
                <p>День рождения: <b>{{$user->data->birth_date}}</b></p>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <div class="modal-footer"></div>
</div>

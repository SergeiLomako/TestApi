<a href="{{route('add_user')}}" class="btn btn-default pull-right" style="margin-bottom: 10px">Добавить пользователя</a>

{!! Form::open(['url' => route('search_user'), 'method' => 'get']) !!}
{!! Form::text('search', old('search'), ['class'=>'form-control']) !!}
{!! Form::checkbox('search_id', null, ['style' => 'margin-top: 5px']) !!} <b>поиск по номеру заказа</b>
{!! Form::submit('найти', ['class' => 'btn btn-info pull-right', 'style' => 'margin-top: 5px; margin-bottom: 5px']) !!}
{!! Form::close() !!}

<table class="table table-hover">
    <tr>
        <th>ID</th>
        <th><a href="?field=last_name&sort={{$sort}}" data-type="user" class="error error_name">ФИО</a></th>
        <th><a href="?field=role_id&sort={{$sort}}" data-type="user" class="error error_role">Должность</a></th>
        <th><a href="?field=city&sort={{$sort}}" data-type="user" class="error error_city">Город</a></th>
        <th><a href="?field=address&sort={{$sort}}" data-type="user" class="error error_address">Адрес</a></th>
        <th><a href="?field=tel&sort={{$sort}}" data-type="user" class="error error_tel">Телефон</a></th>
        <th><a href="?field=login&sort={{$sort}}" data-type="user" class="error error_login">Логин</a></th>
        <th>Пароль</th>
        <th>Действие</th>
    </tr>
    @foreach($users as $user)
        <tr class="list_item" id="{{$user->user_id}}">
            <td>{{$user->user_id}}</td>
            <td>{!! Form::text('full_name', isset($user->data) ? $user->data->full_name : $user->last_name . ' ' . $user->first_name, ['size' => 12, 'readonly' => 'true',
                    'style' => 'border: none', 'class' => 'input_item full_name'] ) !!}</td>
            <td>{!! Form::select('role', $roles, isset($user->roles[0]->id) ? $user->roles[0]->id : $user->role_id, ['disabled' => 'disabled', 'style' => 'border: none;',
                    'class' => 'input_item role list']) !!}</td>
            <td>{!! Form::text('city', isset($user->data) ? $user->data->city : $user->city , ['size' => 12, 'readonly' => 'true', 'style' => 'border: none',
                    'class' => 'input_item city']) !!}</td>
            <td>{!! Form::text('address', isset($user->data) ? $user->data->address : $user->address, ['size' => 12, 'readonly' => 'true', 'style' => 'border: none',
                    'class' => 'input_item address'] ) !!}</td>
            <td>{!! Form::tel('tel', $user->tel, ['size' => 12, 'readonly' => 'true', 'style' => 'border: none',
                    'class' => 'input_item tel_number'] ) !!}</td>
            <td>{!! Form::text('login', $user->login, ['size' => 12, 'class' => 'latin input_item login', 'maxlength' => 10,
                    'readonly' => 'true', 'style' => 'border: none'] ) !!}</td>
            <td>{!! Form::text('password', null, ['size' => 12, 'readonly' => 'true',  'maxlength' => 10, 'style' => 'border: none',
                    'class' => 'latin input_item password']) !!}</td>
            <td>
                <a href="javascript:void(0)" class="btn btn-xs btn-success read_item" title="Сделать активным">
                    <span class=" glyphicon glyphicon-pencil"></span>
                </a>
                <a href="javascript:void(0)" class="btn btn-xs btn-info update_user" title="Обновить">
                    <span class="glyphicon glyphicon-refresh"></span>
                </a><br>
                <a href="javascript:void(0)" class="btn btn-xs btn-danger delete_item" data-type="user" title="Удалить" data-id="{{$user->user_id}}">
                    <span class="glyphicon glyphicon-trash"></span>
                </a>
                <a href="javascript:void(0)" class="btn btn-xs btn-warning info_item" data-type="user"
                    data-toggle="modal" data-target="#myModal{{$user->user_id}}" id="{{$user->user_id}}" title="Подробнее">
                    <span class="glyphicon glyphicon-list"></span>
                </a>
                <div id="myModal{{$user->user_id}}" class="modal fade" role="dialog"><div class="modal-dialog modal-lg" id="popup{{$user->user_id}}"></div></div>
            </td>
        </tr>
    @endforeach
</table>
<div class="text-center">
    @if(count($users))
        {{ $users->links() }}
    @endif
</div>

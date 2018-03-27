<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ['view_clients' => 'Просмотр клиентов',
                        'view_orders' => 'Просмотр заказов',
                        'edit_clients' => 'Редактирование клиентов',
                        'edit_orders' => 'Редактирование заказов',
                        'delete_client' => 'Удаление клиента',
                        'delete_order' => 'Удаление заказ',
                        'search_client_tel' => 'Поиск клиента по номеру телефона',
                        'search_client_name' => 'Поиск клиента по имени',
                        'search_order_seal' => 'Поиск заказа по номеру пломбы',
                        'view_orders_status' => 'Просмотр статуса заказов',
                        'search_order_tel' => 'Поиск заказа по номеру телефона',
                        'search_user_order_id' => 'Поиск клиента по номеру заказа'];

        foreach ($permissions as $key => $val) {
           Permission::create(['name' => $key, 'display_name' => $val]);
        }
    }
}

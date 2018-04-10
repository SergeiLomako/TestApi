<?php
namespace App\Helpers;

class MyHelper {
    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public static function addRole($user, $role_id) {
        $role_id != 0 ? $user->syncRoles([$role_id]) : $user->detachRoles([2,3]);
        return true;
    }

    public static function fillRequest($model, $request){
        $array = $request->except('_token');
        foreach($array as $item){
            trim($item);
            strip_tags($item);
            htmlspecialchars($item);
        }
        $model->fill($array);
        $model->save();
        return true;
    }

    public static function doNotSearching($user){
        $do_not_searching = [$user->id];
        $super_admin = \App\User::whereHas('roles', function($query){
            $query->whereName('super_admin');
        })->first();
        $super_admin->id == $user->id ?: array_push($do_not_searching, $super_admin->id);
        return $do_not_searching;
    }

    public static function servicesAndStatuses(){
        $terminals = \App\Terminal::all();
        $services = \App\Service::all();
        $service_list = [];
        $terminal_list = [];
        foreach ($terminals as $terminal){
            $terminal_list[$terminal->id] = $terminal->address;
        }
        foreach($services as $service){
            $service_list[$service->id] = $service->title;
        }

        return ['services' => $service_list,
                'statuses' => [
                                0 => 'В обработке',
                                1 => 'Выполнен'
                              ],
                'payments' => [
                                0 => 'Наличные',
                                1 => 'Безнал',
                              ],
                'payment_statuses' => [
                                        0 => 'Не оплачено',
                                        1 => 'Оплачено'
                                      ],
                'terminals' => $terminal_list
                ];
    }
}
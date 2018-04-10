<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $primaryKey = 'id';
    protected $fillable = ['user_id', 'service_id', 'status', 'payment', 'payment_status', 'title', 'seal_number', 'box_number', 'terminal_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function terminal()
    {
        return $this->belongsTo('App\Terminal');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function setDateReceiptAttribute()
    {
        $this->attributes['date_receipt'] = Carbon::now();
    }

    public static function getList($field, $sort)
    {
        return self::join('services', 'orders.service_id', '=', 'services.id')
            ->select(['orders.*', 'services.title'])
            ->orderBy($field, $sort)
            ->paginate(env('PAGINATE_LIMIT'));
    }

    public static function search($search)
    {
        return self::where('seal_number', 'like', $search)->orWhereHas('user', function ($query) use ($search) {
            $query->whereHas('data', function ($query) use ($search) {
                $query->where('tel', 'like', $search);
            });
        })->paginate(env('PAGINATE_LIMIT'));
    }
}

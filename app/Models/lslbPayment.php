<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class lslbPayment extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_id',
        'payment_id',
        'payment_amount',
        'payment_type',
        'payment_method',
        'payment_responce',
    ];

    public function users()
    {
        return $this->belongsTo(lslbUser::class);
    }

    public function orders()
    {
        return $this->belongsTo(lslbOrder::class, 'order_id');
    }
    
    public function paymentList($user_id, $role)
    {
        $selectedUserData = lslbUser::select('lslb_payments.*', 'lslb_websites.user_id', 'lslb_websites.id', 'lslb_orders.id', 'lslb_orders.website_id', 'lslb_orders.order_id as o_id', 'lslb_orders.order_date', 'lslb_orders.payment_status', 'lslb_users.id as u_id')
        ->join('lslb_websites', 'lslb_users.id', '=', 'lslb_websites.user_id')
        ->join('lslb_orders', 'lslb_websites.id', '=', 'lslb_orders.website_id')
        ->join('lslb_payments', 'lslb_orders.id', '=', 'lslb_payments.order_id');
        $selectedUserData =  $role != 'Advertiser' ? $selectedUserData->where('lslb_users.id', $user_id) : $selectedUserData->where('lslb_payments.user_id', $user_id);
        $selectedUserData = $selectedUserData->distinct()->get();
        return $selectedUserData;
    }
}

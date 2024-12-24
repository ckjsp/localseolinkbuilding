<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class lslbOrder extends Authenticatable
{
    use HasFactory, SoftDeletes;

    // Specify the table name
    protected $table = 'lslb_orders';

    protected $fillable = [
        'order_id',
        'website_id',
        'u_id',
        'email',
        'price',
        'quantity',
        'attachment_type',
        'order_date',
        'delivery_time',
        'status',
        'rejection_reason',
        'completion_url',
        'payment_method',
        'payment_status',
        'attachment',
        'existing_post_url',
        'landing_page_url',
        'anchor_text',
        'article_title',
        'special_instructions',
        'selected_project_id',

    ];

    public function website()
    {
        return $this->belongsTo(lslbWebsite::class);
    }

    public function payments()
    {
        return $this->hasMany(lslbPayment::class, 'order_id');
    }

    public function orderList($uesr_id = '')
    {
        $selectedUserData = lslbUser::select('*')
            ->join('lslb_websites', 'lslb_users.id', '=', 'lslb_websites.user_id')
            ->join('lslb_orders', 'lslb_websites.id', '=', 'lslb_orders.website_id');

        if (!empty($uesr_id)) {
            $selectedUserData = $selectedUserData->where('lslb_users.id', $uesr_id);
        }

        $selectedUserData = $selectedUserData->distinct()->get();
        return $selectedUserData;
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

// class lslbUser extends Authenticatable
class lslbUser extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role_id',
        'email',
        'phone_number',
        'dial_code',
        'image',
        'email_verified_at',
        'identity',
        'status',
        'password',
        'company_website_url',
        'country',
        'balance',
        'preferred_method',
        'payment_email',
        'business_name',
        'registration_number',
        'billing_address',
        'billing_city',
        'billing_country',
        'postal_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(lslbRoles::class);
    }

    public function websites() {
        return $this->hasMany(lslbWebsite::class);
    }

    /* function getUsersWithWebsite()
    {
        $selectedUserData = lslbUser::select('*', 'lslb_websites.id as web_id')->join('lslb_websites', 'lslb_users.id', '=', 'lslb_websites.user_id')->get();
        return $selectedUserData;
    } */

    // function newQuery($excludeDeleted = true)
    // {
    //     $query = parent::newQuery($excludeDeleted);
    //     parent::setTable('users');

    //     // Select the columns you want from both tables
    //     $query->select('users.id as id', 'users.*', 'user_roles.id as roles_id', 'user_roles.*');
        
    //     // Add the join condition with the 'user_roles' table
    //     $query->join('user_roles', 'users.role_id', '=', 'user_roles.id');

    //     return $query;
    // }
}
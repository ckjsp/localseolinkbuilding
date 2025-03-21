<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Add the fillable fields here
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'message',
    ];
}

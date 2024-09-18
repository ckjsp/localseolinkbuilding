<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lslbProject extends Model
{
    use HasFactory;
    protected $table = 'lslb_project';

    protected $fillable = [
        'user_id',
        'project_name',
        'project_url',
        'add_competitor',
        'categories',
        'forbidden_category',
        'additional_note',
    ];

    protected $casts = [
        'categories' => 'array',
        'forbidden_category' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

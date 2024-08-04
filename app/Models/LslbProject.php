<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LslbProject extends Model
{
    use HasFactory;
    protected $table = 'lslb_project';
    protected $fillable = [
        'project_name',
        'project_url',
        'categories',
        'forbidden_category',
        'additional_note',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}

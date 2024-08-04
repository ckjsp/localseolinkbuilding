<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
class lslbProject extends Model
{
    use HasFactory;

    protected $table = 'lslb_project';

=======
class LslbProject extends Model
{
    use HasFactory;
    protected $table = 'lslb_project';
>>>>>>> main
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

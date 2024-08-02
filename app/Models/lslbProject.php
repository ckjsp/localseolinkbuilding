<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LslbProject extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'lslb_project';

    // Specify the primary key if it isn't 'id'
    protected $primaryKey = 'id';

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'project_name',
        'project_url',
        'categories',
        'forbidden_category',
        'additional_note',
    ];

    // Optionally specify any attributes that should be hidden for arrays
    protected $hidden = [
        // Attributes to be hidden
    ];

    // Optionally specify any attributes that should be cast to native types
    protected $casts = [
        // Attributes to cast
    ];
}

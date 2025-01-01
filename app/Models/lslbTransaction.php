<?php

namespace App\Models;

use App\Models\lslbPublisher;
use App\Models\lslbUser;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lslbTransaction extends Model
{
    use HasFactory;

    // Table name (ensure it's correct)
    protected $table = 'transaction';

    // Primary key field name
    protected $primaryKey = 'transaction_id';

    // To specify that transaction_id is not auto-incrementing
    public $incrementing = false;

    // Data types to cast
    protected $casts = [
        'transaction_date' => 'datetime',
        'amount' => 'decimal:2', // For amount with 2 decimal points
        'currency' => 'string',
        'status' => 'string',
    ];

    // Mass assignable attributes
    protected $fillable = [
        'publisher_id',
        'transaction_date',
        'transaction_type',
        'amount',
        'currency',
        'payment_email',
        'status',
        'description',
    ];

    // Guarded attributes (for the model)
    protected $guarded = [];

    // Enabling timestamps for created_at and updated_at columns
    public $timestamps = true;

    public function publisher()
    {
        return $this->belongsTo(lslbUser::class, 'publisher_id'); // Assuming the foreign key is 'publisher_id'
    }
}

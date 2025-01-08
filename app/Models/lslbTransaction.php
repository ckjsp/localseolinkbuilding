<?php

namespace App\Models;

use App\Models\lslbPublisher;
use App\Models\lslbUser;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lslbTransaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $primaryKey = 'transaction_id';

    public $incrementing = false;

    protected $casts = [
        'transaction_date' => 'datetime',
        'amount' => 'decimal:2',
        'currency' => 'string',
        'status' => 'string',
    ];

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

    protected $guarded = [];

    public $timestamps = true;

    public function publisher()
    {
        return $this->belongsTo(lslbUser::class, 'publisher_id');
    }

    public function user()
    {
        return $this->belongsTo(lslbUser::class, 'publisher_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


// class lslbPublisher extends Model
class lslbPublisher extends Authenticatable
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'website_url',
        'domain_authority',
        'publishing_time',
        'minimum_word_count_required',
        'backlink_type',
        'maximum_no_of_backlinks_allowed',
        'domain_life_validity',
        'sample_post_url',
        'guidelines',
        'categories',
        'guest_post_price',
        'link_insertion_price',
        'select_the_forbidden_categories_you_accept',
        'fc_guest_post_price',
        'fc_link_insertion_price',
    ];

    public function users()
    {
        return $this->belongsTo(lslbUser::class);
    }
}
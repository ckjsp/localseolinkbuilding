<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Listeners\UpdateWebsiteUrlOnDelete;

// class lslbWebsite extends Model
class lslbWebsite extends Authenticatable
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
        'domain_rating',
        'page_authority',
        'spam_score',
        'ahrefs_traffic',
        'samrush_traffic',
        'google_analytics',
        'publishing_time',
        'minimum_word_count_required',
        'backlink_type',
        'maximum_no_of_backlinks_allowed',
        'domain_life_validity',
        'traffic_by_country',
        'sample_post_url',
        'guidelines',
        'categories',
        'guest_post_price',
        'link_insertion_price',
        'forbidden_categories',
        'fc_guest_post_price',
        'fc_link_insertion_price',
        'status',
        'site_verification_file',
        'rejectionReason',
        'linkedinSession_adminprice',
        'guestPostPrice_adminprice',

    ];

    protected $dispatchesEvents = [
        'deleting' => UpdateWebsiteUrlOnDelete::class,
    ];

    public function user()
    {
        return $this->belongsTo(lslbUser::class);
    }

    public function orders()
    {
        return $this->hasMany(lslbOrder::class);
    }
}

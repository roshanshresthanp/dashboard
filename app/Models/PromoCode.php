<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title','code','promo_type','worth','eligible','validity','activation_date','expire_date',
        'usage_limit','used','status','image','featured_status'
    ];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'promo-codes';
    const PERMISSIONSLUG = 'promo-codes';
    // protected $guard_name = 'api';

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\LogOptions;

class PromoCode extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    SoftDeletes,
    LogsActivity;

    protected $fillable = [
        'title','code','promo_type','worth','eligible','validity','activation_date','expire_date',
        'usage_limit','used','status','image','featured_status'
    ];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'promo-codes';
    const PERMISSIONSLUG = 'promo-codes';
    // protected $guard_name = 'api';
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(static::$logName)
            ->logAll()
            ->logOnlyDirty();
    }

    public function scopeActive($query)
    {
        $nowDate = Carbon::parse(now()->timezone('Asia/Kathmandu'))->format("Y-m-d H:i:s");
        return $query->where('expire_date','>',$nowDate)->where('status',1);
    }

}

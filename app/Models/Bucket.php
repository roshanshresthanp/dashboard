<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Bucket extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    LogsActivity;


    protected $fillable = [
        'extras', 'count', 'rate','cloth_category_id','user_id','cloth_id'
    ];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Bucket';
    const PERMISSIONSLUG = 'buckets';
    protected $guard_name = 'api';



    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(static::$logName)
            ->logAll()
            ->logOnlyDirty();
    }

    public function cloth()
    {
        return $this->belongsTo(ClothType::class,'cloth_id','id')->withDefault();
    }

    public function scopeStatus($query)
    {
        return $query->whereHas('cloth',function($query){
            $query->where('status',1);
        });
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class ClothType extends Model
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    SoftDeletes,
    LogsActivity;

    protected $fillable = ['name','slug','status','parent_id','rate','image'];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'cloth-types';
    const PERMISSIONSLUG = 'cloth-types';
    protected $guard_name = 'api';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(static::$logName)
            ->logAll()
            ->logOnlyDirty();
    }


    public function scopeStatus($query)
    {
        return $query->where('status',1);
    }

    public function scopeCategory($query)
    {
        return $query->where('parent_id',0);
    }

    public function scopeCloth($query)
    {
        return $query->whereNot('parent_id',0);
    }

    public function clothes()
    {
        return $this->hasMany(ClothType::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ClothType::class,'parent_id','id')->withDefault();
    }

}

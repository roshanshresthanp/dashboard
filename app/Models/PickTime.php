<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class PickTime extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    LogsActivity;

    protected $fillable = ['time','status'];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'pickup-times';
    const PERMISSIONSLUG = 'pickup-times';
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
    
}

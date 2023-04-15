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


    protected $fillable = ([
        'name', 'email', 'phone', 'message', 'source','parent_id','user_id','status'
    ]);

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
}

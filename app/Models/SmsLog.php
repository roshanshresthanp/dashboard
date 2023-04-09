<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class SmsLog extends Model
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Sms';
    const PERMISSIONSLUG = 'sms';
    // protected $guard_name = 'api';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(static::$logName)
            ->logAll()
            ->logOnlyDirty();
    }

    protected $fillable = [
        'request',
        'response',
        'reason',
        'number',
        'message',
        'provider',
        'resent',
        'user_id',
    ];

    protected $casts = [
        "request" => "array",
        'response' => "array"
    ];
}

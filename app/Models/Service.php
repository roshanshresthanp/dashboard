<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\LogOptions;
class Service extends Model
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'services';
    const PERMISSIONSLUG = 'services';
    // protected $guard_name = 'api';

    protected $fillable = ['name','status','image'];
    
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(static::$logName)
            ->logAll()
            ->logOnlyDirty();
    }

    public function getImageAttribute($value)
    {
        $img = asset('no.jpeg');
        if($value && file_exists(public_path(parse_url($value)['path'])))
        {
            $img = $value;
        }
        return  $img;   
    }

    public function scopeStatus($query)
    {
        return $query->where('status',1);
    }
    
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    SoftDeletes,
    LogsActivity;


    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'User';
    const PERMISSIONSLUG = 'users';
    protected $guard_name = 'api';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(static::$logName)
            ->logAll()
            ->logOnlyDirty();
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'mobile',
        // 'gender',
        'photo',
        'address',
        'added_by',
        'password_reset',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeCustomer($query)
    {
        return $query->whereHas('roles',function($q){
            $q->where('slug','customer');
        });
    }

    public function scopeUser($query)
    {
        return $query->whereHas('roles',function($q){
            $q->whereNot('slug','customer');
        });
    }

    public function isAdmin()
    {
        if($this->roles->filter(function($item){
            return $item->slug == 'super-admin';
        })->isEmpty()){
            return false;
        }
        return true;
    }

    public function scopeStatus()
    {
        
    }

    

    // public function afterCreateProcess()
    // {
    //     $request = request();
    //     $role = $request->get('role_id');
    //     $this->roles()->attach([$role]);

    //     if (array_key_exists("media_id", $request->all())) {
    //         $this->attachMedia($request->media_id, 'user_photo');
    //     }
    // }

    // public function afterUpdateProcess()
    // {
    //     $request = request();
    //     $role = $request->get('role_id');
    //     $this->syncRoles([$role]);

    //     if (array_key_exists("media_id", $request->all())) {
    //         $this->syncMedia($request->media_id, 'user_photo');
    //     }
    // }

}

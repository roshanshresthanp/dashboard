<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Models\Activity;

/**
 * @OA\Schema(
 *     title="User",
 *     description="User model",
 *     @OA\Xml(
 *         name="User"
 *     )
 * )
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles,
    SoftDeletes,
    LogsActivity;


    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'User';
    const PERMISSIONSLUG = 'users';
    // protected $guard_name = 'api';

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
        'image',
        'address',
        'added_by',
        'password_reset',
        'status',
        'fcm_token'
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
    public function getImageAttribute($value)
    {
        $img = asset('avatar.png');
        if($value)
        {
            $path = public_path(parse_url($value)['path']);
            if(file_exists($path))
            $img = $value;
        }
        return  $img;   
    }
    public function scopeCustomer($query)
    {
        return $query->whereHas('roles',function($q){
            $q->where('id','2');
        });
    }

    public function scopeUser($query)
    {
        return $query->whereHas('roles',function($q){
            $q->whereNot('id','2');
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

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function promo()
    {
        return $this->belongsToMany(PromoCode::class,'customer_promo','user_id','promo_id')->withPivot('usage');
    }

    

    public function afterCreateProcess()
    {
        $this->profile()->create([
            'temporary_address' =>$this->request->temporary_address,
            'permanent_address' =>$this->request->permanent_address,
            'latitude' =>$this->request->latitude,
            'longitude' =>$this->request->longitude,
            'gender' =>$this->request->gender,

        ]);

        
        $request = request();
        $role = $request->get('role_id');
        $this->roles()->attach([$role]);

        // if (array_key_exists("media_id", $request->all())) {
        //     $this->attachMedia($request->media_id, 'user_photo');
        // }
    }

    public function afterUpdateProcess()
    {
        dd($this->request->temporary_address);
        $this->profile()->update([
            'temporary_address' =>$this->request->temporary_address,
            'permanent_address' =>$this->request->permanent_address,
            'latitude' =>$this->request->latitude,
            'longitude' =>$this->request->longitude,
            'gender' =>$this->request->gender,

        ]);

        $request = request();
        $role = $request->get('role_id');
        $this->syncRoles([$role]);

        // if (array_key_exists("media_id", $request->all())) {
        //     $this->syncMedia($request->media_id, 'user_photo');
        // }
    }

    public function buckets()
    {
        return $this->hasMany(Bucket::class);
    }

    public function activity(): MorphMany
    {
        return $this->morphMany(Activity::class,'causer');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
// use App\Models\Traits\CommonEventListener;


class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;
    use SoftDeletes;
    // use CommonEventListener;
    // use CRUD;
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Role';
    const PERMISSIONSLUG = 'roles';
    protected $guard_name = 'api';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName(static::$logName)
            ->logAll()
            ->logOnlyDirty();
    }


    protected $table = 'roles';

    protected $fillable = ['name','guard_name','slug'];


    // public function afterCreateProcess()
    // {
    //     $permissions = request()->get('permissions');
    //     $this->permissions()->sync($permissions);
    // }

    // public function afterUpdateProcess()
    // {
    //     $permissions = request()->get('permissions');
    //     $this->permissions()->sync($permissions);
    // }

}

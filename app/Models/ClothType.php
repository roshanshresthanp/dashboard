<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClothType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','slug','status','parent_id'];

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'cloth-types';
    const PERMISSIONSLUG = 'cloth-types';
    protected $guard_name = 'api';


    public function scopeStatus($query)
    {
        return $query->where('status',1);
    }

    public function child()
    {
        return $this->hasMany(ClothType::class,'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(ClothType::class,'parent_id','id');
    }
}

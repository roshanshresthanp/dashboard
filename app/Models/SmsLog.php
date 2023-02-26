<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

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

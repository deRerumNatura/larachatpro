<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message'
    ];

    protected $hidden = [
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App;

use App\Listeners\GenerateColor;
use App\Models\Message;
use Illuminate\Auth\Events\Registered;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'color', 'disabled', 'baned',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dispatchesEvents = [
        'creating' => Registered::class,
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

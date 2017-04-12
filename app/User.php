<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Conversation;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
     use Notifiable, Searchable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isInConversation(Conversation $conversation)
    {
        return $this->conversations->contains($conversation);
    }


    public function conversations()
    {
        return $this->belongsToMany(Conversation::class)
                    ->whereNull('parent_id')
                    ->orderBy('last_reply', 'desc');
    }

    public function avatar($size = 45)
    {
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=' . $size . '&d=mm';
    }
}

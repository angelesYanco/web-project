<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Foundation\Auth\User;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'password' => 'hashed',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    //Relations
    public function from(){

        return $this->belongsToMany(User::class, 'friends', 'from_id', 'to_id');
    }
    public function to(){

        return $this->belongsToMany(User::class, 'friends', 'to_id', 'from_id');
    }

    //Friends
    public function friendsFrom(){

        return $this->from()->wherePivot('accepted', true);
    }
    public function friendsTo(){

        return $this->to()->wherePivot('accepted', true);
    }

    //Friends pending
    public function pendingFrom(){

        return $this->from()->wherePivot('accepted', false);
    }
    public function pendingTo(){

        return $this->to()->wherePivot('accepted', false);
    }

}

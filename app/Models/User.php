<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'location',
        'gender',
        'email',
        'password',
        'image_path',
        'user'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function freelancer()
    {
        return $this->hasOne(Freelancer::class);
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function gig()
    {
        return $this->hasMany(Gig::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }

    public function user_from()
    {
        return $this->hasMany(Messages::class, 'user_from');
    }

    public function user_to()
    {
        return $this->hasMany(Messages::class, 'user_to');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function review()
    {
        return $this->hasMany(Reviews::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'title',
        'description',
        'bids',
        'duration',
        'location',
        'payment_mode',
        'price',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function application()
    {
        return $this->hasMany(Application::class);
    }

    public function contract()
    {
        return $this->hasMany(Contract::class);
    }

    public function job()
    {
        return $this->hasOne(Job::class);
    }

    public function ban()
    {
        return $this->hasOne(Ban::class);
    }
}

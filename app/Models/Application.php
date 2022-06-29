<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gig_id',
        'proposal',
        'status'
    ];

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}

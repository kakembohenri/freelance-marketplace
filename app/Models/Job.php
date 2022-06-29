<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'gig_id',
        'user_id',
        'status',
        'work',
        'verdict',
        'rate',
        'price',
        'paid'
    ];

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

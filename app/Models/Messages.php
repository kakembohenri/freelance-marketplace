<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_from',
        'user_to',
        'body'
    ];

    public function user_from()
    {
        return $this->belongsTo(User::class, 'user_from');
    }

    public function user_to()
    {
        return $this->belongsTo(User::class, 'user_to');
    }

    public function sender($item)
    {
        return $this->user_from->contains('id', $item);
    }
}

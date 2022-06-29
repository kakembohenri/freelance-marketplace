<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freelancer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_reg_no',
        'about',
        'price',
        'main_skill',
        'skills'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

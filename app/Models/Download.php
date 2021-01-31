<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'user_id',
    ];

    protected $hidden = [];

    protected $casts = [];

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


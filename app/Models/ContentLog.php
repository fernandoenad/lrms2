<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'data',
        'content_id',
        'user_id',
    ];

    protected $hidden = [];

    protected $casts = [];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

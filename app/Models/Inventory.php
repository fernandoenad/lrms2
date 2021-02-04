<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'learningarea',
        'gradelevel',
        'author',
        'publisher',
        'lrtype',
        'acquisitiondate',
        'acquisitionmode',
        'copies',
        'status',
        'schoolyear',
        'user_id',
    ];

    protected $hidden = [];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

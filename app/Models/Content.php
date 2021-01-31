<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'attachment',
        'datefrom',
        'dateto',
        'user_id',
        'visibility',
        'sort',
    ];

    protected $hidden = [];

    protected $casts = [
        'datefrom' => 'date',
        'dateto' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function download()
    {
        return $this->hasMany(Download::class);
    }
}

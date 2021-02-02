<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'user_id',
        'visibility',
        'sort',
    ];

    protected $hidden = [];

    protected $casts = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->hasMany(Content::class);
    }

    public function getVisibility($visibility)
    {
        switch($visibility){
            case 0:
                $visibility_name = 'Hidden';
                break;
            case 1:
                $visibility_name = 'Shown';
                break;
        }

        return $visibility_name;
    }

    public function getVisibilityColor($visibility)
    {
        switch($visibility){
            case 0:
                $visibility_name = 'danger';
                break;
            case 1:
                $visibility_name = 'success';
                break;
        }

        return $visibility_name;
    }
}

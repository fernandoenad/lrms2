<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'visibility',
        'sort',
    ];

    protected $hidden = [];

    protected $casts = [];

    public function course()
    {
        return $this->hasMany(Course::class);
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

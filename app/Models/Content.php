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
        'course_id',
        'user_id',
        'status',
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

    public function contentlog()
    {
        return $this->hasMany(ContentLog::class);
    }

    public function getStatus($status)
    {
        switch($status){
            case 1:
                $status_name = 'New';
                break;
            case 2:
                $status_name = 'Pending';
                break;
            case 3:
                $status_name = 'Approved';
                break;
        }

        return $status_name;
    }

    public function getStatusColor($status)
    {
        switch($status){
            case 1:
                $status_name = 'danger';
                break;
            case 2:
                $status_name = 'warning';
                break;
            case 3:
                $status_name = 'success';
                break;
        }

        return $status_name;
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

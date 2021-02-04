<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'messages',
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
                $status_name = 'Resolved';
                break;
        }

        return $status_name;
    }

    public function getStatusColor($status)
    {
        switch($status){
            case 1:
                $status_color = 'danger';
                break;
            case 2:
                $status_color = 'warning';
                break;
            case 3:
                $status_color = 'success';
                break;
        }

        return $status_color;
    }
}

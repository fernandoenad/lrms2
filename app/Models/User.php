<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'image',
        'service',
        'district',
        'role',
        'status',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function course()
    {
        return $this->hasMany(Course::class);
    }

    public function content()
    {
        return $this->hasMany(Content::class);
    }

    public function download()
    {
        return $this->hasMany(Download::class);
    }

    public function contentreport()
    {
        return $this->hasMany(ContentReport::class);
    }

    public function contentlog()
    {
        return $this->hasMany(ContentLog::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }

    public function getRole($role)
    {
        switch($role){
            case 1:
                $role_name = 'Administrator';
                break;
            case 2:
                $role_name = 'Manager';
                break;
            case 3:
                $role_name = 'Personnel';
                break;
            case 4:
                $role_name = 'User';
                break;
        }

        return $role_name;
    }

    public function getStatus($status)
    {
        switch($status){
            case 0:
                $status_name = 'Inactive';
                break;
            case 1:
                $status_name = 'Active';
                break;
        }

        return $status_name;
    }
}

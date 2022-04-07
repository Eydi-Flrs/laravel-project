<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($role_name){
        foreach ($this->roles as $role){
            if($role_name == $role->name){
                return true;
            }
        }return false;
    }

    public function Password():Attribute{
        return Attribute::make(
            set:fn($value)=>bcrypt($value),
        );

    }
    public function Avatar():Attribute{
        return Attribute::make(
            set:fn($value)=>substr($value,7),
            get: fn($value)=>asset("storage/images/".$value),
        );

    }

}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes,HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'name',
        'email',
        'contact_number',
        'avatar',
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
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function favorites(){
        return $this->belongsToMany(Favorite::class);
    }
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($role_name){
        foreach ($this->roles as $role){
            if( Str::lower($role_name) ==  Str::lower($role->name)){
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

    public function deleteAvatar(){
        $myString=$this->avatar;
        $findMe='/';
        $lenght0fString=strlen($myString);
        $pos=strrpos($myString, $findMe)+1;
        $trim=substr($myString,$pos,$lenght0fString);
        $avatarPath='images/'.$trim;
//            dd($avatarPath);
        Storage::delete($avatarPath);
    }




}

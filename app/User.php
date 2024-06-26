<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Kodeine\Acl\Traits\HasRole;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRole;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile','status', 'image','token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','created_at', 'updated_at', 'deleted_at', 'created_by', 'status'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function cart(){
        return $this->hasMany('App\Models\Cart', 'user_id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Order', 'user_id');
    }

    public function partner(){
        return $this->hasOne('App\Models\Partner', 'user_id');
    }

    public function getImageAttribute($value){
        return Storage::url($value);
    }

    public function getDobAttribute($value){
        return $value??'';
    }

    public function getNameAttribute($value){
        return $value??'';
    }

    public function getEmailAttribute($value){
        return $value??'';
    }

    public function getGenderAttribute($value){
        return $value??'';
    }

    public function getMobileAttribute($value){
        return $value??'';
    }

    public function getAddressAttribute($value){
        return $value??'';
    }


}

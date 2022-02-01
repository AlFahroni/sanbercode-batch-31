<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable ,  UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username' , 'role_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role(){
      return $this->belongsTo('App\Role');
    }

    public function otp_code()
    {
      return $this->hasOne('App\OtpCode');
    }

    public function isAdmin()
    {
      // $this->role->name;
      // if($this->role_id === $this->get_role_admin()){
      //   return true;
      // }

      // return false;

      if($this->role){
        if($this->role->name == 'admin'){
          return true;
        }
      }

      return false;
    }

    public function get_role_admin()
    {
      $role = Role::where('name' , 'admin')->first();

      return $role->id;
    }

    public function get_role_user()
    {
      $role = Role::where('name', 'user')->first();

      return $role->id;
    }

    public static function boot()
    {
      parent::boot();

      static::creating( function($model){
        $model->role_id = $model->get_role_user();
      });

    }




}

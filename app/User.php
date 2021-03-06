<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_number','name', 'faculty', 'phone' , 'email', 'password', 'progress', 'department', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function authorizeRoles($roles)
    {

      if (is_array($roles)) {

          return $this->hasAnyRole($roles) ||
                 abort(403, 'This action is unauthorized.');

      }

      return $this->hasRole($roles) ||
             abort(403, 'This action is unauthorized.');

    }

    public function hasAnyRole($roles)
    {

      return null !== $this->roles()->whereIn('name', $roles)->first();

    }

    public function hasRole($role)
    {

      return null !== $this->roles()->where('name', $role)->first();

    }

    public function roleName()
    {
        $uname = $this->roles()->where('user_id',$this->id)->first();
        return $uname->name;
    }

    public function jurnals(){
        return $this->belongsToMany(Jurnal::class)->withPivot('completed');
    }

    public function takenJurnalList(){
        return $this->jurnals()->where('user_id',$this->id)->get();
    }

    public function pretests(){
        return $this->belongsToMany(Pretest::class);
    }

    public function posttests(){
        return $this->belongsToMany(Posttest::class);
    }
}

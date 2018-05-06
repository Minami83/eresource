<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    //
    protected $fillable = ['name','fullName'];

    public function users(){
      return $this->belongsToMany(User::class);
    }
}

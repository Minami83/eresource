<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    //
    protected $fillable = ['name','fullName','howto','video','description'];

    public function users(){
      return $this->belongsToMany(User::class)->withPPivot('completed');
    }
}

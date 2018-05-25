<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Jurnal;
class Log extends Model
{
    //
  protected $fillable = ['user_id', 'jurnal_id', 'activity'];

  public function userName()
  {
    $user = User::where('id',$this->user_id)->first();
    return $user->name;
  }

  public function JurnalName()
  {
    if($this->jurnal_id == 0) return 'System';
    $jurnal = Jurnal::where('id',$this->jurnal_id)->first();
    return $jurnal->fullName;
  }
}

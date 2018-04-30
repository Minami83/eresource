<?php

use Illuminate\Database\Seeder;
use App\Jurnal;
class JurnalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      $jurnalList = ['asce', 'asme', 'melp', 'tnarina', 'sbridrina', 'smdrina', 'ijme',
                      'ijsct', 'jspd', 'jsr', 'marinetech', 'springerlink', 'emerald',
                      'gale', 'ieee', 'ebsco', 'proquest', 'sciencedir', 'nature'];
      foreach ($jurnalList as $jurnalName){
          $jurnal = new Jurnal();
          $jurnal->name = $jurnalName;
          $jurnal->save();
      }
    }
}

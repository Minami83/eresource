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
      $jurnalList = [['asce','American Society of Civil Engineers (ASCE)'],
      ['asme','The American Society of Mechanical Engineers (ASME)'],
      ['melp','Palgrave McMillan-Maritime Economics & Logistics'],
      ['tnarina','The Naval Architect - RINA'],
      ['sbidrina','Ship & Boat International Digital - RINA'],
      ['smdrina','Shiprepair & Maintenance Digital - RINA'],
      ['ijme','International journal of Maritime Technology (IJME) - RINA'],
      ['ijsct','International Journal of Small Craft Technology (IJSCT) - RINA'],
      ['jspd','Journal of Ship Production and Design'],
      ['jsr','Journal of Ship Research'],
      ['marinetech','Marine Technology'],
      ['springerlink','Springer Link'],
      ['emerald','Emeraldinsight'],
      ['gale','Cangage Learning (GALE)'],
      ['ieee','IEEE Xplore'],
      ['ebsco','EBSCO'],
      ['proquest','ProQuest'],
      ['sciencedir','ScienceDirect'],
      ['nature','Nature']];

      foreach ($jurnalList as $jurnalName){
          $jurnal = new Jurnal();
          $jurnal->name = $jurnalName[0];
          $jurnal->fullName = $jurnalName[1];
          $jurnal->howto = public_path().'/video/vid1.mp4';
          $jurnal->video = public_path().'/video/vid1.mp4';
          $jurnal->save();
      }
    }
}

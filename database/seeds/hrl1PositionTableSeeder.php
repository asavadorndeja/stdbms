<?php

use Illuminate\Database\Seeder;

class hrl1PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $records = [
        [ 'hrl1CategoryRef' => 'Management1', 'hrl1Position' => 'Senior director', 'hrl1Grade' =>'12'],
        [ 'hrl1CategoryRef' => 'Management1', 'hrl1Position' => 'Director', 'hrl1Grade' =>'11'],
        [ 'hrl1CategoryRef' => 'Management2', 'hrl1Position' => 'Senior engineering manager', 'hrl1Grade' =>'11'],
        [ 'hrl1CategoryRef' => 'Management2', 'hrl1Position' => 'Engineering manager', 'hrl1Grade' =>'10'],
        [ 'hrl1CategoryRef' => 'Project management', 'hrl1Position' => 'Senior project manager', 'hrl1Grade' =>'11'],
        [ 'hrl1CategoryRef' => 'Project management', 'hrl1Position' => 'Project manager', 'hrl1Grade' =>'10'],
        [ 'hrl1CategoryRef' => 'Project management', 'hrl1Position' => 'Senior project engineer', 'hrl1Grade' =>'9'],
        [ 'hrl1CategoryRef' => 'Project management', 'hrl1Position' => 'Project engineer', 'hrl1Grade' =>'8'],
        [ 'hrl1CategoryRef' => 'Professional', 'hrl1Position' => 'Chief engineer', 'hrl1Grade' =>'10'],
        [ 'hrl1CategoryRef' => 'Professional', 'hrl1Position' => 'Principal engineer', 'hrl1Grade' =>'9'],
        [ 'hrl1CategoryRef' => 'Professional', 'hrl1Position' => 'Senior engineer', 'hrl1Grade' =>'8'],
        [ 'hrl1CategoryRef' => 'Professional', 'hrl1Position' => 'Associate engineer', 'hrl1Grade' =>'6'],
        [ 'hrl1CategoryRef' => 'Professional', 'hrl1Position' => 'Discipline engineer', 'hrl1Grade' =>'7'],
        [ 'hrl1CategoryRef' => 'Technical', 'hrl1Position' => 'Chief designer', 'hrl1Grade' =>'9'],
        [ 'hrl1CategoryRef' => 'Technical', 'hrl1Position' => 'Principal designer', 'hrl1Grade' =>'8'],
        [ 'hrl1CategoryRef' => 'Technical', 'hrl1Position' => 'Senior designer', 'hrl1Grade' =>'7'],
        [ 'hrl1CategoryRef' => 'Technical', 'hrl1Position' => 'Discipline designer', 'hrl1Grade' =>'6'],
        [ 'hrl1CategoryRef' => 'Technical', 'hrl1Position' => 'Associate designer', 'hrl1Grade' =>'5'],
        [ 'hrl1CategoryRef' => 'Support', 'hrl1Position' => 'Chief support', 'hrl1Grade' =>'8'],
        [ 'hrl1CategoryRef' => 'Support', 'hrl1Position' => 'Principal support', 'hrl1Grade' =>'7'],
        [ 'hrl1CategoryRef' => 'Support', 'hrl1Position' => 'Senior support', 'hrl1Grade' =>'6'],
        [ 'hrl1CategoryRef' => 'Support', 'hrl1Position' => 'Discipline support', 'hrl1Grade' =>'5'],
        [ 'hrl1CategoryRef' => 'Support', 'hrl1Position' => 'Associate support', 'hrl1Grade' =>'4'],
      ];

      // $records = [
      //   [ 'hrl1Category_id' => '1', 'hrl1Position' => 'Senior director', 'hrl1Grade' =>'12'],
      //   [ 'hrl1Category_id' => '1', 'hrl1Position' => 'Director', 'hrl1Grade' =>'11'],
      //   [ 'hrl1Category_id' => '1', 'hrl1Position' => 'Senior engineering manager', 'hrl1Grade' =>'11'],
      //   [ 'hrl1Category_id' => '1', 'hrl1Position' => 'Engineering manager', 'hrl1Grade' =>'10'],
      //   [ 'hrl1Category_id' => '2', 'hrl1Position' => 'Senior project manager', 'hrl1Grade' =>'11'],
      //   [ 'hrl1Category_id' => '2', 'hrl1Position' => 'Project manager', 'hrl1Grade' =>'10'],
      //   [ 'hrl1Category_id' => '2', 'hrl1Position' => 'Senior project engineer', 'hrl1Grade' =>'9'],
      //   [ 'hrl1Category_id' => '2', 'hrl1Position' => 'Project engineer', 'hrl1Grade' =>'8'],
      //   [ 'hrl1Category_id' => '3', 'hrl1Position' => 'Chief engineer', 'hrl1Grade' =>'10'],
      //   [ 'hrl1Category_id' => '3', 'hrl1Position' => 'Principal engineer', 'hrl1Grade' =>'9'],
      //   [ 'hrl1Category_id' => '3', 'hrl1Position' => 'Senior engineer', 'hrl1Grade' =>'8'],
      //   [ 'hrl1Category_id' => '3', 'hrl1Position' => 'Discipline engineer', 'hrl1Grade' =>'7'],
      //   [ 'hrl1Category_id' => '3', 'hrl1Position' => 'Associate engineer', 'hrl1Grade' =>'6'],
      //   [ 'hrl1Category_id' => '4', 'hrl1Position' => 'Chief designer', 'hrl1Grade' =>'9'],
      //   [ 'hrl1Category_id' => '4', 'hrl1Position' => 'Principal designer', 'hrl1Grade' =>'8'],
      //   [ 'hrl1Category_id' => '4', 'hrl1Position' => 'Senior designer', 'hrl1Grade' =>'7'],
      //   [ 'hrl1Category_id' => '4', 'hrl1Position' => 'Discipline designer', 'hrl1Grade' =>'6'],
      //   [ 'hrl1Category_id' => '4', 'hrl1Position' => 'Associate designer', 'hrl1Grade' =>'5'],
      //   [ 'hrl1Category_id' => '5', 'hrl1Position' => 'Chief support', 'hrl1Grade' =>'8'],
      //   [ 'hrl1Category_id' => '5', 'hrl1Position' => 'Principal support', 'hrl1Grade' =>'7'],
      //   [ 'hrl1Category_id' => '5', 'hrl1Position' => 'Senior support', 'hrl1Grade' =>'6'],
      //   [ 'hrl1Category_id' => '5', 'hrl1Position' => 'Discipline support', 'hrl1Grade' =>'5'],
      //   [ 'hrl1Category_id' => '5', 'hrl1Position' => 'Associate support', 'hrl1Grade' =>'4'],
      // ];

      // Insert data
      foreach($records as $record)
      {
        App\hrl1Position::create($record);
      }
    }
}

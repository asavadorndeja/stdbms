<?php

use Illuminate\Database\Seeder;

class hrl1CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $records = [
          ['id'=>1, 'hrl1Category' =>'Management1'],
          ['id'=>2, 'hrl1Category' =>'Management2'],
          ['id'=>3, 'hrl1Category' =>'Project management'],
          ['id'=>4, 'hrl1Category' =>'Professional'],
          ['id'=>5, 'hrl1Category' =>'Technical'],
          ['id'=>6, 'hrl1Category' =>'Support'],
        ];

        // Insert data
        foreach($records as $record)
        {
          App\hrl1Category::create($record);
        }
    }
}

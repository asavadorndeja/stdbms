<?php

use Illuminate\Database\Seeder;

class hrl1TableSeeder extends Seeder
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
          ['name' => 'C1601', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Pornpong', 'hrl1Lastname' => 'Asavadorndeja', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString()],
          ['name' => 'P1601', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Pina', 'hrl1Lastname' => 'Rujivipat', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString()],
          ['name' => 'P1603', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Panupong', 'hrl1Lastname' => 'Srivarangkul', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString()],
          ['name' => 'P1604', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Natthaphoom', 'hrl1Lastname' => 'Khumwongsakul', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString()],
          ['name' => 'P1605', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Niti', 'hrl1Lastname' => 'Sirkomron', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString()],
          ['name' => 'P1607', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Kris', 'hrl1Lastname' => 'Tantiwimonkit', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,6,1)->toDateTimeString()],
          ['name' => 'P1609', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Sasithorn', 'hrl1Lastname' => 'Jirapatamaporn', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString()],
          ['name' => 'P1702', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Bhassakorn', 'hrl1Lastname' => 'Nakaracha', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,6,1)->toDateTimeString()],
          ['name' => 'P1703', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Wittawat', 'hrl1Lastname' => 'Tueyot', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,7,3)->toDateTimeString()],
          ['name' => 'P1704', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Napath', 'hrl1Lastname' => 'Ruamchomrat', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,8,1)->toDateTimeString()],
          ['name' => 'P1705', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Thepnakorn', 'hrl1Lastname' => 'Suttara', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,8,21)->toDateTimeString()],
          ['name' => 'P1801', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Nattapong', 'hrl1Lastname' => 'Tantisuwitkul', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2018,2,5)->toDateTimeString()],
          ['name' => 'P1802', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Neti', 'hrl1Lastname' => 'Sakunpanich', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2018,6,18)->toDateTimeString()],
        ];

        // Insert data
        foreach($records as $record)
        {
          App\hrl1::create($record);
        }
    }
}

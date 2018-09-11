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

          ['name' => 'C1601', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Pornpong', 'hrl1Lastname' => 'Asavadorndeja', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString(), 'hrl1Role1' => 'Managing director', 'hrl1Role2' => 'Tender manager', 'hrl1Discipline' => 'Geotechincal engineering', 'hrl1Category' => 'Management 1', 'hrl1Grade' => 11, 'hrl1Position' => 'Director'],
          ['name' => 'P1601', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Pina', 'hrl1Lastname' => 'Rujivipat', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString(), 'hrl1Role1' => 'Engineering manager', 'hrl1Role2' => 'Senior engineer', 'hrl1Discipline' => 'Geotechincal engineering', 'hrl1Category' => 'Management 2', 'hrl1Grade' => 10, 'hrl1Position' => 'Engineering manager'],
          ['name' => 'P1602', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Methi', 'hrl1Lastname' => 'Assavinvipart', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString(), 'hrl1DateEnd' => \Carbon\Carbon::createFromDate(2017,5,20)->toDateTimeString(), 'hrl1Role1' => 'Senior engineer', 'hrl1Discipline' => 'Structural engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 8, 'hrl1Position' => 'Senior engineer'],
          ['name' => 'P1603', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Panupong', 'hrl1Lastname' => 'Srivarangkul', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString(), 'hrl1Role1' => 'Discipline engineer', 'hrl1Role2' => 'IT Manager', 'hrl1Discipline' => 'Pipeline engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Discipline engineer'],
          ['name' => 'P1604', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Natthaphoom', 'hrl1Lastname' => 'Khumwongsakul', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString(), 'hrl1Role1' => 'Senior engineer', 'hrl1Discipline' => 'Pipeline engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 8, 'hrl1Position' => 'Senior engineer'],
          ['name' => 'P1605', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Niti', 'hrl1Lastname' => 'Sirkomron', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString(), 'hrl1Role1' => 'Senior designer', 'hrl1Discipline' => 'Designer', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Senior designer'],
          ['name' => 'P1606', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Panyawat', 'hrl1Lastname' => 'Pueksap-anan', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,8,9)->toDateTimeString(), 'hrl1DateEnd' => \Carbon\Carbon::createFromDate(2017,1,27)->toDateTimeString(), 'hrl1Role1' => 'Senior engineer', 'hrl1Discipline' => 'Structural engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 8, 'hrl1Position' => 'Senior engineer'],
          ['name' => 'P1607', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Kris', 'hrl1Lastname' => 'Tantiwimonkit', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,6,1)->toDateTimeString(), 'hrl1Role1' => 'Senior engineer', 'hrl1Discipline' => 'Pipeline engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 8, 'hrl1Position' => 'Senior engineer'],
          ['name' => 'P1608', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Thitapan', 'hrl1Lastname' => 'Chantachot', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,12,1)->toDateTimeString(), 'hrl1DateEnd' => \Carbon\Carbon::createFromDate(2017,8,31)->toDateTimeString(), 'hrl1Role1' => 'Discipline engineer', 'hrl1Discipline' => 'Geotechincal engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Discipline engineer'],
          ['name' => 'P1609', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Sasithorn', 'hrl1Lastname' => 'Jirapatamaporn', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2016,1,1)->toDateTimeString(), 'hrl1Category' => 'Support', 'hrl1Grade' => 7, 'hrl1Position' => 'Principal support'],
          ['name' => 'C1701', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Nattapat', 'hrl1Lastname' => 'Wongpakdee', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,7,11)->toDateTimeString(), 'hrl1DateEnd' => \Carbon\Carbon::createFromDate(2017,11,30)->toDateTimeString(), 'hrl1Role1' => 'Discipline engineer', 'hrl1Discipline' => 'Structural engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Discipline engineer'],
          ['name' => 'P1701', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Chana', 'hrl1Lastname' => 'Ssinsabvarodom', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,3,1)->toDateTimeString(), 'hrl1DateEnd' => \Carbon\Carbon::createFromDate(2017,5,26)->toDateTimeString(), 'hrl1Role1' => 'Discipline engineer', 'hrl1Discipline' => 'Structural engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Discipline engineer'],
          ['name' => 'P1702', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Bhassakorn', 'hrl1Lastname' => 'Nakaracha', 'hrl1Supervisor' => 'C1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,6,1)->toDateTimeString(), 'hrl1Role1' => 'Document controller', 'hrl1Role2' => 'Safety manager', 'hrl1Category' => 'Support', 'hrl1Grade' => 6, 'hrl1Position' => 'Senior support'],
          ['name' => 'P1703', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Wittawat', 'hrl1Lastname' => 'Tueyot', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,7,3)->toDateTimeString(), 'hrl1Role1' => 'Associate engineer', 'hrl1Role2' => 'Quality officer', 'hrl1Discipline' => 'Pipeline engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 6, 'hrl1Position' => 'Associate engineer'],
          ['name' => 'P1704', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Napath', 'hrl1Lastname' => 'Ruamchomrat', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,8,1)->toDateTimeString(), 'hrl1Role1' => 'Discipline engineer', 'hrl1Role2' => 'Quality manager', 'hrl1Discipline' => 'Structural engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Discipline engineer'],
          ['name' => 'P1705', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Thepnakorn', 'hrl1Lastname' => 'Suttara', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2017,8,21)->toDateTimeString(), 'hrl1Role1' => 'Senior engineer', 'hrl1Discipline' => 'Structural engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 8, 'hrl1Position' => 'Senior engineer'],
          ['name' => 'P1801', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Nattapong', 'hrl1Lastname' => 'Tantisuwitkul', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2018,2,5)->toDateTimeString(), 'hrl1Role1' => 'Tender engineer', 'hrl1Role2' => 'Outsource manager', 'hrl1Discipline' => 'Pipeline engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Discipline engineer'],
          ['name' => 'P1802', 'create_by' => 'SYSTEM', 'hrl1FirstName' => 'Neti', 'hrl1Lastname' => 'Sakunpanich', 'hrl1Supervisor' => 'P1601', 'hrl1DateStart' => \Carbon\Carbon::createFromDate(2018,6,18)->toDateTimeString(), 'hrl1Role1' => 'Discipline engineer', 'hrl1Role2' => 'Safety officer', 'hrl1Discipline' => 'Geotechincal engineering', 'hrl1Category' => 'Professional', 'hrl1Grade' => 7, 'hrl1Position' => 'Discipline engineer'],


        ];

        // Insert data
        foreach($records as $record)
        {
          App\hrl1::create($record);
        }
    }
}

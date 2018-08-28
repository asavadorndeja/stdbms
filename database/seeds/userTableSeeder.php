<?php

use Illuminate\Database\Seeder;


class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Create dataset
      $records = [
        ['name' => 'C1601', 'email' => 'p.asavadorndeja@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 2, 'userAD' => 2, 'userTE' => 2, 'userPE' => 2, 'userOU' => 2, 'userDC' => 2, 'userHS' => 2, 'userHR' => 2, 'userMM' => 2, 'userQA' => 2],
        ['name' => 'P1601', 'email' => 'p.rujivipat@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 2, 'userMM' => 2, 'userQA' => 1],
        ['name' => 'P1603', 'email' => 'p.srivarangkul@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 2, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1604', 'email' => 'n.khumwongsakul@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1605', 'email' => 'n.sirkomron@syntera.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1607', 'email' => 'k.tantiwimonkit@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1609', 'email' => 's.jirapatamaporn@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1702', 'email' => 'b.nakaracha@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 2, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1703', 'email' => 'w.tueyot@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 2, 'userQA' => 1],
        ['name' => 'P1704', 'email' => 'n.ruamchomrat@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1705', 'email' => 't.suttara@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1801', 'email' => 'n.tantisuwitkul@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
        ['name' => 'P1802', 'email' => 'n.sakunphanich@synterra.co.th', 'password' => bcrypt(1234), 'userUser' => 1, 'userAD' => 1, 'userTE' => 1, 'userPE' => 1, 'userOU' => 1, 'userDC' => 1, 'userHS' => 1, 'userHR' => 1, 'userMM' => 1, 'userQA' => 1],
      ];

      // Insert data
      foreach($records as $record)
      {
        App\User::create($record);
      }
    }
}

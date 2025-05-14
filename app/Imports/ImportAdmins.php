<?php

namespace App\Imports;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportAdmins implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return Model|null
    */
   public function collection(Collection $rows)
    {        
        foreach($rows as $row){ 
        if(!Admin::where('email',$row['email'])->exists()){
            Admin::create([
                'status'=>1,
                'surname' => $row['surname'],
                'firstname' => $row['firstname'],
                'othername' => $row['othername'],                
                'email' => $row['email'],
                'mobile'=>$row['mobile'],
                'password' => Hash::make($row['password'])
            ]);
           } ## end if
        } ## end foreach
    }
   
    ## to use heading row instead of column numbers
    ## use this class 
    /**
      class UsersImport implements ToModel, WithHeadingRow
      {
        ...
      } **/
    
    ## if the heading row did not start at the first row
    ## use the below funcion to specify where it started
     public function headingRow(): int     
     {
         return 1;
     }
     
}


/**
 *  for batch insert
 */

/**
 * namespace App\Imports;

    use App\User;
    use Maatwebsite\Excel\Concerns\ToModel;
    use Maatwebsite\Excel\Concerns\WithBatchInserts;

    class UsersImport implements ToModel, WithBatchInserts
    {
        public function model(array $row)
        {
            return new User([
                'name' => $row[0],
            ]);
        }

        public function batchSize(): int
        {
            return 1000;
        }
    }
 */
<?php

namespace App\Imports;

use App\StudentInfo;
use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersParentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user =new User([
            'name' =>$row['name'],
            'email'=>$row['username'],
            'password'=>Hash::make($row['password']),
            'role'=>4
        ]);
        $user->save();

        StudentInfo::create(['user_id'=>$user->id]);

        return $user;

    }
}

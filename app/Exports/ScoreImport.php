<?php

namespace App\Exports;

use App\Module;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScoreImport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $a=array();
        $b=User::select('name')->get();
        array_push($a,$b);
        $c=Module::select('title')->get();
        array_push($a,$c);
        return collect($a);
    }
}

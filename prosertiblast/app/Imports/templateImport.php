<?php

namespace App\Imports;

use App\Models\templatemsg;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class templateImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!templatemsg::where('voucher_code','=',$row[3])->exists() || !templatemsg::where('tema','=',$row[4])->exists() || !templatemsg::where('email','=',$row[2])->exists()){
            return new templatemsg([
                //
                'noreg' => $row[0],
                'nama' => $row[1],
                'email'=>$row[2],
                'voucher_code'=>$row[3],
                'tema'=>$row[4]
            ]);
        }
    }
}

<?php

namespace App\Imports;

use App\Models\pesertaproa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!pesertaproa::where('email','=',$row[1])->exists() || !pesertaproa::where('notelp','=',$row[2])->exists() || !pesertaproa::where('kelaspelatihan','=',$row[3])->exists()){
            return new pesertaproa([
                //
                'namapeserta' => $row[0],
                'email'=>$row[1],
                'notelp'=>$row[2],
                'kelaspelatihan'=>$row[3]
            ]);
        }
    }
}

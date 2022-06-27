<?php

namespace App\Imports;

use App\Models\pesertaproa;
use Maatwebsite\Excel\Concerns\ToModel;

class pesertaimport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new pesertaproa([
            //
           'namapeserta' => $row[0],
            'email'=>$row[1],
            'notelp'=>$row[2],
            'kelaspelatihan'=>$row[3]
        ]);
    }
}

<?php

namespace App\Imports;

use App\Models\Vehicule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VehiculeImport implements ToCollection, WithHeadingRow
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if ($row[0] != null)
                Vehicule::create([
                    'code'              => $row[0],
                    'immatriculation'   => $row[1],
                    'modele'            => $row[2],
                    'acquisition'       => $row[3],
                    'idcateg'           => $row[4],
                    'idChauf'           => $row[5],
                    'idPool'            => $row[6],
                ]);
        }
    }
}

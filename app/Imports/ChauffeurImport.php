<?php

namespace App\Imports;

use App\Models\Chauffeur;
use App\Models\Vehicule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChauffeurImport implements ToCollection
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $v = Chauffeur::where('matricule', $row[0])
                ->orWhere('email', $row[4],)
                ->orWhere('telephone', $row[5],)->get();

            if ($row[0] != null && $v == null)
                Chauffeur::create([
                    'matricule'     => $row[0],
                    'nom'           => $row[1],
                    'prenom'        => $row[2],
                    'email'         => $row[4],
                    'telephone'     => $row[5],
                    'idPool'        => $row[6],
                ]);
        }
    }
}

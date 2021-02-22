<?php

namespace App\Imports;

use App\Models\Agent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgentImport implements ToCollection
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            $v = Agent::where('matricule', $row[0])
                ->orWhere('email', $row[5],)
                ->orWhere('telephone', $row[6],)->get();

            if ($row[0] != null && $v == null)
                Agent::create([
                    'matricule'     => $row[0],
                    'nom'           => $row[1],
                    'prenom'        => $row[2],
                    'poste'         => $row[3],
                    'idcateg'       => $row[4],
                    'email'         => $row[5],
                    'telephone'     => $row[6],
                ]);
        }
    }
}

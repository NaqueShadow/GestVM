<?php

namespace App\Exports;

use App\Attribution;
use Jenssegers\Date\Date;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class AttributionExport implements FromArray, WithStyles
{
    public $a, $b;
    public function __construct(Date $a, Date $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function array(): array
    {
        $attributions = \App\Models\Attribution::with('mission', 'entite', 'ressource', 'chauffeur')
            ->whereHas('mission', function ($query) {
                $query->whereBetween('dateDepart', [$this->a, $this->b]);
            })->get();

        $data[] = ["Utilisateur","Conducteur","Vehicule","Date","Trajet","Qte Carburant","Compteur depart","compteur retour","Km parcourus"];
        foreach ($attributions as $attr)
            $data[] = [
                $attr->entite->designation,
                $attr->chauffeur->nom.' '.$attr->chauffeur->prenom,
                $attr->idVehicule,
                $attr->mission->dateDepart->format('d M').'-'.$attr->mission->dateRetour->format('d M Y'),
                $attr->mission->villeDep->nom.'-'.$attr->mission->villeDesti->nom,
                isset($attr->ressource->carburant) ? $attr->ressource->carburant:'0',
                isset($attr->ressource->comptDepart) ? $attr->ressource->comptDepart:'0',
                isset($attr->ressource->comptRetour) ? $attr->ressource->comptRetour:'0',
                isset($attr->ressource->comptRetour) ? ($attr->ressource->comptRetour - $attr->ressource->comptDepart):'0',
            ];
        return $data;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Première ligne en gras
            1    => ['font' => ['bold' => true]],

            // Styling a specific cell by coordinate.
            'B2' => ['font' => ['italic' => true]],
        ];
    }
}

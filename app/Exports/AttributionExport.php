<?php

namespace App\Exports;

use App\Models\Attribution;
use Jenssegers\Date\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttributionExport implements FromArray, WithStyles, ShouldAutoSize, WithHeadings
{
    use Exportable;
    public $a, $b;
    public function __construct(Date $a, Date $b)
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function headings(): array {
        return [
            "#",
            "Utilisateur",
            "Conducteur",
            "Véhicule",
            "Date",
            "Trajet",
            "Qte Carburant",
            "Compteur départ",
            "compteur retour",
            "Km parcourus"
        ];

    }

    public function array(): array
    {
        $attributions = Attribution::with('mission', 'entite', 'ressource', 'chauffeur')
            ->whereHas('mission', function ($query) {
                $query->whereBetween('dateDepart', [$this->a, $this->b]);
            })->get();

        $i=0;
        foreach ($attributions as $attr)
            $data[] = [
                ++$i,
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
            1    => [
                'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => '000000']],
                'fill' => ['color' => ['argb' => 'FF00FF00']],
            ],

        ];
    }
}

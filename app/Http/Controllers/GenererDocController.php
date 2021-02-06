<?php

namespace App\Http\Controllers;

use App\Models\Attribution;
use App\Models\Mission;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class GenererDocController extends Controller
{
    public function __construct()
    {
        //
    }

    public function demandePDF(Request $request, Mission $mission)
    {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('etatsVues.demandePDF', compact('mission'));
        return $pdf->stream('gestvm-demande_vehicule_'.$mission->id.'.pdf');
    }

    public function attrPDF (Request $request, Attribution $attribution)
    {
        PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('etatsVues.attributionPDF', compact('attribution'));
        return $pdf->stream('gestvm-attribution_vehicule_'.$attribution->id.'.pdf');
    }
}

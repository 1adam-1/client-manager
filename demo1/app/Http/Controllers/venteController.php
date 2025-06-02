<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class venteController extends Controller
{
    public function detailsVentes(){
        $ventes=Vente::all();
        return view('pages.ventes.show',compact('ventes'));
    }

    public function detailsVentesDate($start,$end){

        $monthlyVentesData = DB::table('ventes')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
        ->whereBetween(DB::raw('DATE(created_at)'), [$start, $end])
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy(DB::raw('DATE(created_at)'), 'ASC')
        ->get();

        $monthlyDates = [];
        $monthlyCounts = [];
        foreach ($monthlyVentesData as $data) {
            $monthlyDates[] = $data->date;
            $monthlyCounts[] = $data->count;
        }
        
        $ventes=Vente::all();
        return view('pages.ventes.show',compact('ventes'));
    }

}

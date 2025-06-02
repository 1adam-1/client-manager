<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;

class dashboardController extends Controller
{
    public function showDashboard()
    {
        $user = Auth::user();
        
        // Get the current year data
        $currentYear = Carbon::now()->year;

        $totalClientsPerMonth = Client::selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as total_clients')
        ->whereYear('updated_at', $currentYear)
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->toArray();

    $totalClientsData = [];
    $totalClientsCounts = [];
    foreach ($totalClientsPerMonth as $data) {
        $totalClientsData[] = $data['year'] . '-' . str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $totalClientsCounts[] = $data['total_clients'];
    }

        // Get the number of active clients per month
        $activeClientsPerMonth = Client::selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as active_clients')
            ->where('nbScan', '>', 20)
            ->whereYear('updated_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->toArray();

            $totalActive=Client::where('nbScan','>',20)->count();

        // Get the number of inactive clients per month
        $inactiveClientsPerMonth = Client::selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as inactive_clients')
            ->where('nbScan', '<', 20)
            ->whereYear('updated_at', $currentYear)
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->toArray();

            $totalInactive=Client::where('nbScan','<',20)->count();

            $ventesData = DB::table('ventes')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->groupBy('year')
            ->orderBy('year', 'ASC')
            ->get();

            $dates = [];
            $counts = [];
            foreach ($ventesData as $data) {
                $dates[] = $data->year;
                $counts[] = $data->count;
            }

            $commandesConfirme = DB::table('commandes')
            ->select(DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('statut','confirmée')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

            $monthlyDates = [];
            $monthlyCounts = [];
            foreach ($commandesConfirme as $data) {
                $monthlyDates[] = $data->date;
                $monthlyCounts[] = $data->count;
            }

            $commandesEnAttente = DB::table('commandes')
            ->select(DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->where('statut','en attente')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

            $monthlycommandesEnAttenteDates = [];
            $monthlycommandesEnAttenteCounts = [];
            foreach ($commandesEnAttente as $data) {
                $monthlycommandesEnAttenteDates[] = $data->date;
                $monthlycommandesEnAttenteCounts[] = $data->count;
            }

    $revenueData = Commande::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(prix) as total_revenue')
    ->whereYear('created_at', $currentYear)
    ->groupBy('year', 'month')
    ->orderBy('year')
    ->orderBy('month')
    ->get()
    ->toArray();

    $revenueDates = [];
    $revenueCounts = [];
    foreach ($revenueData as $data) {
        $revenueDates[] = $data['year'] . '-' . str_pad($data['month'], 2, '0', STR_PAD_LEFT);
        $revenueCounts[] = $data['total_revenue'];
    }

    return view('dashboard', compact('totalClientsCounts','totalClientsData',
                                    'totalActive','totalInactive',
                                    'activeClientsPerMonth',
                                    'inactiveClientsPerMonth',
                                    'dates', 'counts','monthlyDates',
                                    'monthlyCounts',
                                    'monthlycommandesEnAttenteDates',
                                    'monthlycommandesEnAttenteCounts',
                                    'revenueDates','revenueCounts'));
    }

    public function sortedClients($token){
        if($token==1){
            $clients = Client::where('nbScan', '>', 20)->get();
        return view('pages.clients.showClient',compact('clients'));
    }else{
        $clients = Client::where('nbScan', '<', 20)->get();
        return view('pages.clients.showClient',compact('clients'));
    }
    }

    public function filteredDashboard(Request $request)
{
     // Get the current year data
     $currentYear = Carbon::now()->year;

     $totalClientsPerMonth = Client::selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as total_clients')
     ->whereYear('updated_at', $currentYear)
     ->groupBy('year', 'month')
     ->orderBy('year')
     ->orderBy('month')
     ->get()
     ->toArray();

    $totalClientsData = [];
    $totalClientsCounts = [];
    foreach ($totalClientsPerMonth as $data) {
     $totalClientsData[] = $data['year'] . '-' . str_pad($data['month'], 2, '0', STR_PAD_LEFT);
     $totalClientsCounts[] = $data['total_clients'];
 }

    $start = $request->startDate;
    $end = $request->endDate;

    // Active Clients Per Month
    $activeClientsPerMonth = Client::selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as active_clients')
        ->where('nbScan', '>', 20)
        ->whereBetween('updated_at', [$start, $end])
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->toArray();

    // Total Active Clients
    $totalActive = Client::where('nbScan', '>', 20)
        ->whereBetween('updated_at', [$start, $end])
        ->count();

    // Inactive Clients Per Month
    $inactiveClientsPerMonth = Client::selectRaw('YEAR(updated_at) as year, MONTH(updated_at) as month, COUNT(*) as inactive_clients')
        ->where('nbScan', '<', 20)
        ->whereBetween('updated_at', [$start, $end])
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get()
        ->toArray();

    // Total Inactive Clients
    $totalInactive = Client::where('nbScan', '<', 20)
        ->whereBetween('updated_at', [$start, $end])
        ->count();

    // Total Sales Data
    $ventesData = DB::table('ventes')
        ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
        ->groupBy('year')
        ->orderBy('year', 'ASC')
        ->get();

    $dates = [];
    $counts = [];
    foreach ($ventesData as $data) {
        $dates[] = $data->year;
        $counts[] = $data->count;
    }


    $commandesConfirme = DB::table('commandes')
    ->select(DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as count'))
    ->whereBetween(DB::raw('DATE(created_at)'), [$start, $end])
    ->where('statut','confirmée')
    ->groupBy('date')
    ->orderBy('date', 'ASC')
    ->get();

    $monthlyDates = [];
    $monthlyCounts = [];
    foreach ($commandesConfirme as $data) {
        $monthlyDates[] = $data->date;
        $monthlyCounts[] = $data->count;
    }

    $commandesEnAttente = DB::table('commandes')
    ->select(DB::raw('Date(created_at) as date'), DB::raw('COUNT(*) as count'))
    ->whereBetween(DB::raw('DATE(created_at)'), [$start, $end])
    ->where('statut','en attente')
    ->groupBy('date')
    ->orderBy('date', 'ASC')
    ->get();

    $monthlycommandesEnAttenteDates = [];
    $monthlycommandesEnAttenteCounts = [];
    foreach ($commandesEnAttente as $data) {
        $monthlycommandesEnAttenteDates[] = $data->date;
        $monthlycommandesEnAttenteCounts[] = $data->count;
    }

    return view('dashboard', compact('totalClientsCounts','totalClientsData',
                                    'totalActive','totalInactive',
                                     'activeClientsPerMonth',
                                      'inactiveClientsPerMonth',
                                       'dates', 'counts','monthlyDates',
                                       'monthlyCounts',
                                    'monthlycommandesEnAttenteDates',
                                'monthlycommandesEnAttenteCounts'));
}




}

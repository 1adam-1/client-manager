<?php

namespace App\Http\Controllers;

use App\Models\airlodAvis;
use App\Models\Client;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;

class commandeController extends Controller
{
    public function showCommande($id)
{
    $client = Client::find($id);

    $commandes = Commande::where('id_client', $client->generated_id)
                            ->with('produit')
                            ->get();

    return view('pages.commandes.showDetails', compact('commandes','client'));
}

public function showCommandeAirlodAvis($id)
{
    $client = airlodAvis::find($id);

    $commandes = Commande::where('id_client', $client->generated_id)
                            ->with('produit')
                            ->get();

    return view('pages.commandes.show', compact('commandes','client'));
}

public function detailsCommandes($token)
{
    $commandes=NULL;

    if($token==1){
    $commandes = Commande::where('statut', 'confirmée')
        ->with('produit')
        ->get();
    }

        else{
            $commandes = Commande::where('statut', 'en attente')
                ->with('produit')
                ->get();
        }

        return view('pages.commandes.showDetails',compact('commandes'));

}

public function confirm($id){
    // Find the client
    $client = Client::find($id);

    if (!$client) {
        return redirect()->back()->with('error', 'Client non trouvé.');
    }

    // Get all the client's orders that are not confirmed
    $commandes = Commande::where('id_client', $client->generated_id)
        ->where('statut', 'en attente') // Only update pending orders
        ->get();

    if ($commandes->isEmpty()) {
        return redirect()->back()->with('error', 'Aucune commande en attente pour ce client.');
    }

    // Update each order to "confirmée"
    foreach ($commandes as $commande) {
        $commande->statut = 'confirmée';
        $commande->save();
    }

    return redirect()->back()->with('success', 'Les commandes du client ont été confirmées avec succès.');


}

}

<?php
namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Client;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class clientController extends Controller
{
    public function showForm(){
        $statues = [
            'Contact Initial',
            'Intérêt Manifesté',
            'Objection Prix',
            'Option Affiliation',
            'Négociation en Cours',
            'confirmation en attente',
            'attente logo',
            'design en cours',
            'design approuvé',
            'commande confirmé',
            'attente de production',
            'paiement en attente',
            'ramassage en cours',
            'commande expédiée',
            'première relance',
            'seconde relance',
            'livrée',
            'indisponibilité temporaire',
            'contact injoignable',
            'mauvaise cible',
            'confirmé',
            'application',
            'airlod avis intéret'
        ];
        $campagnes=[
            'Vd 1 Boite carte',
            'Vd 2 Airlod',
            'Vd 3 Airlod carte transparente'];

        $sources=[
            "whatsapp",
            "instagram",
            "site web",
            "landing page",
            "google ads",
            "linkedin",
            "commercial",
            "tik tok",
            "COD network",
            "affiliation",
        ];


        $lastClient = Client::orderByRaw('CAST(SUBSTR(generated_id, 3) AS UNSIGNED) DESC')->first();
        $nextNumber = $lastClient !== null ? intval(substr($lastClient->generated_id, 2)) + 1 : 1;

            $products=Produit::all();

        return view('pages.clients.addClient',compact('statues','campagnes','products','sources','nextNumber'));
    }

    public function createClient(Request $request) {
        $request->validate([
            'email' => 'email|unique:clients,email|nullable',
            'nomcomplet' => 'required',
            'source' => 'required',
            'num' => 'required',
            'campagnePub' => 'required',
        ], [
            'nomcomplet.required' => 'The full name field is required.',
            'source.required' => 'The source field is required.',
            'num.required' => 'The number field is required.',
            'campagnePub.required' => 'The campaign field is required.',
        ]);

        // Save the client
        $client = new Client();
        $client->solution = 'Airlod';
        $client->nomComplet = $request->nomcomplet;
        $client->email = $request->email;
        $client->choixProduit = $request->choixProduit;
        $client->domaineActivite = $request->domaineActivite;
        $client->adresse = $request->adresse;
        $client->source = $request->source;
        $client->num = $request->num;
        $client->campagnePub = $request->campagnePub;
        $client->entreprise = $request->entreprise;
        $client->notes = $request->notes;
        $client->statut = $request->statut;
        $client->facture = $request->facture;
        $client->nbScan = 40;
        $client->save();

        // Process selected products
        if ($request->has('selectedProducts')) {
            $selectedProducts = $request->input('selectedProducts');

            // Reorganize and process the selected products
            $structuredProducts = [];
            for ($i = 0; $i < count($selectedProducts); $i += 3) {
                $product_id = $selectedProducts[$i]['product_id'] ?? null;
                $quantity = $selectedProducts[$i + 1]['quantity'] ?? null;
                $color = $selectedProducts[$i + 2]['color'] ?? null;
                if ($product_id && $quantity && $color) {
                    $structuredProducts[] = [
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                        'color' => $color,
                    ];
                }
            }

            $lastId = Commande::max('id');
            $newId = $lastId ? $lastId + 1 : 1;

            foreach ($structuredProducts as $product) {
                $commande = new Commande();
                $commande->list_id=$newId;
                $commande->id_client = $client->generated_id;
                $commande->id_produit = $product['product_id'];
                $commande->quantite = $product['quantity'];
                $commande->couleur = $product['color'];
                $commande->statut="en attente";
                $productData = Produit::find($product['product_id']);
                $commande->prix = $productData->prix * $product['quantity'];

                if (empty($request->file('logo'))) {
                    $commande->type = "classique";
                }else{
                    $commande->type = "personnalisée";
                }

                $commande->save();
            }
        }

        return to_route('showForm')->with('success', 'Registration successful!');
    }


    public function affich() {
        $clients = Client::all();
        return view('pages.clients.showClient', compact('clients'));
    }



    public function searchClient(Request $request) {
        $query = Client::query();

        if ($request->filled('id')) {
            $query->where('generated_id', $request->id);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }

        $clients = $query->get();

        return view('pages.clients.showClient', compact('clients'));
    }

    public function showUpdate($id){
        $statues = [
            'Contact Initial',
            'Intérêt Manifesté',
            'Objection Prix',
            'Option Affiliation',
            'Négociation en Cours',
            'confirmation en attente',
            'attente logo',
            'design en cours',
            'design approuvé',
            'commande confirmé',
            'attente de production',
            'paiement en attente',
            'ramassage en cours',
            'commande expédiée',
            'première relance',
            'seconde relance',
            'livrée',
            'indisponibilité temporaire',
            'contact injoignable',
            'mauvaise cible',
            'confirmé',
            'application',
            'airlod avis intéret'
        ];
        $campagnes=[
            'Vd 1 Boite carte',
            'Vd 2 Airlod',
            'Vd 3 Airlod carte transparente'];
        $client=client::find($id);
        return view('pages.clients.updateClient',compact('client','statues','campagnes'));
    }

    public function updateClient(Request $request,$id){

        $request->validate([
            'nomcomplet'=>'required',
            'num' => 'required',
        ], [

            'nomcomplet.required' => 'The full name field is required.',
            'num.required' => 'The number field is required.',
        ]);

        $client=client::find($id);
        $client->nomComplet = $request->nomcomplet;
        $client->email = $request->email;
        $client->num = $request->num;
        $client->statut = $request->statut;
        $client->save();

        return to_route('affich')->with('success', ' informations updated !');
    }

    public function deleteClient($id )
{
    $client = Client::find($id);
    $client->delete();
    return to_route('affich')->with('success','Client deleted !');
}

public function facture (){
    $clients = Client::all();
    return view('pages.clients.facture', compact('clients'));

}

public function infosFacture(){
return view('pages.clients.infosFacture');

}


}

?>

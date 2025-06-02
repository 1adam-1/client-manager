<?php
namespace App\Http\Controllers;

use App\Models\airlodAvis;
use App\Models\Commande;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AirlodAvisController extends Controller
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
        $campagnes = [
            'Vd 1 Boite carte',
            'Vd 2 Airlod',
            'Vd 3 Airlod carte transparente'
        ];
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

        $lastClientId = airlodAvis::latest()->first();
        $nextNumber = $lastClientId !== null ? intval(substr($lastClientId->generated_id, 2)) + 1 : 0;
        $products=Produit::all();

        return view('pages.airlodAvis.addClient', compact('statues', 'campagnes','sources','products','nextNumber'));
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
        $client = new airlodAvis();
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
                }
    
                $commande->save();
            }
        }
    
        return to_route('showFormAirlodAvis')->with('success', 'Registration successful!');
    }

    public function affich() {
        $clients = airlodAvis::all();
        return view('pages.airlodAvis.showClient', compact('clients'));
    }

    public function searchClient(Request $request) {
        $query = airlodAvis::query();
    
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
    
        return view('pages.airlodAvis.showClient', compact('clients'));
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
        $campagnes = [
            'Vd 1 Boite carte',
            'Vd 2 Airlod',
            'Vd 3 Airlod carte transparente'
        ];
        $client = airlodAvis::find($id);
        return view('pages.airlodAvis.updateClient', compact('client', 'statues', 'campagnes'));
    }

    public function updateClient(Request $request, $id){
        $request->validate([
            'email' => 'email|unique:airlod_avis,email|nullable', 
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

        $client = airlodAvis::find($id);
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
        $client->save();

        return to_route('affichAirlodAvis')->with('success', 'Information updated!');
    }

    public function deleteClient($id) {   
        $client = airlodAvis::find($id);
        $client->delete();
        return to_route('affichAirlodAvis')->with('success', 'Client deleted!');
    }

    public function facture(){
        $clients = airlodAvis::all();
        return view('pages.airlodAvis.facture', compact('clients'));
    }
}

?>

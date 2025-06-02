<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function showProducts(){
        $products=Produit::all();      
        return view('pages.products.store',compact('products'));

    }

    public function addProduct(){
        return view('pages.products.add');
    }


    public function createProduct(Request $request){

        $request->validate([
            'nom'=>'required',
            'prix'=>'required',
            'image'=>'required',
        ]);

        $product=new Produit();
        $product->nom=$request->nom;
        $product->description=$request->description;
        $product->prix=$request->prix;
        $product->type="";
        $file = $request->file('image');
        $fileName =$file->getClientOriginalName();
        $path = $file->storeAs('products', $fileName, 'public');
        $product->image = '/storage/' . $path;
        $product->save();

return to_route('addProduct')->with('success','Product added !');

    }

    
    public function showProduct($id){
        $product=Produit::find($id);
        $query=Produit::query();
        $name=substr($product->nom, 0, 5);
        $query->where('nom','like', '%' . $name. '%')->where('id', '!=', $id);
        $similar=$query->get();
        return view('pages.products.showProduct',compact('product','similar'));
    }

    public function searchProduct(Request $request){
        $query=Produit::query();
        $query->where('nom', 'like', '%' . $request->nom . '%');
        $query->orderBy('prix', 'asc');
        $products=$query->get();
        return view('pages.products.store',compact('products'));
    }

    public function addToCart(Request $request, $id)
{
    $product = Produit::findOrFail($id);

    $cart = session()->get('cart', []);

    $price = ($request->options == 'classique') ? $product->prix : $product->prix + 100;

    $cart[$product->id] = [
        'id' => $product->id,
        'name' => $product->nom,
        'price' => $price,
        'quantity' => isset($cart[$product->id]['quantity']) ? $cart[$product->id]['quantity'] + 1 : 1,
    ];

    session()->put('cart', $cart);                                                                                    

    return redirect()->route('showProduct', ['id' => $product->id])->with('success', 'Product added to cart successfully.');
}


public function showCart()
{
    $cart = session()->get('cart', []);

    return view('pages.products.cart', compact('cart'));
}

public function deleteCart($id){

    $cart = session()->get('cart', []);
    if($cart[$id]['quantity']>1){
        $cart[$id]['quantity']=$cart[$id]['quantity']-1;
    }else{
        unset($cart[$id]); 
    }
    
    session()->put('cart', $cart);

    return redirect()->route('showCart')->with('success', 'Item removed from cart.');

}

public function checkout()
{
    // Get the cart from session
    $cart = session()->get('cart', []);

    // Calculate the total
    $total = array_reduce($cart, function ($carry, $item) {
        return $carry + ($item['price'] * $item['quantity']);
    }, 0);

    // Pass the cart and total to the view
    return view('pages.products.checkout', compact('cart', 'total'));
}

}

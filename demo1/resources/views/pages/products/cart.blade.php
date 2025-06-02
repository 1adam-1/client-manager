@extends('layout.master4')

@section('content')

<main class="container mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              @if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif

    <div style="background-color: white; height: 7em; display: flex; justify-content: center; align-items: center;">
        <h1>Boutique - Airlod</h1>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1 style="font-size: 2.5rem; color: black;">Shopping Cart</h1>
                    @if(!empty(count($cart)))
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Quantité</th>
                                    <th>Sous-Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $total=0;
                                @endphp
                                @foreach($cart as $item)
                                <tr>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['price'] }} DHS</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ $item['price'] * $item['quantity'] }} DHS</td>
                                    <td>  
                                        <form action="{{ route('deleteCart',['id'=>$item['id']]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                        <button type="submit" style="color:black"><i class="link-icon" data-feather="delete"></i></button> 
                                        </form>
                                    </td>
                                </tr>
                                @php
                                        $total += $item['price'] * $item['quantity'];
                                    @endphp
                                @endforeach
                                <tr> 

                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td>  {{ $total }} Dhs     </td>

                                </tr>
                                
                            </tbody>
                        </table>
                    @else
                        <p>Your cart is empty.</p>
                    @endif
                    <hr>
                    <a href="{{route ('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

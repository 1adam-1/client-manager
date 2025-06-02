@extends('layout.master3')

@section('content')
@if (session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div>
  <form class="search-form" action="{{ route('search') }}" method="post" style="margin-bottom:20px">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <div class="input-group">
          <div class="input-group-text">
            <i data-feather="search"></i>
          </div>
          <input name="id" type="text" class="form-control" id="navbarForm" placeholder="Search here...">
        </div>
      </div>
  </form>
</div>
              @if ($ventes->isEmpty())
                <p>No sales found.</p>
              @else
              <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">ID client</th>
                      <th scope="col">ID produit</th>
                      <th scope="col">Quantité</th>
                      <th scope="col">Prix</th>
                      <th scope="col">Created at</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($ventes as $vente)
                    <tr>
                      <th scope="row">{{ $vente->id }}</th>
                      <td>{{ $vente->id_client }}</td>
                      <td>{{ $vente->id_produit }}</td>
                      <td>{{ $vente->quantite }}</td>
                      <td>{{ $vente->prix }}</td>
                      <td>{{ $vente->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif
           
 
@endsection

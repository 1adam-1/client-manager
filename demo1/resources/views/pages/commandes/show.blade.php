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

              @if ($commandes->isEmpty())
                <p>Pas de commande trouvé.</p>
              @else
              <style>
body {
  font-family: 'lato', sans-serif;
}
.container {
  max-width: 1500px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
}

h2 {
  font-size: 26px;
  margin: 20px 0;
  text-align: center;
  small {
    font-size: 0.5em;
  }
}

.responsive-table {
  li {
    border-radius: 3px;
    padding: 25px 30px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .table-header {
    background-color: #95A5A6;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.1);
  }
  .col-1 {
    flex-basis:15%;
  }
  .col-2 {
    flex-basis: 20%;
  }
  .col-3 {
    flex-basis: 15%;
  }
  .col-4 {
    flex-basis: 15%;
  }
  .col-5 {
    flex-basis: 15%;
  }
  .col-6 {
    flex-basis: 15%;
  }

  @media all and (max-width: 767px) {
    .table-header {
      display: none;
    }

    li {
      display: block;
    }
    .col {

      flex-basis: 100%;

    }
    .col {
      display: flex;
      padding: 10px 0;
      &:before {
        color: #6C7A89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
    }
  }
}
</style>

<div class="container">
  <h2>Commandes de  {{$client->generated_id}} </h2>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">Id commande</div>
      <div class="col col-2">Nom produit</div>
      <div class="col col-3">Quantité</div>
      <div class="col col-4">Prix</div>
      <div class="col col-5">Type</div>
      <div class="col col-6">Couleur</div>
    </li>
    @foreach($commandes as $commande)
    <li class="table-row">
      <div class="col col-1" data-label="id">{{$commande->list_id}}</div>
      <div class="col col-2" data-label="nom prodduit">{{$commande->produit->nom}}</div>
      <div class="col col-3" data-label="Quantité">{{$commande->quantite}}</div>
      <div class="col col-4" data-label="Quantité">{{$commande->prix}}</div>
      <div class="col col-5" data-label="Type ">{{$commande->type}}</div>
      <div class="col col-6" data-label="Couleur ">{{$commande->couleur}}</div>
    </li>
    @endforeach
  </ul>
</div>
              @endif


@endsection

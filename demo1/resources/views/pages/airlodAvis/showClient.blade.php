
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
<form class="search-form d-flex align-items-center" action="{{ route('search') }}" method="post" style="margin-top: -70px;">
    @csrf
    <div class="input-group flex-grow-50 me-2" style="width: 260%">
        <div class="input-group-text">
            <i data-feather="search"></i>
        </div>
        <input name="id" type="text" class="form-control" id="navbarForm" placeholder="Search here...">
    </div>
    <div class="input-group flatpickr me-2" id="dashboardDate1">
        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle>
            <i data-feather="calendar" class="text-primary"></i>
        </span>
        <input name="start_date" type="date" class="form-control bg-transparent border-primary" placeholder="Select start date">
    </div>
    <div class="input-group flatpickr me-2" id="dashboardDate2">
        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle>
            <i data-feather="calendar" class="text-primary"></i>
        </span>
        <input name="end_date" type="date" class="form-control bg-transparent border-primary" placeholder="Select end date">
    </div>
    <button type="submit" class="btn btn-primary" style="margin-top:-2px ;"><i class="link-icon" data-feather="filter"></i></button>
</form>

</div>
              @if ($clients->isEmpty())
                <p>No clients found.</p>
              @else
              <div class="table-responsive" style="margin-top: -15px;">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Ticket No.</th>
                      <th scope="col">Nom Complet</th>
                      <th scope="col">Email</th>
                      <th scope="col">Choix Produits</th>
                      <th scope="col">Domaine d'activité</th>
                      <th scope="col">Adresse</th>
                      <th scope="col">Source</th>
                      <th scope="col">Numéro téléphone</th>
                      <th scope="col">Campagne Publicitaire</th>
                      <th scope="col">Nom entreprise</th>
                      <th scope="col">Notes</th>
                      <th scope="col">Statut</th>
                      <th scope="col">Facture</th>
                      <th scope="col">Created at</th>
                      <th scope="col">Updated at</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($clients as $client)
                    <tr>
                      <th scope="row">{{ $client->generated_id }}</th>
                      <td>{{ $client->nomComplet }}</td>
                      <td>{{ $client->email }}</td>
                      <td>
                        <form action="{{ route( 'showCommandeAirlodAvis', ['id'=>$client->generated_id] ) }}" method="get">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">consulter</button>
                        </form>
                      </td>
                      <td>{{ $client->domaineActivite }}</td>
                      <td>{{ $client->adresse }}</td>
                      <td>{{ $client->source }}</td>
                      <td>{{ $client->num }}</td>
                      <td>{{ $client->campagnePub }}</td>
                      <td>{{ $client->entreprise }}</td>
                      <td>{{ $client->notes }}</td>
                      <td>{{ $client->statut }}</td>
                      <td>{{ $client->facture }}</td>
                      <td>{{ $client->created_at }}</td>
                      <td>{{ $client->updated_at }}</td>
                      <td>
                        <div class="d-flex align-items">
                          <div style="margin-right: 5px;">
                        <form action="{{ route('showUpdateAirlodAvis', ['id' => $client->generated_id]) }}" method="get">
                          @csrf
                      <button type="submit" class="btn btn-outline-dark">Update</button>
                      </form>
                      </div>
                      <div>
                      @auth
                      @if(Auth::user()->token != NULL)
                          @if(Auth::user()->token == 0)
                              <form action="{{ route('deleteClientAirlodAvis', ['id' => $client->generated_id]) }}" method="post">
                                  @method('DELETE')
                                  @csrf
                                  <button type="submit" class="btn btn-outline-danger">Delete</button>
                              </form>
                          @endif
                      @endif
                  @endauth
                      </div>
                      </div>
                    </td>  
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif
           
 
@endsection

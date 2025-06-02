@extends('layout.master3')

@section('content')

    <style>
        label{
            background-image: linear-gradient(to left, #1e3c72, #2a5298);
            color: transparent;
            background-clip: text;
            -webkit-background-clip: text;
            font-size: 17px;

        }
        h5{
            font-size: 40px;
            font-weight: 400;
            background-image: linear-gradient(to left, #553c9a, #b393d3);
            color: transparent;
            background-clip: text;
            -webkit-background-clip: text;
            margin-left: 100px;
        }
    </style>

<div style="margin-top: -70px;">
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
</div>
<form class="search-form d-flex align-items-center" action="{{ route('search') }}" method="post" style="margin-bottom: 45px">
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

              @if ($clients->isEmpty())
                <p>No clients found.</p>
              @else
              <div class="table-responsive" style="margin-top: 15px;">
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
                        <form action="{{ route( 'showCommande', ['id'=>$client->generated_id] ) }}" method="get">
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
                              <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#updateModal-{{ $client->generated_id }}">
                                  Update
                              </button>
                      </div>
                      <div>
                      @auth
                      @if(Auth::user()->token != NULL)
                          @if(Auth::user()->token == 0)
                              <form action="{{ route('deleteClient', ['id' => $client->generated_id]) }}" method="post">
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
                    <!-- Modal -->
                    <div class="modal fade" id="updateModal-{{ $client->generated_id }}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Update Client</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('updateClient', ['id' => $client->generated_id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="username" class="form-label" >Nom complet</label>
                                            <input type="text" class="form-control" name="nomcomplet" value="{{ old('nomComplet', $client->nomComplet) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ old('email', $client->email) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Numero</label>
                                            <input type="text" class="form-control" name="num" value="{{ old('num', $client->num) }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="token" class="form-label">Statut</label>
                                            <input type="text" class="form-control" name="statut" required>
                                        </div>

                                        <button type="submit" class="btn btn-outline-primary"
                                                style="width: 300px;
                                               margin-left: 70px;
                                        "
                                        >Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif


@endsection

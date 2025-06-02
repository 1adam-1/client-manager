@extends('layout.master3')
@section('content')
<style>

  
  .custom-bg-color {
    background-color: black;
    color: white;
    padding: 10px;
    border: 1px solid #ccc;
    font-size: 16px;
  }

  .custom-bg-color:focus {
    background-color: white;
    color: black;
  }

  .select-option {
    color: white;
  }

  .page-content {
    min-height: 100vh; /* Ensure it fills the entire viewport height */
  }

  .card {
    width: 100%;
  }

  .auth-form-wrapper {
    width: 100%;
  }

  .auth-side-wrapper {
    height: 100%;
  }
</style>

      <div class="card">
        <div class="row g-0">
          <div class="col-md-4">
            <div class="auth-side-wrapper" style="background-color: black;">
              <!-- Side content can go here, if any -->
            </div>
          </div>
          <div class="col-md-8">
            <div class="auth-form-wrapper px-4 py-5">
              <img src="https://airlod.com/wp-content/uploads/2024/03/cropped-cropped-cropped-LOGO-Airlod-blanc-copie-11.png" alt="" style="height: 2.5em;width:10em;">
              <br>
              <h5 class="text fw-normal mb-4 mt-3">Mise à jour</h5>

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

              <form class="forms-sample" action="{{ route('updateClientAirlodAvis',['id' => $client->generated_id]) }}" method="POST">
                @csrf
                @Method('PUT')
                <div class="mb-3 row">
                  <div class="col">
                    <input name="nomcomplet" type="text" class="form-control custom-bg-color" id="exampleInputNomComplet" autocomplete="nomcomplet" placeholder="Nom Complet" value="{{ old('nomcomplet', $client->nomComplet) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="email" type="email" class="form-control custom-bg-color" id="exampleInputEmail" placeholder="E-mail" value="{{ old('email', $client->email) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="choixProduit" type="text" class="form-control custom-bg-color" id="exampleInputChoixProduit" autocomplete="choixProduit" placeholder="Choix Produits" value="{{ old('choixProduit', $client->choixProduit) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="domaineActivite" type="text" class="form-control custom-bg-color" id="exampleInputDomaineActivite" autocomplete="domaineActivite" placeholder="Domaine d'activité" value="{{ old('domaineActivite', $client->domaineActivite) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="adresse" type="text" class="form-control custom-bg-color" id="exampleInputAdresse" autocomplete="adresse" placeholder="Adresse" value="{{ old('adresse', $client->adresse) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="source" type="text" class="form-control custom-bg-color" id="exampleInputSource" autocomplete="source" placeholder="Source" value="{{ old('source', $client->source) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="num" type="text" class="form-control custom-bg-color" id="exampleInputNum" autocomplete="num" placeholder="Numéro" value="{{ old('num', $client->num) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="exampleInputCampagnePub" class="col-form-label fixed-width-label text-nowrap">Campagne Publicitaire</label>
                  <div class="col">
                    <select name="campagnePub" id="exampleInputCampagnePub" class="form-control">
                      @foreach ($campagnes as $campagne)
                        <option value="{{ $campagne }}" class="">{{ $campagne }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="entreprise" type="text" class="form-control custom-bg-color" id="exampleInputentreprise" autocomplete="entreprise" placeholder="Nom entreprise" value="{{ old('entreprise', $client->entreprise) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="notes" type="text" class="form-control custom-bg-color" id="exampleInputNotes" autocomplete="Notes" placeholder="Notes" value="{{ old('notes', $client->notes) }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="exampleInputStatut" class="col-form-label fixed-width-label text-nowrap">Statut</label>
                  <div class="col">
                    <select name="statut" id="exampleInputStatut" class="form-control">
                      @foreach ($statues as $status)
                        <option value="{{ $status }}" class="">{{ $status }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <button type="submit" class="btn btn-secondary btn-dark btn-lg">Save</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
  document.querySelectorAll('.custom-bg-color').forEach(input => {
    input.addEventListener('focus', function() {
      this.style.backgroundColor = 'white';
      this.style.color = 'black';
    });

    input.addEventListener('blur', function() {
      this.style.backgroundColor = 'black';
      this.style.color = 'white';
    });
  });
</script>
@endsection

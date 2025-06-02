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
    min-height: 100vh; 
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
          <div class="col-md-3">
            <div class="auth-side-wrapper" style="background-color: black; width:20em;" >
              <!-- Side content can go here, if any -->
            </div>
          </div>
          <div class="col-md-9">
            <div class="auth-form-wrapper px-4 py-5">
              <img src="https://airlod.com/wp-content/uploads/2024/03/cropped-cropped-cropped-LOGO-Airlod-blanc-copie-11.png" alt="" style="height: 2.5em;width:10em;">
              <br>
              <h5 class="text fw-normal mb-4 mt-3">Ajouter Produit</h5>

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

              <form class="forms-sample" action="{{ route('createProduct') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 row">
                  <div class="col">
                    <input name="nom" type="text" class="form-control custom-bg-color" id="exampleInputNomComplet" autocomplete="nomcomplet" placeholder="Nom du produit" value="{{ old('nom') }}">
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                  <textarea name="description" id="description" rows="4" cols="50" placeholder="Description" class="form-control custom-bg-color"></textarea>
                  </div>
                </div>

                <div class="mb-3 row">
                  <div class="col">
                    <input name="prix" type="text" class="form-control custom-bg-color" id="exampleInputChoixProduit" autocomplete="Prix" placeholder="prix" value="{{ old('prix') }}">
                  </div>
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label">Image </label>
                    <input name="image" class="form-control" type="file" id="formFile">
                  </div>
                <div>
                

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

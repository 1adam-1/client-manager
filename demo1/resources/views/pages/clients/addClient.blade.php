@extends('layout.master5')
@section('content')

<body>
<div>
  <form class="search-form" action="{{ route('search') }}" method="post" style="margin-top: 10vh;margin-left:328px;margin-bottom:10px;width:70%;">
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

  <div class="container">
  <div class="errors" >
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
    <div  style="display: flex;align-items:center">
    <div class="title">Airlod Entrée</div>
    <div>
    <h4 style="margin-left:300px">New ND : ND{{ $nextNumber }}</h4>    </div>
    </div>
    <div class="content">
    <form class="forms-sample" action="{{ route('createClient') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="user-details">
    <div class="input-box">
      <span class="details">Nom complet <span style="color:red">*</span></span>
      <input name="nomcomplet" type="text" placeholder="Entrez votre nom complet" value="{{ old('nomcomplet') }}" >
    </div>
    <div class="input-box">
      <span class="details">E-mail</span>
      <input name="email" type="email" placeholder="Entrez votre e-mail" value="{{ old('email') }}" >
    </div>
    <div class="input-box">
      <span class="details">Domaine d'activité</span>
      <input name="domaineActivite" type="text" placeholder="Entrez votre domaine d'activité" value="{{ old('domaineActivite') }}" >
    </div>
    <div class="input-box">
      <span class="details">Adresse</span>
      <input name="adresse" type="text" placeholder="Entrez votre adresse" value="{{ old('adresse') }}" >
    </div>
    <div class="input-box">
      <span class="details">Numéro<span style="color:red">*</span></span>
      <input name="num" type="text" placeholder="Entrez votre numéro" value="{{ old('num') }}" >
    </div>
    <div class="input-box">
      <span class="details">Source<span style="color:red">*</span></span>
      <select name="source" id="exampleInputSource" class="select-control">
        @foreach ($sources as $source)
          <option value="{{ $source }}" style="color: black; background-color:darkgrey">{{ $source }}</option>
        @endforeach
      </select>
    </div>
    <div class="input-box">
      <span class="details">Notes</span>
      <input name="notes" type="text" placeholder="Entrez des notes" value="{{ old('notes') }}">
    </div>
    <div class="input-box">
      <span class="details">Campagne pub<span style="color:red">*</span></span>
      <select name="campagnePub" id="exampleInputCampagnePub" class="select-control">
        @foreach ($campagnes as $campagne)
          <option value="{{ $campagne }}" style="color: black;">{{ $campagne }}</option>
        @endforeach
      </select>      
    </div>
    <div class="input-box">
      <span class="details">Entreprise</span>
      <input name="entreprise" type="text" placeholder="Entrez le nom de l'entreprise" value="{{ old('entreprise') }}">
    </div>
    <div class="input-box" style="margin-left: 35px;">
      <span class="details">Statut<span style="color:red">*</span></span>
      <select name="statut" id="exampleInputStatut" class="select-control">
        @foreach ($statues as $status)
          <option value="{{ $status }}" style="color: black;">{{ $status }}</option>
        @endforeach
      </select>  
    </div>
    <div class="product-selections"></div>
    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal" style="border:solid 2px #9b59b6; margin-bottom:20px">
      Choix du produit
    </button>
    <div class="input-box">
      <span class="details">Logo</span>
      <input id="file" class="form-control" type="file" name="logo">
    </div>
  </div>
  <div class="button">
    <input type="submit" value="Save">
  </div>
</form>

    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" style="width: 120%;">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Product Selection</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row" style="margin-top: 20px; margin-bottom:-40px">
            @foreach ($products as $product)
            <div class="col-md-3">
              <section class="card card-blue product-card" data-product-id="{{ $product->id }}">
                <div class="product-image">
                  <img src="{{ $product->image }}" alt="Product Image" draggable="false" />
                </div>
                <div class="radio-select" >
                  <input type="checkbox" class="btn-check " id="btn-check-{{ $product->id }}" autocomplete="off">
                  <label class="btn btn-outline-dark radio-label" for="btn-check-{{ $product->id }}" style="color:#00E01A;border:2px solid #00E01A;border-radius:10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                      <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>
                  </label>
                </div>
                <div class="product-info">
                  <h2>{{ $product->nom }}</h2>
                  <div class="price">{{ $product->prix }}dhs</div>
                </div>
                <div class="quantity-selector" id="quantity-selector-{{ $product->id }}">
                  <button class="quantity-btn1" onclick="decrementQuantity({{ $product->id }})">-</button>
                  <input type="number" id="quantity-{{ $product->id }}" name="quantity" min="1" value="1" class="form-control1 quantity-input">
                  <button class="quantity-btn2" onclick="incrementQuantity({{ $product->id }})">+</button>
                </div>
                <div class="type">
                  
                </div>
                <div class="color-selector" id="color-selector-{{ $product->id }}" style="margin-top: 15px;align-items: center;">
                <label for="exampleColorInput" class="form-label" style="margin-right: 10px;">Choose the color</label>
                <input type="color" class="form-control form-control-color" id="exampleColorInput-{{ $product->id }}" value="#FF0000" title="Choose your color">
            </div>

              </section>
            </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Save</button>
        </div>
      </div>
    </div>
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
  let selectedProducts = [];

  document.querySelectorAll('.product-card').forEach(function (card) {
    const checkbox = card.querySelector('.btn-check');
    const quantitySelector = card.querySelector('.quantity-selector');
    const colorSelector = card.querySelector('.color-selector');
    const radioLabel = card.querySelector('.radio-label');
    const productId = card.getAttribute('data-product-id');

    checkbox.addEventListener('change', function () {
      if (checkbox.checked) {
        quantitySelector.style.display = 'flex';
        colorSelector.style.display = 'flex';
        radioLabel.style.backgroundColor = '#00E01A';
        radioLabel.style.color = 'white';
        card.classList.add('selected-card'); 

        // Add product to selectedProducts array
        addProductToSelection(productId);
      } else {
        quantitySelector.style.display = 'none';
        colorSelector.style.display = 'none';
        radioLabel.style.backgroundColor = 'white';
        radioLabel.style.color = '#00E01A';
        card.classList.remove('selected-card'); 

        // Remove product from selectedProducts array
        removeProductFromSelection(productId);
      }
    });
  });

  function addProductToSelection(productId) {
    const quantity = document.getElementById('quantity-' + productId).value;
    const color = document.getElementById('exampleColorInput-' + productId).value;

    selectedProducts = selectedProducts.filter(p => p.product_id !== productId);

    selectedProducts.push({
      product_id: productId,
      quantity: quantity,
      color: color
    });

    updateHiddenInputs();
  }

  function removeProductFromSelection(productId) {
    selectedProducts = selectedProducts.filter(p => p.product_id !== productId);

    updateHiddenInputs();
  }

  function updateHiddenInputs() {
    const container = document.querySelector('.product-selections');
    container.innerHTML = '';

    selectedProducts.forEach(product => {
      const inputGroup = document.createElement('div');
      inputGroup.className = 'product-selection';

      inputGroup.innerHTML = `
        <input type="hidden" name="selectedProducts[][product_id]" value="${product.product_id}">
        <input type="hidden" name="selectedProducts[][quantity]" value="${product.quantity}">
        <input type="hidden" name="selectedProducts[][color]" value="${product.color}">
      `;

      container.appendChild(inputGroup);
  });
  }

  window.incrementQuantity = function (id) {
    var input = document.getElementById('quantity-' + id);
    input.value = parseInt(input.value) + 1;

    // Update hidden input for selected quantity
    document.querySelector(`input[name="selectedProducts[][product_id]"][value="${id}"]`).nextElementSibling.value = input.value;
  };

  window.decrementQuantity = function (id) {
    var input = document.getElementById('quantity-' + id);
    if (input.value >= 1) {
      input.value = parseInt(input.value) - 1;

      // Update hidden input for selected quantity
      document.querySelector(`input[name="selectedProducts[][product_id]"][value="${id}"]`).nextElementSibling.value = input.value;
    }
  };
});

</script>

</body>
@endsection
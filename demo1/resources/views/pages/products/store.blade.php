@extends('layout.master4')

<style>
    .quantity-selector {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 10px;
    }

    .quantity-btn {
      background-color: #03e9f4;
      border: none;
      color: white;
      font-size: 16px;
      padding: 5px 10px;
      cursor: pointer;
      border-radius: 3px;
      margin: 0 5px;
    }

    .quantity-input {
      width: 50px;
      text-align: center;
      border: 1px solid #ddd;
      border-radius: 3px;
      height: 34px;
    }
    *
{
	margin: 0;
	padding: 0;
	box-sizing: border-box;
	font-family: 'Poppins', sans-serif;
}

  </style>
  
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

<body>
  <!-- Main Content -->
  <main class="container mt-4">
    @if ($products->isEmpty())
    <p>No products found.</p>
    @else
    <div class="row" style="margin-top: 20px; margin-bottom:-40px">
      @foreach ($products as $product)
      <div class="col-md-3">
          <section class="card card-blue">
            <div class="product-image">
              <img src="{{ $product->image }}" alt="OFF-white Blue Edition" draggable="false" />
            </div>
            <div class="product-info">
              <h2>{{ $product->nom }}</h2>
              <div class="price">{{ $product->prix }}dhs</div>
            </div>
              <div class="quantity-selector">
              <button class="quantity-btn" onclick="decrementQuantity({{ $product->id }})">-</button>
              <input type="number" id="quantity-{{ $product->id }}" name="quantity" min="1" value="1" class="form-control quantity-input">
              <button class="quantity-btn" onclick="incrementQuantity({{ $product->id }})">+</button>
              </div>
          </section>
      </div>
      @endforeach
    </div>
  </main>

  

  <script>
    function decrementQuantity(id) {
      const quantityInput = document.getElementById(`quantity-${id}`);
      if (quantityInput.value > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
      }
    }

    function incrementQuantity(id) {
      const quantityInput = document.getElementById(`quantity-${id}`);
      quantityInput.value = parseInt(quantityInput.value) + 1;
    }
  </script>
</body>

@endif

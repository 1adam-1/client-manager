@extends('layout.master4')

@section('content')

<body style="color: black;">

<div class="container mt-3">
  <!-- Header -->
  <div class="jumbotron text-center" style="background-color: white; padding: 2em; margin-bottom: 30px;">
    <h1>Boutique - Airlod</h1>
  </div>

  <!-- Error and Success Messages -->
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

  <!-- Product Information -->
  <div class="row">
    <!-- Product Images -->
    <div class="col-md-6">
      <div class="card">
        <div id="carouselExample" class="carousel slide">
          <div class="carousel-inner">
            <div id="classicImage" class="carousel-item active">
              <img src="{{$product->image}}" class="d-block w-100" alt="{{$product->image}}">
            </div>
            <div id="personalizedImage" class="carousel-item">
              <img src="{{ asset('storage/products/airlod_tag.jpg') }}" class="d-block w-100" alt="...">
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Product Details -->
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
        <h1 style="color: black; font-weight: bold;">{{ $product->nom }}</h1>
        <h4 id="product-price" style="color: black;">{{ $product->prix }} dhs</h4>
        <form action="{{ route('addCart', ['id' => $product->id]) }}" method="post">         
        @csrf
        <div class="form-group mt-4">
            <h4 style="color: black;">Type de carte</h4>
            <div class="btn-group" style="height: 50px;">
              <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked />
              <label class="btn btn-secondary" for="option1" data-mdb-ripple-init style="background-color: black;">
                <img src="https://airlod.com/wp-content/uploads/2023/09/Pin-noir.png" alt="" style="width: 35px;height:35px">
                Classique</label>
            
                <input type="radio" class="btn-check" name="options" id="option3" autocomplete="off" data-bs-toggle="modal" data-bs-target="#exampleModal" />
                <label class="btn btn-secondary" for="option3" data-mdb-ripple-init style="background-color: black;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
                  <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"/>
                  <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5"/>
                </svg>
                <span style="margin-left: 5px;"> Personnalisée</span></label>
            </div>
            </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color: black;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-weight: bold;">Add your logo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input name="image" class="form-control" type="file" id="formFile">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: black;">Save</button>

      </div>
    </div>
  </div>
</div>
<hr>
          
            <button type="submit" class="btn btn-dark btn-block mt-3">Add to Cart</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @if (!empty($product->description))
  <!-- Product Description -->
  <div class="row mt-3">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <h1 style="color: black;">Description</h1>
          <h5 style="color: black;">{{ $product->description }}</h5>
        </div>
      </div>
    </div>
  </div>
  @endif

  <!-- Similar Products Section -->
  @if($similar->isNotEmpty())
    <h1>Produits similaires</h1>
    <div class="row" style="margin-top: 20px; margin-bottom: -40px;">
      @foreach ($similar as $item)
        <div class="col-md-3">
          <a href="{{ route('showProduct', ['id' => $item->id]) }}">
            <section class="card card-blue">
              <div class="item-image">
                <img src="{{ $item->image }}" alt="{{ $item->nom }}" draggable="false" />
              </div>
              <div class="item-info">
                <h2>{{ $item->nom }}</h2>
                <div class="price">{{ $item->prix }} dhs</div>
              </div>
              <div class="btn">
                <button class="buy-btn">Buy Now</button>
              </div>
            </section>
          </a>
        </div>
      @endforeach
    </div>
  @endif

</div>

<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    const priceElement = document.getElementById('product-price');
    const typeElements = document.querySelectorAll('input[name="options"]');
    const originalPrice = {{ $product->prix }};
    const carousel = new bootstrap.Carousel(document.querySelector('#carouselExample'));

    typeElements.forEach((typeElement) => {
      typeElement.addEventListener('change', (e) => {
        let selectedType = e.target.nextElementSibling.innerText.trim();
        if (selectedType === 'Personnalisée') {
          priceElement.innerText = (originalPrice + 100) + '.00 dhs';
          carousel.to(1); // Switch to the personalized image
        } else {
          priceElement.innerText = originalPrice + '.00 dhs';
          carousel.to(0); // Switch to the classic image
        }
      });
    });
  });
</script>

</body>

@endsection

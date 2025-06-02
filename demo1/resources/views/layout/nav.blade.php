<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height:100px">
  <div class="container-fluid">
    <img src="https://airlod.com/wp-content/uploads/2023/08/cropped-LOGO-Airlod-blanc-copie-1.png" alt="" style="height:40px">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" style="margin-left: 250px;">
          <a class="nav-link active" aria-current="page" href="{{ route('showProducts') }}">Boutique</a>
        </li>
        <li class="nav-item" >
          <a class="nav-link active" aria-current="page" href="#footer">Contact</a>
        </li> 
        <li class="nav-item" >
          <a class="nav-link active" aria-current="page" href="{{ route('showCart')}}">Panier</a>
        </li> 
      </ul>
      <form action="{{ route('searchProduct') }}" class="d-flex" role="search" method="get">
        @csrf
        <div style="width: 500px;">
        <div class="input-group">
          <div class="input-group-text">
            <button type="submit"><i data-feather="search" style="color: black;"></i></button>
          </div>
          <input name="nom" type="text" class="form-control" id="navbarForm" placeholder="Search here...">
        </div>
      </div>
      </form>
    </div>
  </div>
</nav>
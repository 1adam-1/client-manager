<div class="horizontal-menu">
  <nav class="navbar top-navbar">
    <div class="container">
      <div class="navbar-content">
        <a href="#" class="navbar-brand">
          Airlod <span>Dashboard</span>
        </a>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
          <i data-feather="menu"></i>
        </button>
      </div>
    </div>
  </nav>
  <nav class="bottom-navbar">
    <div class="container">
      <ul class="nav page-navigation">
        <li class="nav-item {{ active_class(['/']) }}">
          <a class="nav-link" href="{{ url('/') }}">
            <i class="link-icon" data-feather="box"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>
       <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
        <a class="nav-link" href="{{ route('showUsers') }}" role="button">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">Users</span>
          </a>
        </li>

        <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#airlod" role="button" aria-expanded="{{ is_active_route(['manage/airlod/*']) }}" aria-controls="airlod">
    <i class="link-icon" data-feather="layers"></i>
    <span class="link-title">Airlod</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
            <li class="nav-item">
        <a href="{{ route('showForm') }}" class="nav-link {{ active_class(['manage/airlod/add']) }}">Lead</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('affich') }}" class="nav-link {{ active_class(['manage/airlod/list']) }}">List</a>
      </li>
          </ul>
          </div>
        </li>

        <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#airlod-avis" role="button" aria-expanded="{{ is_active_route(['manage/airlod-avis/*']) }}" aria-controls="airlod-avis">
    <i class="link-icon" data-feather="layers"></i>
    <span class="link-title">Airlod Avis</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
            <li class="nav-item">
        <a href="{{ route('showFormAirlodAvis') }}" class="nav-link {{ active_class(['manage/airlod-avis/add']) }}">Lead</a>
      </li>
      <li class="nav-item">
        <a href="{{  route('affichAirlodAvis')  }}" class="nav-link {{ active_class(['manage/airlod-avis/update']) }}">List</a>
      </li>
          </ul>
          </div>
        </li>

        <li class="nav-item {{ active_class(['email/*', 'apps/*']) }}">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" role="button" aria-expanded="{{ is_active_route(['auth/*']) }}" aria-controls="auth">
          <i class="link-icon" data-feather="unlock"></i>
          <span class="link-title">Authentication</span>
            <i class="link-arrow"></i>
          </a>
          <div class="submenu">
            <ul class="submenu-item">
            <li class="nav-item">
              <a href="{{ url('/auth/login') }}" class="nav-link {{ active_class(['auth/login']) }}">Change account</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/auth/register') }}" class="nav-link {{ active_class(['auth/register']) }}">Register</a>
            </li></ul>
          </div>
        </li>



      </ul>
    </div>
  </nav>
</div>

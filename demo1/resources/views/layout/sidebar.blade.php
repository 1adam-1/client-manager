
<nav class="sidebar">
  <div class="sidebar-header">
  <img src="https://airlod.com/wp-content/uploads/2024/03/cropped-cropped-cropped-LOGO-Airlod-blanc-copie-11.png" alt="" style="height: 2.5em;width:10em;">
  </div>
  <div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ url('/') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Entry</li>
      @if(Auth::check() && Auth::user()->token == 0)
    <li class="nav-item" style="margin-bottom: 20px;">
        <a class="nav-link" href="{{ route('showUsers') }}" role="button">
            <i class="link-icon" data-feather="user"></i>
            <span class="link-title">Users</span>
        </a>
    </li>
@endif
<li class="nav-item {{ active_class(['manage/airlod/*']) }}" style="margin-bottom: 20px;">
  <a class="nav-link" data-bs-toggle="collapse" href="#airlod" role="button" aria-expanded="{{ is_active_route(['manage/airlod/*']) }}" aria-controls="airlod">
    <i class="link-icon" data-feather="layers"></i>
    <span class="link-title">Airlod</span>
    <i class="link-arrow" data-feather="chevron-down"></i>
  </a>
  <div class="collapse {{ show_class(['manage/airlod/*']) }}" id="airlod">
    <ul class="nav sub-menu">
      <li class="nav-item">
        <a href="{{ route('showForm') }}" class="nav-link {{ active_class(['manage/airlod/add']) }}">Lead</a>
      </li>
      <li class="nav-item">
        <a href="{{ route('affich') }}" class="nav-link {{ active_class(['manage/airlod/list']) }}">List</a>
      </li>

    </ul>
  </div>
</li>
<li class="nav-item {{ active_class(['manage/airlod-avis/*']) }}" style="margin-bottom: 20px;">
  <a class="nav-link" data-bs-toggle="collapse" href="#airlod-avis" role="button" aria-expanded="{{ is_active_route(['manage/airlod-avis/*']) }}" aria-controls="airlod-avis">
    <i class="link-icon" data-feather="layers"></i>
    <span class="link-title">Airlod Avis</span>
    <i class="link-arrow" data-feather="chevron-down"></i>
  </a>
  <div class="collapse {{ show_class(['manage/airlod-avis/*']) }}" id="airlod-avis">
    <ul class="nav sub-menu">
      <li class="nav-item">
        <a href="{{ route('showFormAirlodAvis') }}" class="nav-link {{ active_class(['manage/airlod-avis/add']) }}">Lead</a>
      </li>
      <li class="nav-item">
        <a href="{{  route('affichAirlodAvis')  }}" class="nav-link {{ active_class(['manage/airlod-avis/update']) }}">List</a>
      </li>
    </ul>
  </div>
</li>

      <li class="nav-item"  >
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" role="button" aria-expanded="" aria-controls="auth">
          <i class="link-icon" data-feather="unlock"></i>
          <span class="link-title">Authentication</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="auth">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ url('/auth/login') }}" class="nav-link {{ active_class(['auth/login']) }}">Change account</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/auth/register') }}" class="nav-link {{ active_class(['auth/register']) }}">Register</a>
            </li>
          </ul>
        </div>
      </li>

    </ul>
  </div>
</nav>

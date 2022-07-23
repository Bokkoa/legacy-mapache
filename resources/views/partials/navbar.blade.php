<header class="app-header navbar">

  <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn ">
                                <i id="tg-icon" class="fas fa-align-justify"></i>
                            </button>
                        </div>
 

  <ul class="nav navbar-nav ml-auto">

    <li class="nav-item dropdown">
      <a class="alert-link" data-toggle="dropdown" role="button">
      @if (Auth::user())
       <div class="row"> 
        @if (Auth::user()->profile_image != NULL)
        <img class="avatar-min profile-img" src="{{ asset(Auth::user()->profile_image) }}" >
        @else
        <img class="avatar-min profile-img" src="{{ asset('img/extras/default.png') }}">
        @endif

       </div>
      @else
        Aun no estas registrado
      @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right alert-secondary"">
        <div class="dropdown-header text-center alert-primary"">
          <strong>{{ Auth::user()->username }}</strong>
        </div>
              <a class="dropdown-item alert-secondary" href="{{ route('profile') }}" >
              <i class="fas fa-user"></i> {{ __('Perfil') }}</a>

              <a class="dropdown-item alert-secondary" href="{{ route('logout') }}"  onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="fa fa-lock"></i> {{ __('Salir') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </header>

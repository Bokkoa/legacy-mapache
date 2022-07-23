<div class="wrapper">
  <div id="sidebar" class="sidebar alert-secondary shadow"> 
    <nav class="sidebar-nav" >
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link  alert-secondary text-dark" href="home">
          <i class="nav-icon"> <img src="{{ asset('img/icons/home-2.svg')}}" class="mapache-icon"></i> Inicio
        </a>
      </li>
      <li class="nav-title text-dark">Módulos</li>
      
      
      <li class="nav-item nav-dropdown">
        <a class="nav-link  alert-secondary nav-dropdown-toggle text-dark" href="#">
          <i class="nav-icon"><img src="{{ asset('img/icons/smartphone-8.svg') }}" class="mapache-icon"></i> 
          Personal</a>  
          <!-- SECCIONES PARA PERSONAL -->
          <ul class="nav-dropdown-items"> 
            <li class="nav-item">
              <a class="nav-link  alert-secondary text-dark" href="userprofile">
                <i class="nav-icon"><img src="{{ asset('img/icons/user.svg') }}" class="mapache-icon"></i>
                Perfil</a>
              </li>

            <li class="nav-item">
              <a class="nav-link  alert-secondary text-dark" href="subjects">
                <i class="nav-icon"><img src="{{ asset('img/icons/agenda.svg') }}" class="mapache-icon"></i>
                Mis Materias</a>
              </li>
            </ul>
          </li>
          <!-- MAS SECCIONES -->  
      
      <li class="nav-item nav-dropdown">
        <a class="nav-link  alert-secondary nav-dropdown-toggle text-dark" href="#">
          <i class="nav-icon"><img src="{{ asset('img/icons/worldwide.svg') }}" class="mapache-icon"></i> 
          Explora</a>  
          <!-- SECCIONES PARA PERSONAL -->
          <ul class="nav-dropdown-items"> 
            <li class="nav-item">
              <a class="nav-link  alert-secondary text-dark" href="modules">
                <i class="nav-icon"><img src="{{ asset('img/icons/map.svg') }}" class="mapache-icon"></i>
                Modulos</a>
            </li>
          </ul>
      </li>

    @if(Auth::user()->fk_role > 1)
      <li class="nav-item nav-dropdown">
        <a class="nav-link  alert-secondary nav-dropdown-toggle text-dark" href="#">
          <i class="nav-icon"><img src="{{ asset('img/icons/settings.svg') }}" class="mapache-icon"></i> 
          Configuración</a>  
          <!-- SECCIONES PARA PERSONAL -->
          <ul class="nav-dropdown-items"> 
            <li class="nav-item">
              <a class="nav-link  alert-secondary text-dark" href="adminmodules">
                <i class="nav-icon"><img src="{{ asset('img/icons/archive-2.svg') }}" class="mapache-icon"></i>
                Edificios</a>
            </li>
            <li class="nav-item">
              <a class="nav-link  alert-secondary text-dark" href="showcharts">
                <i class="nav-icon"><img src="{{ asset('img/icons/network.svg') }}" class="mapache-icon"></i>
                Estadísticas</a>
            </li>
          </ul>
      </li>
      @endif

        </li>
      </ul>
      
    </nav>
    <!-- <button class="sidebar-minimizer brand-minimizer" type="button"></button> -->
  </div>
</div>
  
<script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                     $('#tg-icon').removeClass('fas fa-align-justify');
                 });
             });
</script>
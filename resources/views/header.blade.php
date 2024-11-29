<header>
  <div class="menu">
    <ul>
      <div>
        <li class="menu-item hidden logo-js">
          <p><strong>JM</strong><span class="software">SOFTWARE </span><span class="version">ver1.2.2</span>
          </p>
        </li>
      </div>
      <div class="opciones-menu">
        @if(session('name'))
        <li class="menu-item hidden"><a href="#">Usuario: <strong>{{ session('name') }}</strong></a></li>
        <li class="menu-item hidden"><a href="/logout">Cerrar Sesión</a></li>
        @else
        <li class="menu-item hidden"><a href="/">Home</a></li>
        <li class="menu-item hidden"><a href="/loginForm">Inicio de Sesión</a></li>
        <li class="menu-item hidden"><a href="/registroForm">Registro</a></li>
        @endif
      </div>
    </ul>
  </div>
</header>
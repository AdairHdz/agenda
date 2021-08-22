<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-2 shadow-sm mb-5">
  <div class="container-fluid">    
    <a class="navbar-brand" href="/">Agenda</a>    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="ml-auto collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('contacts.index') ? 'active' : '' }}" aria-current="page" href="/contacts">Mis contactos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('events.index') ? 'active' : '' }}" href="{{ route('events.index') }}">Mis eventos</a>
        </li>        
      </ul>      
    </div>
  </div>
</nav>
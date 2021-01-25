<section id="sidenav-menu" class="bg-dark">
    <div class="sidemenu">
        <ul>
            <li class="titulo-menu p-2 mb-1 pointer">
                <a href="{{ url('/dashboard') }}" class="text-secondary">
                    <span>MANAGER EN MI EMPRESA</span>
                </a>
            </li>
            @foreach($modulos as $modulo)
            <li class="item-menu p-2 mb-1 text-secondary pointer">
                <a class="d-flex text-secondary"
                    @if($modulo->estado == 'inactivo')
                        data-bs-toggle="modal" data-bs-target="#aviso-modulo"
                    @else
                        href="{{ url($modulo->ruta) }}"
                    @endif
                    >
                    <div class="me-auto">{{ $modulo->modulo }}</div>
                    <i class="ml-auto fas fa-angle-right"></i>
                </a>
            </li>
            @endforeach
            <li class="item-menu p-2 mb-1 pointer">
                <a class="d-flex text-danger" href="{{ url('/cerrar_sesion') }}">
                    <div class="me-auto">Salir</div>
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</section>
<section id="navbar-menu">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand text-secondary" href="{{ url('/dashboard') }}">Manager en mi empresa</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto">
                @foreach($modulos as $modulo)
                <li class="item-menu p-2 mb-1 text-secondary pointer">
                    <a class="d-flex text-secondary"
                    @if($modulo->ruta == 'SR')
                        data-bs-toggle="modal" data-bs-target="#aviso-modulo"
                    @elseif($modulo->ruta == 'SA')
                        data-bs-toggle="modal" data-bs-target="#aviso-modulo-usuario"
                    @else
                        href="{{ url($modulo->ruta) }}"
                    @endif
                    >
                    <div class="me-auto">{{ $modulo->modulo }}</div>
                    <i class="ml-auto fas fa-angle-right icono"></i>
                </li>
                @endforeach
                <li class="item-menu p-2 mb-1 pointer">
                    <a class="d-flex text-danger" href="{{ url('/cerrar_sesion') }}">
                        <div class="me-auto">Salir</div>
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</section>
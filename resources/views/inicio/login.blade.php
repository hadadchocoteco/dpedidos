@extends('plantillas/inicio')
@section('titulo','Iniciar | Pedidos')
@section('contenido')
<div class="contenido-centrado">
    @if(isset($_GET['m']))
        @if($_GET['m'] == 'credencial')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Las credenciales son incorrectas.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @elseif($_GET['m'] == 'existe')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                El usuario no está registrado.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @elseif($_GET['m'] == 'estado_empresa')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Esta empresa no puede utilizar el sistema, favor de comunicarse con el administrador.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
    @endif
    <div>
        <h2>Inicio de sesión</h2>
    </div>
    <form method="POST" action="{{ url('/autorizar') }}">
        @csrf
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Escribe tu correo">
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contrasena</label>
            <input type="text" class="form-control" name="contrasena" id="contrasena" placeholder="Escribe tu contraseña">
        </div>
        <div class="mb-3 d-grid">
            <input type="submit" value="Entrar" class="btn btn-primary">
        </div>
        <div class="text-end">
            <a href="">Recuperar contrasena</a>
        </div>
        <div class="mt-4 text-center">
            <span class="text-success">Soluciones Delmar</span>
        </div>
    </form>
</div>
@stop
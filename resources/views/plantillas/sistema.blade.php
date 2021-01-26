<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ url('/css/fuentes.css') }}">
    <link rel="stylesheet" href="{{ url('/css/general.css') }}">
    <link rel="stylesheet" href="{{ url('/css/menu.css') }}">
    <link rel="stylesheet" href="{{ url('/css/portal.css') }}">
    <title>@yield('titulo')</title>
    <script>
        var token = document.querySelector('meta[name="csrf-token"]').content;
        var base_url = "{{ url('/') }}";
        var xhr = new XMLHttpRequest();
        var url = '';
    </script>
</head>
<body>
    <main>
        <section class="banner pt-2 pb-2 pr-4 d-flex">
            <div class="ms-auto text-secondary pointer me-4 icono" title="Perfil" data-toggle="tooltip" data-placement="bottom">
                <a class="text-secondary" href="{{ url('v/perfil') }}">
                    <span>{{ session('NOMBRE') }}</span>
                    <i class="fas fa-user-circle"></i>
                </a>
            </div>
            <div class="pointer me-4 icono" title="Usuarios" data-bs-toggle="tooltip" data-bs-placement="bottom">
                <a class="text-secondary" href="{{ url('v/usuarios') }}">
                    <span>Usuarios</span>
                    <i class="fas fa-users"></i>
                </a>
            </div>
            <div class="pointer me-1 icono" title="Salir" data-toggle="tooltip" data-placement="bottom">
                <a class="text-danger" href="{{ url('cerrar_sesion') }}">
                    <span>Salir</span>
                    <i class="fas fa-power-off"></i>
                </a>
            </div>
        </section>
        <section class="contenido">
            @yield('contenido')
        </section>
    </main>
    <div class="modal fade" id="aviso-modulo" tabindex="-1" aria-labelledby="modal-aviso-modulo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-aviso-modulo">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Este módulo requiere activación para su uso.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="aviso-modulo-usuario" tabindex="-1" aria-labelledby="modal-aviso-modulo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-aviso-modulo">Aviso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    No tienes acceso a este módulo. Contacta con el administrador.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pedido-temporal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h2>Historial</h2>
                </div>
                <div class="modal-body">
                    <div id="carga-pedido-temporal"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger forma-redonda shadow" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function cargar_pedido_temporal(){
            let carga_pedido_temporal = document.getElementById('carga-pedido-temporal');
            let url = base_url+'/pedidos/consulta/temporal';

            xhr.onprogress = function(){
                carga_pedido_temporal.innerHTML = 'cargando';
            }
            xhr.onload = function(){
                if (xhr.readyState == 4 && xhr.status == 200) {
                    carga_pedido_temporal.innerHTML = this.response;
                }
            };
            xhr.onerror = function(){
                carga_pedido_temporal.innerHTML = 'Error al cargar pedido';
            }
            xhr.open('GET',url,true);
            xhr.send();
        }
    </script>
</body>
</html>
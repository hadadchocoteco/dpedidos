@if(sizeof($articulos) > 0)
<div class="overflow-scroll">
    <div class="table-responsive">
        <table class="table table-md table-striped">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Presentación</th>
                    <th>Precio unitario(pesos)</th>
                    <th>Cantidad</th>
                    <th>Agregar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articulos as $articulo)
                    <input type="text" name="" id="{{ 'descripcion_'.$articulo->claveArticulo }}" hidden value="{{ $articulo->descripcion }}">
                    <input type="text" name="" id="{{ 'existencia_'.$articulo->claveArticulo }}" hidden value="{{ $articulo->existencia }}">
                    <input type="text" name="" id="{{ 'clave-articulo_'.$articulo->claveArticulo }}" hidden value="{{ $articulo->claveArticulo }}">
                    <input type="text" name="" id="{{ 'iva_'.$articulo->claveArticulo }}" hidden value="{{ $articulo->iva }}">
                    <input type="text" name="" id="{{ 'ieps_'.$articulo->claveArticulo }}" hidden value="{{ $articulo->iepstipo }}">
                    <input type="text" name="" id="{{ 'iepsm_'.$articulo->claveArticulo }}" hidden value="{{ $articulo->iepsmonto }}">
                    <tr>
                        <td data-bs-toggle="modal" data-bs-target="#modal-detalle-articulo" onclick="modal_articulo_detalle('{{ $articulo->claveArticulo }}')">{{ $articulo->descripcion }}</td>
                        <td>
                            <select name="" id="{{ 'presentacion_'.$articulo->claveArticulo }}" class="form-select" onchange="seleccion_presentacion('{{ $articulo->claveArticulo }}');">
                                <option value="0">-Selecciona presentación-</option>
                                @foreach($presentaciones as $presentacion)
                                    @if($presentacion->claveArticulo == $articulo->claveArticulo)
                                        <option value="{{ $presentacion->clavePresentacion }}">{{ $presentacion->descripcion }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" name="" id="{{ 'precio_'.$articulo->claveArticulo }}" class="form-control border-0" value="{{ 0.00 }}" readonly>
                        </td>
                        <td>
                            <input type="number" name="" id="{{ 'cantidad_'.$articulo->claveArticulo }}" class="form-control" value="1">
                        </td>
                        <td class="text-center">
                            <i class="fa fa-plus" onclick="agregar_a_pedido('{{ $articulo->claveArticulo }}');"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
    Sin resultados
@endif
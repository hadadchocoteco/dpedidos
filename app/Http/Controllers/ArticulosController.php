<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function articulos(){
        $articulo = $_GET['articulo'];

        $datos['articulos'] = DB::select("SELECT
            dtArticulos.claveArticulo,
            dtArticulos.descripcion,
            dtArticulos.existencia,
            dtArticulos.moneda,
            dtArticulos.iva,
            dtArticulos.iepstipo,
            dtArticulos.iepsmonto,
            dtPresentacion.clavePresentacion,
            dtPresentacion.descripcion nompresentacion,
            CAST(dtPrecio.precio AS decimal(18,2)) precio,
            1 cant
            FROM dtArticulos
            INNER JOIN dtPresentacion ON dtPresentacion.claveArticulo = dtArticulos.claveArticulo AND dtPresentacion.clavePresentacion = dtArticulos.presentacionPrincipal
            INNER JOIN dtPrecio ON dtPrecio.clavePresentacion = dtPresentacion.clavePresentacion AND dtPrecio.noLista = 1
            WHERE dtArticulos.descripcion LIKE '%$articulo%' AND dtArticulos.estado = 'A'");

        $datos['presentaciones'] = DB::table('dtPresentacion')->get();

        return view('articulos.lista',$datos);
    }

    public function articulos_precio(){
        $clave_articulo = $_GET['clave_articulo'];
        $clave_presentacion = $_GET['clave_presentacion'];

        $precio = DB::select("SELECT * FROM dtPresentacion
            JOIN dtPrecio ON dtPrecio.clavePresentacion = dtPresentacion.clavePresentacion AND dtPrecio.noLista = 1
            WHERE dtPresentacion.claveArticulo = '$clave_articulo' AND dtPresentacion.clavePresentacion = '$clave_presentacion'");

        echo $precio[0]->precio;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

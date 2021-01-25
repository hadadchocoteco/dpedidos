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
        $datos['articulos'] = DB::raw("select * from `dtArticulos`
        INNER join `dtPresentacion` on `dtPresentacion`.`claveArticulo` = `dtArticulos`.`claveArticulo` AND `dtPresentacion`.`clavePresentacion` = `dtArticulos`.`presentacionPrincipal`
        INNER join `dtPrecio` on `dtPrecio`.`clavePresentacion` = `dtPresentacion`.`clavePresentacion` AND `dtPrecio`.`noLista` = 1
        where `dtArticulos`.`descripcion` like '%$articulo%' and `dtArticulos`.`estado` = 'A'");

        return view('articulos.lista',$datos);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pedidos.inicio');
    }

    public function cargar_pedido_temporal(){
        $datos['articulos'] = DB::select("SELECT
        id,
        dtArticulosPedidoTemp.claveArticulo,
        SUM(dtArticulosPedidoTemp.cantidad) AS cantidad,
        (costo * SUM(dtArticulosPedidoTemp.cantidad)) AS costo,
        dtArticulos.descripcion
        FROM dtArticulosPedidoTemp
        JOIN dtArticulos ON dtArticulos.claveArticulo = dtArticulosPedidoTemp.claveArticulo
        JOIN dtPresentacion ON dtPresentacion.clavePresentacion = dtArticulosPedidoTemp.clavePresentacion
        GROUP BY dtArticulosPedidoTemp.clavePresentacion,dtArticulosPedidoTemp.claveArticulo");

        return view('pedidos.pedido_temp');
    }

    public function guardar_pedido_temporal(){
        DB::table('dtarticulospedidotemp')
            ->insert([
                'claveArticulo' => $_POST['claveArticulo'],
                'clavePresentacion' => $_POST['clavePresentacion'],
                'costo' => $_POST['costo'],
                'cantidad' => $_POST['cantidad'],
                'iva' => $_POST['iva'],
                'iepsTipo' => $_POST['ieps'],
                'iepsMonto' => $_POST['iepsm'],
                'claveCliente' => $_POST['claveCliente'],
                'estatus' => 'p',
                'porcendescto' => $_POST['porcendescto']
            ]);

        echo 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datos['cliente'] = DB::table('dtclientes')
            ->select('*')
            ->where('claveCliente',$_GET['cliente'])
            ->first();

        return view('pedidos.pedido_crear',$datos);
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

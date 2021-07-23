<?php

namespace App\Http\Controllers;

use App\Models\tbOrdemCompras as OrdemCompras;
use App\Http\Resources\OrdensCompra as OrdensCompraResource;
use Illuminate\Http\Request;

class OrdemComprasController extends Controller
{
   /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $ordenscompras = OrdemCompras::paginate(10);
      return OrdensCompraResource::collection($ordenscompras);
    } catch (\Exception $e) {

      return response()->json([
        'error:' => true,
        'message:' => 'Erro no servidor',
        'error:' => $e->getMessage()
      ], 500);
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    try {
      $ordemcompra = new OrdemCompras;
      $ordemcompra->id = $request->input('id');
      $ordemcompra->solicitante = $request->input('solicitante');
      $ordemcompra->motivo = $request->input('motivo');
      $ordemcompra->km = $request->input('km');
      $ordemcompra->valor = $request->input('valor');
      $ordemcompra->tbFiliais_id = $request->input('tbFiliais_id');
      $ordemcompra->tbDepartamentos_id = $request->input('tbDepartamentos_id');
      $ordemcompra->tbUsuarios_id = $request->input('tbUsuarios_id');
      $ordemcompra->tbTipos_id = $request->input('tbTipos_id');
      $ordemcompra->tbVeiculos_id = $request->input('tbVeiculos_id');

      if (OrdemCompras::where('id', $ordemcompra->id)->count() == 0) {
        if ($ordemcompra->save()) {
          return new OrdensCompraResource($ordemcompra);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Ordem de Compra já cadastrada.'], 409);
    } catch (\Exception $e) {

      return response()->json([
        'error:' => true,
        'message:' => 'Erro no servidor',
        'error:' => $e->getMessage()
      ], 500);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {
      $ordemcompra = OrdemCompras::find($id);
      if ($ordemcompra == null) {
        return response()->json(['erro' => 1, 'message' => 'Ordem de Compra não localizada.'], 404);
      }

      return new OrdensCompraResource($ordemcompra);
    } catch (\Exception $e) {

      return response()->json([
        'error:' => true,
        'message:' => 'Erro no servidor',
        'error:' => $e->getMessage()
      ], 500);
    }
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
    try {
      $ordemcompra = OrdemCompras::findOrFail($request->id);
      $ordemcompra->id = $request->input('id');
      $ordemcompra->solicitante = $request->input('solicitante');
      $ordemcompra->motivo = $request->input('motivo');
      $ordemcompra->valor = $request->input('valor');
      $ordemcompra->tbFiliais_id = $request->input('tbFiliais_id');
      $ordemcompra->tbDepartamentos_id = $request->input('tbDepartamentos_id');
      $ordemcompra->tbUsuarios_id = $request->input('tbUsuarios_id');
      $ordemcompra->tbTipos_id = $request->input('tbTipos_id');
      $ordemcompra->tbPlacas_id = $request->input('tbPlacas_id');

      if ($ordemcompra->save()) {
        return new OrdensCompraResource($ordemcompra);
      }
    } catch (\Exception $e) {

      return response()->json([
        'error:' => true,
        'message:' => 'Erro no servidor',
        'error:' => $e->getMessage()
      ], 500);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    try {
      $ordemcompra = OrdemCompras::find($id);

      if ($ordemcompra == null) {
        return response()->json(['erro' => 1, 'message' => 'Ordem de Compra não localizada.'], 404);
      }

      if ($ordemcompra->delete()) {
        return response()->json(['erro' => false, 'message' => 'Ordem de Compra excluída com sucesso'], 200);
      }
    } catch (\Exception $e) {

      return response()->json([
        'error:' => true,
        'message:' => 'Erro no servidor',
        'error:' => $e->getMessage()
      ], 500);
    }
  }
}

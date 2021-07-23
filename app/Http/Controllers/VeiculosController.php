<?php

namespace App\Http\Controllers;

use App\Models\tbVeiculos as Veiculos;
use App\Http\Resources\Veiculo as VeiculoResource;
use Illuminate\Http\Request;

class VeiculosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $veiculos = Veiculos::paginate(10);
      return VeiculoResource::collection($veiculos);
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
      $veiculo = new Veiculos;
      $veiculo->id = $request->input('id');
      $veiculo->placa = $request->input('placa');
      $veiculo->veiculo = $request->input('veiculo');
      $veiculo->renavan = $request->input('renavan');
      $veiculo->vencimento = $request->input('vencimento');
      $veiculo->valor_doc = $request->input('valor_doc');
      $veiculo->responsavel = $request->input('responsavel');
      $veiculo->ano_modelo = $request->input('ano_modelo');
      $veiculo->uf = $request->input('uf');
      $veiculo->fipe = $request->input('fipe');
      $veiculo->tbDepartamentos_id = $request->input('tbDepartamentos_id');
      $veiculo->tbFiliais_id = $request->input('tbFiliais_id');

      if (Veiculos::where('placa', $veiculo->placa)->count() == 0) {
        if ($veiculo->save()) {
          return new VeiculoResource($veiculo);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Placa já cadastrada.'], 409);
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
      $veiculo = Veiculos::find($id);
      if ($veiculo == null) {
        return response()->json(['erro' => 1, 'message' => 'Placa não localizada.'], 404);
      }

      return new VeiculoResource($veiculo);
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
      $veiculo = Veiculos::findOrFail($request->id);
      $veiculo->placa = $request->input('placa');
      $veiculo->veiculo = $request->input('veiculo');
      $veiculo->renavan = $request->input('renavan');
      $veiculo->vencimento = $request->input('vencimento');
      $veiculo->valor_doc = $request->input('valor_doc');
      $veiculo->responsavel = $request->input('responsavel');
      $veiculo->ano_modelo = $request->input('ano_modelo');
      $veiculo->uf = $request->input('uf');
      $veiculo->fipe = $request->input('fipe');
      $veiculo->tbDepartamentos_id = $request->input('tbDepartamentos_id');
      $veiculo->tbFiliais_id = $request->input('tbFiliais_id');

      if ($veiculo->save()) {
        return new VeiculoResource($veiculo);
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
      $veiculo = Veiculos::find($id);

      if ($veiculo == null) {
        return response()->json(['erro' => 1, 'message' => 'Placa não localizada'], 404);
      }

      if ($veiculo->delete()) {
        return response()->json(['erro' => false, 'message' => 'Placa excluída com sucesso.'], 200);
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

<?php

namespace App\Http\Controllers;

use App\Models\tbTipos as Tipos;
use App\Http\Resources\Tipo as TipoResource;
use Illuminate\Http\Request;

class TiposController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $tipos = Tipos::paginate(10);
      return TipoResource::collection($tipos);
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
      $tipo = new Tipos;
      $tipo->id = $request->input('id');
      $tipo->nome = $request->input('nome');
      $tipo->descricao = $request->input('descricao');

      if (Tipos::where('nome', $tipo->nome)->count() == 0) {
        if ($tipo->save()) {
          return new TipoResource($tipo);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Tipo já cadastrado'], 409);
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
      $tipo = Tipos::find($id);
      if ($tipo == null) {
        return response()->json(['erro' => 1, 'message' => 'Tipo não localizado'], 404);
      }

      return new TipoResource($tipo);
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
      $tipo = Tipos::findOrFail($request->id);
      // $tipo->id = $request->input('id');
      $tipo->nome = $request->input('nome');
      $tipo->descricao = $request->input('descricao');

      if ($tipo->save()) {
        return new TipoResource($tipo);
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
      $tipo = Tipos::find($id);

      if ($tipo == null) {
        return response()->json(['erro' => 1, 'message' => 'Tipo não localizado'], 404);
      }

      if ($tipo->delete()) {
        return response()->json(['erro' => false, 'message' => 'Tipo excluído com sucesso'], 200);
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

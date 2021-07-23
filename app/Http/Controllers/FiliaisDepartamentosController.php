<?php

namespace App\Http\Controllers;

use App\Models\tbFiliaisDepartamentos as FiliaisDepartamentos;
use App\Http\Resources\FilialDepartamento as FilialDepartamentoResource;
use Illuminate\Http\Request;

class FiliaisDepartamentosController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $filiaisdepartamentos = FiliaisDepartamentos::paginate(10);
      return FilialDepartamentoResource::collection($filiaisdepartamentos);
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
      $filialdepartamento = new FiliaisDepartamentos;
      $filialdepartamento->id = $request->input('id');
      $filialdepartamento->nome = $request->input('nome');
      $filialdepartamento->descricao = $request->input('descricao');

      if (FiliaisDepartamentos::where('nome', $filialdepartamento->nome)->count() == 0) {
        if ($filialdepartamento->save()) {
          return new FilialDepartamentoResource($filialdepartamento);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Código já cadastrado'], 409);
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
      $filialdepartamento = FiliaisDepartamentos::find($id);
      if ($filialdepartamento == null) {
        return response()->json(['erro' => 1, 'message' => 'Nivel não localizado'], 404);
      }

      return new FilialDepartamentoResource($filialdepartamento);
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
      $filialdepartamento = FiliaisDepartamentos::findOrFail($request->id);
      $filialdepartamento->nome = $request->input('nome');
      $filialdepartamento->descricao = $request->input('descricao');

      if ($filialdepartamento->save()) {
        return new FilialDepartamentoResource($filialdepartamento);
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
      $filialdepartamento = FiliaisDepartamentos::find($id);

      if ($filialdepartamento == null) {
        return response()->json(['erro' => 1, 'message' => 'Nível não localizado'], 404);
      }

      if ($filialdepartamento->delete()) {
        return response()->json(['erro' => false, 'message' => 'Nível excluído com sucesso'], 200);
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

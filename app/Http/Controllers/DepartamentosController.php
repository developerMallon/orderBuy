<?php

namespace App\Http\Controllers;

use App\Models\tbDepartamentos as Departamentos;
use App\Http\Resources\Departamento as DepartamentoResource;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $departamentos = Departamentos::paginate(10);
      return DepartamentoResource::collection($departamentos);
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
      $departamento = new Departamentos;
      $departamento->id = $request->input('id');
      $departamento->nome = $request->input('nome');
      $departamento->descricao = $request->input('descricao');

      if (Departamentos::where('nome', $departamento->nome)->count() == 0) {
        if ($departamento->save()) {
          return new DepartamentoResource($departamento);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Departamento já cadastrado'], 409);
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
      $departamento = Departamentos::find($id);
      if ($departamento == null) {
        return response()->json(['erro' => 1, 'message' => 'Departamento não localizado'], 404);
      }

      return new DepartamentoResource($departamento);
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
      $departamento = Departamentos::findOrFail($request->id);
      $departamento->nome = $request->input('nome');
      $departamento->descricao = $request->input('descricao');

      if ($departamento->save()) {
        return new DepartamentoResource($departamento);
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
      $departamento = Departamentos::find($id);

      if ($departamento == null) {
        return response()->json(['erro' => 1, 'message' => 'Departamento não localizado'], 404);
      }

      if ($departamento->delete()) {
        return response()->json(['erro' => false, 'message' => 'Departamento excluído com sucesso'], 200);
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

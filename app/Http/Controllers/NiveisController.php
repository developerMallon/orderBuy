<?php

namespace App\Http\Controllers;

use App\Models\tbNiveis as Niveis;
use App\Http\Resources\Nivel as NivelResource;
use Illuminate\Http\Request;

class NiveisController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $niveis = Niveis::paginate(10);
      return NivelResource::collection($niveis);
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
      $nivel = new Niveis;
      $nivel->id = $request->input('id');
      $nivel->codigo = $request->input('codigo');
      $nivel->descricao = $request->input('descricao');

      if (Niveis::where('codigo', $nivel->codigo)->count() == 0) {
        if ($nivel->save()) {
          return new NivelResource($nivel);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Nível já cadastrado'], 409);
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
  public function show($codigo)
  {
    try {
      $nivel = Niveis::where('codigo', $codigo)->first();
      if ($nivel == null) {
        return response()->json(['erro' => 1, 'message' => 'Nivel não localizado'], 404);
      }

      return new NivelResource($nivel);
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
  public function update(Request $request)
  {
    try {
      $nivel = Niveis::where('codigo', $request->input('codigo'))->first();
      if ($nivel == null) {
        return response()->json(['erro' => 1, 'message' => 'Nível não localizado'], 404);
      }
      // $nivel->id = $request->input('id');
      $nivel->codigo = $request->input('codigo');
      $nivel->descricao = $request->input('descricao');

      if ($nivel->save()) {
        return new NivelResource($nivel);
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
  public function destroy($codigo)
  {
    try {
      $nivel = Niveis::where('codigo', $codigo)->first();
      if ($nivel == null) {
        return response()->json(['erro' => 1, 'message' => 'Nível não localizado'], 404);
      }

      if ($nivel->delete()) {
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

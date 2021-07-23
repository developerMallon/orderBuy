<?php

namespace App\Http\Controllers;

use App\Models\tbFiliais as Filiais;
use App\Http\Resources\Filial as FilialResource;
use Illuminate\Http\Request;

class FiliaisController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $filiais = Filiais::paginate(10);
      return FilialResource::collection($filiais);
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
      $filial = new Filiais;
      $filial->id = $request->input('id');
      $filial->nome = $request->input('nome');
      $filial->cnpj = $request->input('cnpj');
      $filial->ie = $request->input('ie');
      $filial->rua = $request->input('rua');
      $filial->numero = $request->input('numero');
      $filial->bairro = $request->input('bairro');
      $filial->cidade = $request->input('cidade');
      $filial->uf = $request->input('uf');
      $filial->obs = $request->input('obs');

      if ($filial->save()) {
        return new FilialResource($filial);
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
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    try {

      $filial = Filiais::find($id);
      if ($filial == null) {
        return response()->json(['erro' => 1, 'message' => 'Filial não localizada.'], 404);
      }

      return new FilialResource($filial);

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
      $filial = Filiais::findOrFail($request->id);
      $filial->nome = $request->input('nome');
      $filial->cnpj = $request->input('cnpj');
      $filial->rua = $request->input('rua');
      $filial->numero = $request->input('numero');
      $filial->bairro = $request->input('bairro');
      $filial->cidade = $request->input('cidade');
      $filial->uf = $request->input('uf');
      $filial->obs = $request->input('obs');

      if ($filial->save()) {
        return new FilialResource($filial);
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
      $filial = Filiais::where('id', $id)->first();
      if ($filial == null) {
        return response()->json(['erro' => 1, 'message' => 'Filial não localizada.'], 404);
      }
      // $filial = Filiais::findOrFail($id);
      if ($filial->delete()) {
        return new FilialResource($filial);
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

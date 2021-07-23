<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\tbClientes as Clientes;
use \App\Http\Resources\Cliente as ClienteResource;

class ClientesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $clientes = Clientes::paginate(10);
      return ClienteResource::collection($clientes);
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
      $cliente = new Clientes;
      $cliente->id = $request->input('id');
      $cliente->nome = $request->input('nome');
      $cliente->email = $request->input('email');
      $cliente->telefone = $request->input('telefone');

      if (Clientes::where('email', $cliente->email)->count() == 0) {
        if ($cliente->save()) {
          return new ClienteResource($cliente);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Email já cadastrado'], 409);
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
  public function show($email)
  {
    try {
      // $cliente = Clientes::find($id);
      $cliente = Clientes::where('email', $email)->first();
      if ($cliente == null) {
        return response()->json(['erro' => 1, 'message' => 'Cliente não localizado'], 404);
      }

      return new ClienteResource($cliente);
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
      $cliente = Clientes::findOrFail($request->id);
      $cliente->nome = $request->input('nome');
      $cliente->email = $request->input('email');
      $cliente->telefone = $request->input('telefone');

      if ($cliente->save()) {
        return new ClienteResource($cliente);
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
      $cliente = Clientes::find($id);

      if ($cliente == null) {
        return response()->json(['erro' => 1, 'message' => 'Cliente não localizado'], 404);
      }

      if ($cliente->delete()) {
        return response()->json(['erro' => false, 'message' => 'Cliente excluído com sucesso'], 200);
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

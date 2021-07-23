<?php

namespace App\Http\Controllers;

use App\Models\tbUsuarios as Usuarios;
use App\Http\Resources\Usuario as UsuarioResource;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    try {
      $usuarios = Usuarios::paginate(10);
      return UsuarioResource::collection($usuarios);
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
      $usuarios = new Usuarios;
      $usuarios->id = $request->input('id');
      $usuarios->nome = $request->input('nome');
      $usuarios->email = $request->input('email');
      $usuarios->email_verified_at = $request->input('email_verified_at');
      $usuarios->senha = $request->input('senha');
      $usuarios->remember_token = $request->input('remember_token');
      $usuarios->tbFiliais_id = $request->input('tbFiliais_id');
      $usuarios->tbDepartamentos_id = $request->input('tbDepartamentos_id');
      $usuarios->tbNiveis_id = $request->input('tbNiveis_id');

      if (Usuarios::where('id', $usuarios->id)->count() == 0) {
        if ($usuarios->save()) {
          return new UsuarioResource($usuarios);
        }
      }

      return response()->json(['erro' => 1, 'message' => 'Login já cadastrado'], 409);
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
      $usuarios = Usuarios::find($id);
      if ($usuarios == null) {
        return response()->json(['erro' => 1, 'message' => 'Login não localizado'], 404);
      }

      return new UsuarioResource($usuarios);
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
      $usuarios = Usuarios::findOrFail($request->id);
      $usuarios->nome = $request->input('nome');
      $usuarios->email = $request->input('email');
      $usuarios->email_verified_at = $request->input('email_verified_at');
      $usuarios->senha = $request->input('senha');
      $usuarios->remember_token = $request->input('remember_token');
      $usuarios->tbNiveis_id = $request->input('tbNiveis_id');

      if ($usuarios->save()) {
        return new UsuarioResource($usuarios);
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
      $usuarios = Usuarios::find($id);

      if ($usuarios == null) {
        return response()->json(['erro' => 1, 'message' => 'Login não localizado'], 404);
      }

      if ($usuarios->delete()) {
        return response()->json(['erro' => false, 'message' => 'Login excluído com sucesso'], 200);
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

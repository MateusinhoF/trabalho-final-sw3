<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\TipoDeUsuario;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            return $this->redirectUsuario();
        }
        return view('acesso/login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::check()){
            return $this->redirectUsuario();
        }
        $tipos = TipoDeUsuario::all();
        return view('acesso/registrese', ['tipoDeUsuario'=>$tipos]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'cidade'=>'required',
            'bairro'=>'required',
            'rua'=>'required',
            'numero'=>'required',
            'tipo_de_usuario'=>'required'
        ]);
        $endereco = $request->only('cidade','bairro','rua','numero');
        $tipodeusuario = $request->only('tipo_de_usuario');
        $usuario = $request->only('name','password','email');

        try{
            $novoEndereco = Endereco::create($endereco);
        }
        catch(Exception $e){
            return $errors = $e->getMessage();
        }

        $usuario = [
            'name'=>$usuario['name'],
            'password'=>$usuario['password'],
            'email'=>$usuario['email'],
            'endereco_id'=>$novoEndereco['id'],
            'tipo_de_usuario_id'=>$tipodeusuario['tipo_de_usuario'],
        ];

        try{
            User::create($usuario);
        }
        catch(Exception $e){
            return $errors = $e->getMessage();
        }

        return redirect(route('login'));
    }


    public function logar(Request $request){
        
        $validator = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $validate = Auth::attempt($validator);

        if($validate){
            return $this->redirectUsuario();
        }
    }

    private function redirectUsuario(){
        $user = Auth::user();
        $tipo = TipoDeUsuario::all()->where('id','=',$user['tipo_de_usuario_id']);

        $tipo = $tipo->pluck('tipo');
        if($tipo[0] == 'vendedor' || $tipo[0] == 'admin'){
            return redirect(route('vendedor.index'));
        }
        else{
            return redirect(route('comprador.index'));
        }
        
    }

    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

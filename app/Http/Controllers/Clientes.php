<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Clientes extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'nome' =>'required|string|max:255|min:4',
            'email' => 'required|string|max:255|min:10',
            'telefone' => 'required|numeric',
            
        ]);

        if($validator->fails()) {
            $error = $validator->errors();
            return response()->json($error, 400);

        } else {
            Cliente::create([
                'nome' =>$request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone
            ]);
            return response()->json("Cliente adicionado com sucesso!", 200);
        }
        
    }

    public function list(){
        $clientes = Cliente::get()->toJson(JSON_PRETTY_PRINT);
        return response($clientes, 200);
    }

    public function delete($id){
        Cliente::where('id',$id)->delete();
        return response()->json("Cliente deletado com sucesso!", 200);
    }
}

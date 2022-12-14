<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Carros extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'modelo' =>'required|string|max:255|min:4',
            'ano' => 'required|numeric|max:2022',
            'marca' => 'required|string|max:255|min:4',
            'status' => 'required|string|max:10',
            'valor' => 'required|numeric'
               
        ]);

        if($validator->fails()) {
            $error = $validator->errors();
            return response()->json($error, 400);

        } else {
            $status = $request->status;
            if($status != "seminovo" && $status != "novo" && $status != "usado"){
                $erro ="Erro, apenas os status \"seminovo\",  \"novo\" e \"usado\" são suportados, você digitou:".$status."";
                return response()->json($erro, 400);
            }

            else{
                Carro::create([
                    'modelo' =>$request->modelo,
                    'ano' => $request->ano,
                    'marca' => $request->marca,
                    'status' => $request->status,
                    'valor' => $request->valor
                ]);

                return response()->json("Carro adicionado com sucesso!", 200);
            }


        }
        
    }

    public function list(){
        $lista = Carro::get()->toJson(JSON_PRETTY_PRINT);
        return response($lista, 200);
    }


    public function delete($id){

        $carro = Carro::where('id',$id)->first();
        $carroVendido = $carro['vendido'];

        if($carroVendido == "sim"){
            return response()->json("Não é permitido deletar um carro vendido", 403);

        } else {
            Carro::where('id',$id)->delete();
            return response()->json("Carro deletado com sucesso!", 200);
        }
        
        
    }

    public function show($id){
        $carro = Carro::where('id', $id)->first();

        return response()->json($carro, 200);
    }

    
}

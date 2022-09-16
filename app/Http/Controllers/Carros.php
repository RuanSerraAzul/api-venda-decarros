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
            if($status != "seminovo" || $status != "novo" || $status != "usado"){
                $erro ="Erro, apenas os status \"seminovo\",  \"novo\" e \"usado\" são suportados ";
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

}

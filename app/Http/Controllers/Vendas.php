<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Vendas extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'clienteId' =>'required|numeric',
            'carroId' => 'required|numeric|',
            'pagamento' => 'required|string|max:255|min:4',
        ]);

        if($validator->fails()) {
            $error = $validator->errors();
            return response()->json($error, 400);

        } else {
            $pagamento = $request->forma_pagamento;

            $metodos = ["credito", "debito", "parcelado", "a vista", "consorcio"];

            $verificaMetodo = array_search($pagamento,$metodos);

            if($verificaMetodo==""){

                $error = "Método de pagamento não suportado, os métodos de pagamento suportados são 
                credito, debito, parcelado, a vista e consorcio" ; 

                return response()->json($error, 400);

            } else {
                $vendedorId = Auth::user()->id;
                

                Venda::create([
                    'id_vendedor' => $vendedorId,
                    'id_cliente' => $request->clienteId,
                    'id_carro' =>$request->carroId,
                    'forma_pagamento' => $pagamento
                ]);

                return response()->json("Venda adicionada com sucesso!", 200);

            }


        }
    }
}

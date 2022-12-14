<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Cliente;
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
            'forma_pagamento' => 'required|string|max:255|min:4',
        ]);



        if($validator->fails()) {
            $error = $validator->errors();
            return response()->json($error, 400);

        } else {
            $pagamento = $request->forma_pagamento;

            $metodos = ["credito", "debito", "parcelado", "a vista", "consorcio"];

            $verificaMetodo = array_search($pagamento,$metodos);

            if($verificaMetodo===""){

                $error = "Método de pagamento não suportado, os métodos de pagamento suportados são: credito, debito, parcelado, a vista e consorcio" ; 

                return response()->json($error, 400);

            } else {
                $vendedorId = Auth::user()->id;
                

                Venda::create([
                    'id_vendedor' => $vendedorId,
                    'id_cliente' => $request->clienteId,
                    'id_carro' =>$request->carroId,
                    'forma_pagamento' => $pagamento
                ]);

                $carro = Carro::find($request->carroId);

                $carro->vendido = 'sim';

                $carro->save();

                $cliente = Cliente::find($request->clienteId);

                $cliente->compras +=1;

                $cliente->save();


                return response()->json("Venda adicionada com sucesso!", 200);

            }


        }
    }

    public function list(){
        $vendas = Venda::get()->toJson(JSON_PRETTY_PRINT);

        return response($vendas, 200);
    }

    public function show($id){
        $venda = Venda::where('id', $id)->first();

        return response()->json($venda, 200);
    }
}

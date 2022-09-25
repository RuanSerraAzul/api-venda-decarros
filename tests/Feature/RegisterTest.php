<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class register extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $response = $this->get('/');
        $baseUrl= "http://localhost:8000/api/register";

        $nome = "teste ferreira dos santos";
        $email = "usuario@teste.com.br";
        $senha = "senha123";

        $response = $this->json('POST', $baseUrl . '/', [
            'nome' => $nome,
            'email' => $email,
            'password' => $senha
        ]);

        $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'authorization', 'status', 'user'
        ]);
    }

    public function testLogin(){
        $response = $this->get('/');
        $baseUrl= "http://localhost:8000/api/login";

        $email = "usuario@teste.com.br";
        $senha = "senha123";

        $response = $this->json('POST', $baseUrl . '/', [
            'email' => $email,
            'password' => $senha

        ]);

        $response
        ->assertStatus(200)
        ->assertJsonStructure([
            'access_token', 'token_type', 'expires_in'
        ]);


    }
}

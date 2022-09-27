<h1 align="left">API venda de carros</h1>

<p align="left">Este projeto é uma REST API, que usa Laravel e MySQL, para realizar operações com vendodores, clientes, carros e vendas, onde o vendedor é um usúario autenticado(e é possivel acessar as rotas e a API somente com autenticação), que realiza os processos de criar, editar, excluir listar clientes, carros e vendas.</p>

<!--ts-->

-   [Sobre](#Sobre)
-   [Instalação](#instalacao)
-   [Como usar](#como-usar)
    -   [Vendedores](#vendedores)
    -   [Clientes](#clientes)
    -   [Carros](#carros)
    -   [Vendas](#vendas)

## Sobre

Este projeto é uma idéia que veio ao fazer meu último projeto, a idéia é fazer uma API parecida com a que fiz para o Code challenge do Jornal O POVO, porém usando funções e features um pouco mais específicas, e também para trabalhar com testes unitarios envolvendo o uso do token JWT (ainda está em andamento).<br>
Optei por usar o Laravel, pela sua forte documentação, o que facilita na sua resolução de problemas, além de gostar bastante da sua organização, do padrão de arquitetura MVC, das suas várias ferramentas que facilitam bastante a escrita do código, e também por causa da sua sintaxe elegante.<br>
Como banco de dados usei o MySQL, pois é o banco de dados que mais trabalhei durante minha carreira como desenvolvedor, o que tornou o desenvolvimento mais fácil, pois já possuo conhecimento em MySQL. Provavelmente farei uma outra versão desse projeto usando PostgreSQL<br>
Optei por usar JSON para receber e enviar dados. Para a autenticação foi usado JWT(JSON Web Token) pois desejo adquirir mais conhecimento nesse tipo de autenticação. Provalvelmente haverá uma nova versão desse projeto, onde o JWT será substituido pelo Sancutm (autenticador nativo do laravel).posteriormente<br>

## Instalação

### Requisitos

-Docker

### Como instalar

Baixe este projeto e o descompacte.<br>

Copiamos o .env.example como nosso .env principal<br>
**cp .env.example .env**

Navegue até o diretório do projeto e use<br>
**docker-compose build app**

Use este comando para executar os containers:<br>
**docker-compose up -d**

Agora, vamos executar o composer install para instalar as dependências do aplicativo:<br>
**docker-compose exec app composer install**

Rodaremos as nossas migrations para criar as tabelas do nosso banco de dados<br>
**docker-compose exec app php artisan migrate**

(Opcional) Foi inserido um pequeno seeder com apenas um úsuario para testar a rota de login<br>
**docker-compose exec app php artisan db:seed**

Primeiro precisamos criar a chave da nossa aplicação usando:<br>
**docker-compose exec app php artisan key:generate**

Neste passo iremos criar a chave do nosso JWT usando:<br>
**docker-compose exec app php artisan jwt:secret**

(Opcional) Caso tenha optado por usar o db:seeder para fazer o teste unitario usaremos:<br>
**docker-compose exec app php artisan test**

# Como Usar

## Vendedores

### Registrar

Para registrar vendedores acessamos a rota: /api/register usando o método POST, e enviamos as informações no seguinte formato:<br>
Header:
```javascript

    {
        "Accept":"application/json"
    }

 ```
<br>

Body
```javascript

    {
        "nome" : "Carlos Cesar",
        "email": "cesarsantos@gmail.com",
        "password": "senhateste1990"
    }
```
<br>

A aplicação retornará o status code 200, e um token (falaremos sobre ele em seguida) para acessar funções que apenas usuarios autenticados podem acessar, caso os dados sejam inseridos corretamente. 
Importante: o e-mail é um dado único, isso quer dizer que apenas um úsuario tem um e-mail registrado, não havendo assim dois ou mais úsuarios com o mesmo e-mail.


### Token

O token é gerado pelo autenticador JWT, e tem o tempo de expiração padrão de 20 minutos, portanto a cada 20 minutos é necessário logar em seu usuario para obter um novo token.
O formato do Token é parecido com este: 
``` javascript
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY2MjMyNDk4NCwiZXhwIjoxNjYyMzI4NTg0LCJuYmYiOjE2NjIzMjQ5ODQsImp0aSI6ImtmeFo4QnV1SHRsWDdWUUciLCJzdWIiOjIsInBydiI6IjdiMzcxY2U0NDVkMWMwNjdiOWM2ZWNiZDYxM2M1MTkwMWFlZjA1M2IifQ.TO_0wgTMWt79mS885Xm9iE5tpGk5Jk8-EOuUH-29T9o
```

 <br>

Declararemos ele no Header da requisição para ter acesso aos próximos passos (exceto login, afinal não é possível esta rota ser autenticada, qualquer um pode precisar logar-se, o mesmo vale para a rota de registro) da seguinte forma:

Header:
```javascript

    {
        "Accept":"application/json",
        "Authorization" : "Beaver eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY2MjMyNDk4NCwiZXhwIjoxNjYyMzI4NTg0LCJuYmYiOjE2NjIzMjQ5ODQsImp0aSI6ImtmeFo4QnV1SHRsWDdWUUciLCJzdWIiOjIsInBydiI6IjdiMzcxY2U0NDVkMWMwNjdiOWM2ZWNiZDYxM2M1MTkwMWFlZjA1M2IifQ.TO_0wgTMWt79mS885Xm9iE5tpGk5Jk8-EOuUH-29T9o"
    }

```
Lembre-se de fazer isso para todas as próximas rotas(exceto login)<br>

### Login
Para logarmos com nosso usuario basta acessar a rota /api/login usando o método POST com os dados do nosso usúario no corpo da requisição da seguinte formato:

```javascript

    {
        "email": "cesarsantos@gmail.com",
        "password": "senhateste1990"
    }

```

Após feito o login, precisaremos colocar nosso token no header da requisição da seguinte forma:

```javascript

        {
        "Accept":"application/json",
        "Authorization" : "Beaver eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTY2MjMyNDk4NCwiZXhwIjoxNjYyMzI4NTg0LCJuYmYiOjE2NjIzMjQ5ODQsImp0aSI6ImtmeFo4QnV1SHRsWDdWUUciLCJzdWIiOjIsInBydiI6IjdiMzcxY2U0NDVkMWMwNjdiOWM2ZWNiZDYxM2M1MTkwMWFlZjA1M2IifQ.TO_0wgTMWt79mS885Xm9iE5tpGk5Jk8-EOuUH-29T9o"
    }

```

### Informações sobre o úsuario

Acessar a rota /api/me usando o método GET retorna os dados do usuario logado(o hash da senha estará omitido).<br>

## Clientes

### Criando um novo clientes

Para criar um novo cliente devemos acessar a rota "api/clientes/create", e preencher o corpo da requisição com os seguintes dados: 
``` javascript
{
    "nome":"juliano rocha souza",
    "email": "juliano123@gmail.com",
    "telefone": "85986253213"
}
```
Se os dados forem inseridos corretamente a aplicação retornará o status code 200, e uma mensagem dizendo que a operação foi feita com sucesso.

### Listar clientes

Para listar os clientes basta acessar a rota "/api/clientes/lista", e a aplicação retornará um JSON com os seguintes dados:
```javascript
{
    ["id":1,
    "nome":"carlos souza",
    "email": "carlos@gmail.com",
    "telefone" : "85986175623"
    "compras" : 1
    ]

}
```
Além do status code 200.

### Deletar clientes
Atenção, apenas clientes que ainda não fizeram compras podem ser deletados, pois precisamos dos dados de todos que já compraram conosco. Para deletar basta acessar a rota "/api/clientes/delete/{id}" onde {id} é o id do cliente que queremos deletar. Feito isso a aplicação nos retornará um status code 200, e uma mensagem de sucesso.


## Carros

### Registrar Carros

Para registrar um novo carro devemos acessar a rota "api/carros/create", e preencher o corpo da requisição com os seguintes dados: 
``` javascript
{
    "modelo":"Onix Joy",
    "ano": "2018",
    "marca": "chevrolet",
    "status": "seminovo",
    "valor": "50000.00"
}
```
Se os dados forem inseridos corretamente a aplicação retornará o status code 200, e uma mensagem dizendo que a operação foi feita com sucesso.

### Listar carros

Para listar os carros basta acessar a rota "/api/carros/lista", e a aplicação retornará um JSON com os seguintes dados:

``` javascript
{
    "modelo":"Onix Joy",
    "ano": "2018",
    "marca": "chevrolet",
    "status": "seminovo",
    "valor": "50000.00",
    "vendido": "sim"
}
```

### Deletar Carros
Atenção, não é possivel deletar carros que já foram vendidos. Para deletar basta acessar a rota "/api/carros/delete/{id}" onde {id} é o id do carro que queremos deletar. Feito isso a aplicação nos retornará um status code 200, e uma mensagem de sucesso.

## Vendas

### Registrar Venda
Atenção, não é possivel registrar a venda de um carro que ja foi vendido. Para registrar uma nova venda devemos acessar a rota "api/vendas/create", e preencher o corpo da requisição com os seguintes dados:

``` javascript
{
    "id_cliente":2,
    "id_carro": 1,
    "forma_pagamento": "credito"
}
```
Feito isso a aplicação nos retornará um status code 200, e uma mensagem de sucesso. A aplicação informará quais as formas de pagamento serão aceitas.

### Visualizar venda
Para visualizar uma venda acessaremos a rota "/vendas/ver/{id}", onde {id} é o id da venda que desejamos visualizar. Será retornado um JSON com as seguintes informações:

``` javascript
{
    "id":1,
    "id_vendedor": 1,
    "id_cliente":2,
    "id_carro": 1,
    "forma_pagamento": "credito"
}
```
### Listar Vendas

Para listar todas as vendas acessaremos a rota "/api/vendas/lista", que nos retornará um JSON com o seguinte formato:

``` javascript
{
    ["id":1,
    "id_vendedor": 1,
    "id_cliente":2,
    "id_carro": 1,
    "forma_pagamento": "credito"],
    [
    "id":13,
    "id_vendedor": 11,
    "id_cliente":24,
    "id_carro": 11,
    "forma_pagamento": "dinheiro"]
}
```
    

# TravelEase

## Autoras
- [Juliana Girotto Leite](https://github.com/jjgirotto)
- [Kamily de Souza Gracia](https://github.com/Kamilyszg)

## Sobre
O projeto consiste em um sistema web para gerenciamento de viagens e pacotes de viagens. A aplicação é construída com Laravel, um poderoso framework PHP, e utiliza MySQL para gerenciamento de banco de dados relacional. A funcionalidade principal do sistema inclui o registro de clientes, gerenciamento de orçamentos para viagens e compra de passagens. A aplicação também possui um sistema de notificações para alertar os usuários sobre a emissão das passagens.

## Modelagem Entidade Relacional
![Modelagem Entidade Relacional](/image/mer.png)

## Tecnologias utilizadas
- **PHP**: Uma linguagem de programação amplamente utilizada para desenvolvimento web no lado do servidor.
- **Laravel**: Um framework PHP para construção de aplicações web modernas com sintaxe elegante, oferecendo recursos integrados como roteamento, autenticação, e gestão de banco de dados.
- **MySQL**: Sistema de gerenciamento de banco de dados relacional amplamente utilizado para armazenar e gerenciar dados em aplicações web.
- **Bootstrap**: Um framework front-end que facilita a criação de layouts responsivos e modernos, com uma vasta coleção de componentes prontos para uso, como botões, formulários, e barras de navegação.
- **HTML**: Linguagem de marcação utilizada para estruturar o conteúdo da web, permitindo a criação de páginas e componentes de interface de usuário.

**IDE: Visual Studio Code**

## Requisitos

Para utilizar o projeto na sua máquina, é necessário ter as seguintes ferramentas instaladas e configuradas:

- PHP
- Composer
- MySql ou PHPMyAdmin

## Guia de instalação

Siga os passos abaixo para baixar, configurar e executar o projeto no seu ambiente:
1. Clone o repositório:
```bash
git clone https://github.com/jjgirotto/project-travel-ease.git
cd travel-ease
composer update
```
2. Configure o arquivo `.env`: Configure as credenciais de acordo com o seu banco de dados MySQL:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```
As migrações do Laravel criarão automaticamente as tabelas no MySQL. Caso haja alterações no banco de dados, utilize o comando de migração para manter a estrutura atualizada.

3. Execute as migrações do banco de dados com `php artisan migrate`

4. Execute o servidor local com `php artisan serve`

## Consumo
1. Ao executar `php artisan serve`, acesse o link indicado: http://127.0.0.1:8000
2. Utilize as URLS da tabela abaixo para acesso de cada endpoint.

## Endpoints

| Categoria |Método HTTP| Endpoint        | Ação                       |
|-----------|-----------|-----------------|----------------------------|
| Cliente   | POST      | /clientes/create| Cadastra um novo cliente   |
| Cliente   | PUT       | /clientes/{id}/edit/| Altera um cliente  |
| Cliente   | DELETE    | /clientes/{id}| Consulta e exclui um cliente|
| Orçamento | POST      | /orcamentos/create| Cadastra um novo orçamento |
| Orçamento | PUT       | /orcamentos/{id}/edit/| Altera um orçamento|
| Orçamento | DELETE    | /orcamentos/{id}| Consulta e exclui um orçamento|
| Viagem    | POST      | /viagens/create| Cadastra uma nova viagem   |
| Viagem    | PUT       | /viagens/{id}/edit/| Altera uma viagem  |
| Viagem    | DELETE    | /viagens/{id}| Consulta e exclui uma viagem|
| Pacote de viagem | POST | /pacoteViagens/create| Cadastra um novo pacote de viagem |
| Pacote de viagem | PUT | /pacoteViagens/{id}/edit/| Altera um pacote de viagem|
| Pacote de viagem | DELETE | /pacoteViagens/{id}| Consulta e exclui um pacote de viagem|
| Passagem  | POST      | /passagens/create| Cadastra uma nova passagem   |
| Passagem  | PUT       | /passagens/{id}/edit/| Altera uma passagem  |
| Passagem  | DELETE    | /passagens/{id}| Consulta e exclui uma passagem|

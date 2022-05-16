# Lista de contatos (API)
Teste referente a processo seletivo, envio ao GitHub solicitado pela empresa.

* Lista de contatos
* Criar contato
* Atualizar contato
* Deletar contato
* Buscar contato

## Instalação

```bash
$ git clone https://github.com/rafaelrj/lista-de-contatos-API.git

$ cd https://github.com/rafaelrj/lista-de-contatos-API

$ composer install
```

Renomear ou copiar o arquivo **.env.example** para **.env**

Criar um bando de dados no MySQL, exemplo: **CREATE DATABASE api_laravel;**

Configurar o arquivo **.env** conforme mostrado abaixo:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=api_laravel
DB_USERNAME=<seu_nome_de_usuario>
DB_PASSWORD=<sua_senha_de_acesso>
```

Executar o comando para criar as tabelas no banco de dados:

```bash
$ php artisan migrate
```

Gerar a **key** do laravel:

```bash
$ php artisan key:generate
```

Instalar o passport (gerar as chaves de criptografia para tokens de acesso):

```bash
$ php artisan passport:install
```

Iniciar o servidor:

```bash
$ php artisan serve
```

## Endpoints

* Registra usuário: `POST /api/register`

---

* Login: `POST /api/login`

---

* Todos contatos: `GET /api/contacts`

---

* Buscar Contatos : `GET /api/contacts?company=Company Name&coditions=name=Contact Name;email=Contact Email`

---

* Cria contato: `POST /api/contacts`

---

* Atualiza contato: `PUT /api/contacts/{id}`

---

* Exclui contato: `DELETE /api/contacts/{id}`

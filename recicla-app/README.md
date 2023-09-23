Passo a passo de criação do projeto: 

Laravel versão 10
PHP 8+

documentação laravel: 
https://laravel.com/docs/10.x/installation#your-first-laravel-project

# 1- Criação do projeto com o composer: 
```shell
composer create-project laravel/laravel example-app
```

# 2- Configuração inicial: 

diretório: ./config - podemos realizar diversas configurações em diversos arquivos. Não será alterado nesse MVP. 

# 3- Configuração: 

arquivo: ./env 

Alterar as configurações do banco de dados local da sua máquina

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Após configurar para acesso ao banco de dados local, rode o comando para criar a base de dados inicial e testar as confgirações de banco de dados: 
```shell
php artisan migrate
```

# 4- Configuração de controle de acesso autenticação: 

Será usado o starter kit Breeze. 
https://laravel.com/docs/10.x/starter-kits#laravel-breeze-installation 

Rodar apenas um comando por vez. 

No segundo comando selecionar Blade

```shell
composer require laravel/breeze --dev 
php artisan breeze:install
 
php artisan migrate
npm install
npm run dev
```

Ao rodar novamente a aplicação, terá acesso às funcionalidades relativas a login/criação de usuários. 

# 5- Adaptando o usuário da autenticação aos papéis previstos no app: 
https://laravel.com/docs/10.x/migrations 

Essa tablea conterá os papéis permitidos na aplicação e que serão usados para controle de nível de acesso. 

## 5.1 - Criação da tabela de roles (papéis): 
```shel
php artisan make:migration create_roles  
```
Para rodar a migration: 
```shel
php artisan migrate
```

## 5.2 - Cria migração para alterar a tabela de usuário e incluir um campo com o role do usuário: 
```shel
php artisan make:migration alter_user_table_create_role_column  
```
Deve-se pegar dados da tablea original para editar essa migration e fazer referência à table original. 

Além da criação do atributo e setup inicial da migration, é necessário fazer o relacionamento entre esse campo de role e a tabela de roles. 

Cada usuário tem 1 role. Ou seja => User 1:1 Role.

## 5.3 - Criar o relacionamento a nível de código entre User e Role (Esse último somente uma tabela no banco).

a. Criar um model para fazer o gerenciamento dos registros e facilitar o relacionamento. 
```shel
php artisan make:model Role  
```
Definir o nome da tabela e os campos filleble e manualmente. O segundo parâmetro não será aplicável nesse caso. 

b. Definir o relacionamento no Model através de um método dentro de User. Assim, ao retornar o User, obtemos os dados do role. [NÍVEL DE CÓDIGO]

c. Definir o relacionamento na migration. [NÍVEL DE BANCO DE DADOS]. 
Obs.: O relacionamento deve ser criado apenas depois do campo já ser preenchido na tabela. 

## 5.4 - Alteração dos arquivos de template existentes para o cadastro funcionar para coletores e donos solicitadores de retirada de lixo reciclável: 

Será criada na tela de cadastro um drop_down para selecionar os papéis disponíveis. 

### Views/Auth/Register.blade.php: 

Altera o formulário para enviar junto com as demais informações o tipo de cadastro de usuário. 

Atualiza ainda edit.blade.php e update-password-form.blade.php para editar a página de perfil do usuário.

### Model/User: 

Incrementa ao fillable para receber o dado de role_id do relacionamento. 
Esse dado pode ser usado para retornar todos os dados do relacionamento. 

### Controllers/Auth/RegisteredUserController: 

Faz lógica para buscar do banco de dados os dados de registro do role de acordo com parâmetro que vem do $request do formulário e o atribui ao create do model de User. 

## 5.5 - Altera o redirecionamento no momento do login ou cadastro do usuário em função do perfil: 

a. cria as páginas do blade para cada tipo de perfil;

b. configura o redirecionamento após o login no controller AuthenticatedSessionController.

c. Altera o routes, para receber uma rota para a view criada (nova) - routes/web

- Alteração para incluir a rota das novas páginas de dashboard;
- Alteração para fazer lógica e servir página de dashboard adequada de acordo com o usuário logado

d. Altera o RouteServiceProvider para prover as rotas de dashboard do catador e reciclador.




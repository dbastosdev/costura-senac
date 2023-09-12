Passo a passo de criação do projeto: 

Laravel versão 10
PHP 8+

documentação laravel: 
https://laravel.com/docs/10.x/installation#your-first-laravel-project

1- Criação do projeto com o composer: 
```shell
composer create-project laravel/laravel example-app
```

2- Configuração inicial: 

diretório: ./config - podemos realizar diversas configurações em diversos arquivos. Não será alterado nesse MVP. 

3- Configuração: 

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

4- Configuração de controle de acesso autenticação: 

Será usado o starter kit Breeze. 
https://laravel.com/docs/10.x/starter-kits#laravel-breeze-installation 


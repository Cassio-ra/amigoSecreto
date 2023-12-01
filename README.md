# Configuração inicial

Ao clonar ou baixar o projeto, primeiro utilize o comando a seguir, para atualizar os pacotes do sistema.

composer install;

Em seguida utilize o comando:

npm install;

Então configure a conexão com o Banco de dados de preferencia na .env e utilize os comandos:

php artisan optimize; php artisan migrate; php artisan db:seed; php artisan key:generate;

Então basta iniciar o projeto com o:

php artisan serve;

E conectar a rota localhost:8000

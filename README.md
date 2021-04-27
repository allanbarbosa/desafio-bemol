# Desafio BEMOL - Super Canal
Início de um projeto de Comunicação em diversos canais.

# SETUP
O projeto é composto de três pastas.

- A primeira é a raiz onde se encontram os arquivos de docker.
- A segunda é a pasta backend onde está o projeto API com Laravel
- A Terceira é a pasta frontend, onde se encontra a aplicação frontend em angular.

Para carregarmos a aplicação, primeira iremos executar o `docker compose up -d` para levantar os containers.

Após levantado os containers, executar o `composer install` através do comando `docker exec desafio-bemol-php-fpm composer install`.

Em seguida, fazer a cópia do `.env.example` que está na pasta backend para o arquivo `.env`.

Em seguida executar as migrations, através do comando `docker exec desafio-bemol-php-fpm php artisan migrate`.

E carregar a aplicação frontend executando o `ng serve` dentro da pasta frontend.


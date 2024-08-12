<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Sobre o Desafio



## Pré-requisitos

**Pré-requisitos:**

* Docker
* Laravel Sail
* Node.js

## Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/ferreiraajr/desafiobr24
   
2. Entrar na pasta
    ```bash
    cd desafiobr24
   ```
3. Rodar comando para trazer o composer
    ```bash
   docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
    ```
## Alerta 
Em caso de erro de permissao nos proximos comandos, ajustar as permissões
    ```bash 
        sudo chmod -R 777 desafiobr24
    ```
4. Copiar o env
    ```bash
   cp .env.example .env
   ```
5. Subir a aplicação
   ```bash
   ./vendor/bin/sail up
   ```
6. instala as dependencias
    ```bash 
    npm install
    ```

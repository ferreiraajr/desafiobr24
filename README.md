<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Sobre o Desafio

Este projeto é um sistema desenvolvido em Laravel que integra com o Bitrix24, uma plataforma CRM popular. O sistema
oferece uma interface para gerenciar empresas e contatos, permitindo realizar operações CRUD (Criar, Ler, Atualizar e
Excluir) para ambos.

### Funcionalidades Principais

- Gerenciamento de Empresas: Adicione, visualize, edite e exclua empresas.
- Integração com Bitrix24: O sistema utiliza webhooks fornecidos pelo Bitrix24 para sincronizar dados entre o sistema e
  o CRM.
- Sincronização de Dados: Atualize automaticamente informações de empresas e contatos no Bitrix24 a partir do sistema.

## Tecnologias Utilizadas

- Backend: Laravel
- Integração com Bitrix24: Webhooks e API REST do Bitrix24
- Frontend: Vue.js
- Framework Css: Tailwind

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
5. Ajustar paramentros do .env com os respectivos campos e webhook cadastrado no bitrix24
   ```
   BITRIX_WEBHOOK
   
   DB_CONNECTION=pgsql
   DB_HOST=pgsql
   DB_PORT=5432
   DB_DATABASE=laravel
   DB_USERNAME=sail
   DB_PASSWORD=password
   ```
6. Subir a aplicação
   ```bash
   ./vendor/bin/sail up
   ```
7. instala as dependencias
    ```bash 
    npm install
    ```
8. Rodar Migrations
    ```
   sail artisan migrate
   ```

## Implementações Futuras

Este projeto pode e deve ser evoluído e várias melhorias estão planejadas para aprimorar sua funcionalidade e
usabilidade. As futuras implementações incluem:

- Integração com OAuth: Implementar autenticação OAuth para uma comunicação e integração mais segura e eficiente com o
Bitrix24.
- Ajuste na Sincronização de Dados: Melhorar o processo de sincronização para garantir que as atualizações de dados no
Bitrix24 sejam refletidas automaticamente no sistema e vice-versa.
- Aprimoramento de Layout e Formulários Dinâmicos: Atualizar o layout do sistema e aprimorar os formulários para torná-los
mais dinâmicos e intuitivos, alinhando-se à experiência de usuário oferecida pelo Bitrix24.
Essas melhorias visam proporcionar uma experiência mais integrada e fluida para os usuários e facilitar a gestão de
empresas e contatos dentro do sistema.

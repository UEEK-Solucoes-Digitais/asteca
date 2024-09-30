# Projeto base em Laravel

Siga os passos descritos abaixo para rodar a aplicação.

## Instalação / configuração

Primeiramente, é necessário criar seu banco de dados local e alterar sua conexão no arquivo .env, localizado na raíz do projeto:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=[insira aqui o banco de dados do projeto]
DB_USERNAME=root
DB_PASSWORD=root

A aplicação já está configurada com todas as libs que estavam contidas no projeto base sem Laravel, portanto não é necessário importar nenhuma biblioteca ou pacote para rodar a aplicação, basta rodar os comandos abaixo

Para instalar pacotes Composer:

```bash
composer install
```

Para instalar pacotes NPM:

```bash
npm install
```

Para criar o banco de dados com a tabela admins:

```bash
php artisan migrate
```

Para inserir os dados padrões no banco:

```bash
php artisan db:seed
```

## Inicialização

Aconselho abrir três terminais, sendo o primeiro para rodar o server local, o segundo para rodar o NPM e o terceiro para possíveis criações de controllers, migrations e models

PHP:

```php
php artisan serve
```

NPM:

```php
npm run dev
```

## Recados

Caso tenha erros relacionados a banco de dados, verifique se todas as configurações estão corretas o arquivo.env, nas seguintes linhas:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projeto_base
DB_USERNAME=root
DB_PASSWORD=root
```

## Licença

[UEEK Soluções Digitais](http://ueek.digital/)

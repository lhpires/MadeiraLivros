# MadeiraLivros

# Sistema Madeira Livros

> Se estiver usando laravel sail, executar o seguinte comando:
> 

```powershell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

> Instalar dependências
> 

```powershell
yarn install
ou
npm install
composer install
```

> Rodar Build ou Contruir Desenvolvimento
> 

```powershell
yarn dev
ou
yarn build
```

<aside>
💡 Após o projeto rodando podemos rodar as factories de usuários e Livros

</aside>

```powershell
php artisan migrate:refresh --seed
```

<aside>
ℹ️ O projeto possui validações de requests para cada Módulo

</aside>

Banco de dados Ambiente de desenvolvimento Laravel SAIL

```php
DB_CONNECTION=mysql
DB_HOST=mariadb
DB_PORT=3306
DB_DATABASE=MadeiraLivros
DB_USERNAME=sail
DB_PASSWORD=password
```

![docs.gif](public/docs/docs.gif)
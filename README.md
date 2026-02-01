# Executando o projeto

Renomeie o .env.example:
`cp -n .env.example .env`

Instale as dependências do composer:
`composer install --ignore-platform-reqs`

Instale as dependências do NPM:
`npm install`

Gere a chave para a aplicação:
`php artisan key:generate`

você pode simplesmente executar `Make` no terminal, caso tenha em um ambiente linux com o [Docker](docs/docker.md) instalado para automatizar os passos anteriores. <b>(O [Docker](docs/docker.md) é extremamente necessario para o funcionamento do projeto)</b>

[Configurando um alias de shell para o Sail do Laravel](https://laravel.com/docs/12.x/sail#configuring-a-shell-alias)

Antes de executar as migrações, acesse o [Minio](http://localhost:9000/). Crie o bucket `public/` e deixe como público para que o laravel tenha livre acesso. As credênciais estão no .env:

```
AWS_ACCESS_KEY_ID=sail
AWS_SECRET_ACCESS_KEY=password
AWS_URL=http://localhost:9000/public
```

agora execute as migrações e seeders:
`sail art migrate:fresh --seed`

execute o vite:
`sail npm run dev` ou `sail npm run build` <b>(_recomendado para produção_)</b>

execute as filas:
`sail art queue:work`

derrube os containers do sail:
`sail down` adicione <b>`-v`</b> para excluir os volumes <b>(_os dados da aplicação_)</b>


# Gerenciamento de tarefa



## Rodando localmente

Tenha em sua maquina [GIT](https://git-scm.com/), [PHP](https://www.php.net/).

Clone o projeto

```bash
  git clone git@github.com:IagoGondim/TaskManager.git
```

Entre no diretório do projeto

```bash
  cd TaskManager
```

Instale as dependências

```bash
  npm install
```

Inicie o servidor

```bash
  
  php artisan migrate
  php artisan db:seed --class=CategoriasTableSeeder
  npm run dev
  php artisan serve
```
Abra no navegador e va para a rota .../register

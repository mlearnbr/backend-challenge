# PHP Framework Laravel 8


## Para rodar este projeto
```bash
# Atenção: O Arquivo esta na sub-pasta 'desafio2' do repositório 'backend-challenge'
# Acessando o pasta de arquivo
# Após acessar o repositório deve acessar a pasta do projeto.
$ cd desafio2

# exemplo de como deve esta setado do terminal
$ C:\(CAMINHO DA MAQUINA)\backend-challenge\desafio2>

# instalando as dependencias
$ composer install

# Criando o arquivo .env a partir do arquivo .env.exemple
# Ao criar o arquivo .env deve ser observado o nome da variavel DB_DATABASE, que por padrão esta 'laravel', se necessário ajustar as configrações do banco de acordo com a da maquina a ser utilizada.
$ cp .env.exemple .env 

# Gerando a migrate para criar as tabelas da dase de dados.
$ php artisan migrate

# Stratando o serviço / Aplicação.
$ php artisan serve

```

## Acessando a aplicação
Abra e browser de sua preferencia e acesso a url: http://localhost:8000/  
# neste caso a porta esta a padrão, mais pode ser alterada se necessário, PS: o link para acesso é mostrado quando o comardo anterior é executado.

## Pré-requisitos
- PHP >= 7.0
- Laravel 8
- composer

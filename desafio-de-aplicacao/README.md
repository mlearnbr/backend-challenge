### Sobre
![](https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg)
- Sistema criado com o novo Laravel 7.

- Para instalar o projeto basta seguir os seguintes passos:
1.  git clone git@github.com:meuProjeto
2. acesse a pasta do projeto com o seguinte comando: **cd /meuProjeto**
3. Instale as dependências e o framework com o seguinte comando:  **composer install**
4. Copie o arquivo .env.example com o seguinte comando: **cp .env.example .env**
5. Crie uma nova chave para a aplicação com o comando:  **php artisan key:generate**
6.  Crie as tabelas com o seguinte comando: ** php artisan migrate**
7.  Inicie a aplicação com o comando: ** php artisan serve**

- Disponível para as linguagens **Português** e **Inglês** através do Middleware **LocazationLanguage** criado para esta função. Os arquivos de tradução que se encontram na pasta resource/lang.

- Utilizado **VueJs e Axios** para comunicação com as rotas da Api interna e também da @mLearn.
Obs: Não foi instalado nada via npm ou yarn. Existe arquivos js e css dentro da pasta public.

- Foi criado apenas uma rota no arquivo api para todas as funções necessárias. A rota em questão é do tipo apiResource que contempla as seguintes funções (Index(), show($id), store(), update($id), destroy($id)).

- Toda logica se concentra no arquivo **UserMLearnController** que se encontra dentro da pasta **App\Http\Controllers\api**.

- Antes de testar o sistema, faça os seguintes comandos, pois pode apresentar alguns erros por causa de cache de aplicação.
**php artisan config:clear**
**php artisan cache:clear**
**php artisan config:cache**

- Não esqueça de alterar no arquivo .env os seguintes campos:

**APP_URL** = coloque a url de teste no seu ambiente de desenvolvimento. exemplo:
**APP_URL=http://desafio-de-aplicacao.test**

**DB_HOST** = coloque o ip ou hostname do seu servidor de banco de dados.
exemplo:
**DB_HOST=127.0.0.1**

**DB_PORT** = Porta do servidor de banco de dados Mysql (Geralmente 3306).
exemplo:
**DB_PORT=3306**

**DB_DATABASE**=Nome do banco de dados que deverá persistir os dados.
exemplo:
**DB_DATABASE=desafio-de-aplicacao**

**DB_USERNAME**=Nome do usuário que pode se conectar ao banco de dados acima.
exemplo:
**DB_USERNAME=root**

**DB_PASSWORD**=Senha do usuário que pode se conectar ao banco de dados acima.
exemplo:
**DB_PASSWORD=123456**

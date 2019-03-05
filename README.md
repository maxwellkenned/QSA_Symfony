# Desafio Symfony - CRUD de Empresas e QSA
<img src="http://blog.4linux.com.br/wp-content/uploads/2018/04/symfony-4.jpg" width="55%">


### Especificações principais

* [Symfony](https://symfony.com/4) - v4.2.3 - Framework PHP MVC
* [PHP](https://secure.php.net/) - v7.2.8 - Linguagem


### Instalação

Execute as seguintes etapas:

Abra o arquivo 'symphart/.env'.
Ajuste a variavel DATABASE_URL as configurações já feitas.
Exemplo: 
DATABASE_URL=mysql://root:SENHADOBANCO@127.0.0.1:3306/NOMEDOBANCO

ou

DATABASE_URL=pgsql://postgres:SENHADOBANCO@127.0.0.1:5432/NOMEDOBANCO

Logo em seguida, entre no diretório do projeto e rode os comandos abaixo para instalar as demais dependências e criar as tabelas no banco de dados:
```sh
$ cd symphart
$ composer install
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:diff
$ php bin/console doctrine:migrations:migrate
```

E para rodar o projeto:
```sh
$ php bin/console server:run
```

## OBS:
- Fazer GIT CLONE -
Todos os links baseados nos templates estão vinculados ao padrao "http://localhost/qsa_symfony/public/[ROTAS]" caso precise mudar, favor editar nos templates os links.

### Rotas
Estas são as rodas para uso deste webservice:
#### Empresas:
| Função | Rota | Parametro | Tipo |
| ------ | ------ | ------ | ------ |
| Empresa - Listar Todas | /empresas/listar | x | GET
| Empresa - Cadastrar | /empresas/criar | x | POST/GET
| Empresa - Editar | /empresas/editar/{nuSeqEmpresa} | ID da Empresa | POST/GET
| Empresa - Remover | /empresas/baixar/{nuSeqEmpresa} | ID da Empresa | DELETE
| Empresa - Exibir | /empresas/{nuSeqEmpresa} | ID da Empresa | GET

#### QSA:
| Função | Rota | Parametro | Tipo |
| ------ | ------ | ------ | ------ |
| Sócio - Listar Todos | /pessoas/listar | x | GET
| Sócio - Cadastrar | /pessoas/criar | x | POST/GET
| Sócio - Editar | /pessoas/editar/{nuSeqPessoa} | ID do Sócio | POST/GET
| Sócio - Remover | /pessoas/deletar/{nuSeqPessoa} | ID do Sócio | DELETE
| Sócio - Exibir | /pessoas/{nuSeqPessoa} | ID do Sócio | GET

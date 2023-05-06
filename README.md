# beforify : descrição do projeto

Projeto em laravel pensado para quem é da área da saúde e precisa gerenciar: seus pacientes, consultas, exames e fotos de antes e depois mostrando os resultados que seus pacientes tiveram, etc...

# como rodar o projeto?

É bem simples, primeiramente, é preciso configurar o arquivo <b>.env</b>, colocando o usuário, senha, base de dados que estão em seu ambiente. Utilizei o MySQL na criação desse projeto.

Após isso, basta executar os comando abaixo:

1. Navegue até a pasta do projeto e no terminal execute o comando: <b>composer install</b>
1. <b>php artisan key:generate</b>
2. <b>php artisan migrate</b>
3. Suba a aplicação em seu servidor local com o comando <b>php artisan serve</b> e acesse a url <b>http://localhost:8000/</b>


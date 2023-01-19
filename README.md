# API RESTFul Challenge

Implementação de uma API RESTFul, para o gerenciamento de pedidos de uma pastelaria utilizando o framework Laravel.

## 🚀 Começando

Essas instruções permitirão que você obtenha uma cópia do projeto em operação na sua máquina local para fins de desenvolvimento e teste.

### 📋 Pré-requisitos

Sistemas que você precisa para ter instalado em sua maquina local.


 - PHP 8.1.9
 - Laravel 9
 - MySQL 5.7
 - Composer
 - Apache ou Nginx
 - MailTrap
 - Postman
 - Gerenciador de Banco de Dados de sua preferência


### 🔧 Instalação

Neste primeiro momento vamos fazer um clone do projeto para sua maquina.

Abra um terminal, vá para a pasta em que aloca seus projetos.

Após isso digite no terminal:

```
git clone https://github.com/flmezei/API_challenge.git
```

Aguarde finalizar o clone do projeto.

Após finalizado, abra o projeto clonado em sua IDE de preferencia.

Neste primeiro momento abra um novo terminal na pasta do projeto clonado e digite o seguinte comando:

```
composer install
```
Aguarde a finalização da instalação do composer.

Feito isso nosso ambiente esta quase configurado por completo.

Vamos as configurações do arquivo .env

No projeto clonado em sua maquina você irá encontrar um arquivo .env.example, no qual você deve duplica-lo e renomear esse novo arquivo para .env somente.

Após isso vamos configurar dentro no .env nossa conexão com banco de dados

Segue o exemplo do meu arquivo:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=challenge_api
DB_USERNAME=root
DB_PASSWORD=
```

Mais abaixo vamos inserir as configurações SMTP para envio de emails.

Estamos configurando pois nossa API irá disparar emails conforme seja feito uma nova requisição de pedidos.
Portanto precisamos testar os recebimentos de email disparados por nossa API.
Neste caso estou utilizando o MailTrap que ajuda muito.

Para saber mais e criar uma conta gratuita consulte **https://mailtrap.io/home**

Após criar sua conta o MailTrap ja envia um primeiro email para sua caixa de menssagem aonde você encontrará as configurações 
do seu login para você adicionar no seu arquivo .env.

![image](https://user-images.githubusercontent.com/96137765/213336653-d7a84723-5dc6-4034-a719-a4ffeab88292.png)


Em Integration selecione Laravel 7+

![image](https://user-images.githubusercontent.com/96137765/213337104-b2a10329-c7e3-4d22-b4e8-cd62c8d1a086.png)


Será gerado as configuraçõe para seu usuario

Parecida com as minhas configurações, porém MAIL_USERNAME e
MAIL_PASSWORD serão os seus. Copie e cole em seu arquivo .env

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=#############
MAIL_PASSWORD=#############
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

Após termos configurado nosso arquivo .env vamos aos proximos passos.

!!Importante!! Deixe seu arquivo .env e o .env.example exatamente iguais para o funcionamento da aplicação.

Após isso vamos subir nosso serviço rodando o codigo no terminal:

```
php artisan server
```
Após isso você precisará abrir um novo terminal, ja que o serviço estará usando o antigo terminal.

Abra seu Gerenciador de Banco de Dados e crie uma conexão MySQL com os dados de conexão do seu arquivo .env

Após isso!!

Agora vamos rodar nossas Migrations e nosso Seed executando o comando:

```
php artisan migrate --seed
```
Para que seja criada nossas tabelas em nosso banco de dados e o Seed cria dados "fake" para popular a tabela Products da nossa API.


##Pronto nosso ambiente esta configurado e nossa API está funcional##


## ⚙️ Executando os testes

Para executarmos os testes iremos usar o Postman.

### 🔩 Está é a collection com todo o teste ja configurado para testar a API 

Basta abrir o Postman e importar o arquivo da collection da API

[API Pastelaria.postman_collection.zip](https://github.com/flmezei/API_challenge/files/10452899/API.Pastelaria.postman_collection.zip)

Após importar a collection você verá a API_Pastelaria Collection aonde temos Customers, Orders e Products com seus respectivos testes para endpoints da API.

Importante lembrar que ao rodar a migration somente a tabela Product foi populada, porem pode ser testada incluindo novos itens nela.

Basta ir em Customers, depois em Register e apertar SEND que a requisição do endpoint sera feita devolvendo uma resposta no formato JSON em todas elas.

Os proximos passos e a continuação dos testes fazendo o mesmo processo em todos os metodos da collection.

Segue a imagem da nossa Collection:

![image](https://user-images.githubusercontent.com/96137765/213339774-677a75b3-c812-4d16-a546-dcb170961d2d.png)


Se configurado corretamente como expliquei no inicio o arquivo .env, na parte do SMTP, quando você criar pelo Postman um Order(Register), sera disparado um 
e-mail com o resumo do pedido nele em seu MailTrap.


## 🎁 Expressões de gratidão

* Foi um prazer desenvolver essa API RESTFul.

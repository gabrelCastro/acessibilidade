<h1 align="center" > Acessibilidade-Cypress <h1>

<p align="center">
<img loading="lazy" src="http://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=GREEN&style=for-the-badge"/>
</p>

Este projeto consiste em um site que realiza avaliações de acessibilidade em outras páginas da web. Além disso, inclui testes End-to-End utilizando *Cypress* para garantir a funcionalidade e a usabilidade do sistema.

* [Como rodar o projeto localmente](#-como-rodar-o-projeto-localmente)
* [Como realizar os testes atraves do Cypress](#como-realizar-os-testes-atraves-do-cypress)

# 💻 Como rodar o projeto localmente
Primeiramente, é preciso instalar os seguintes softwares em sua máquina. 

- [NodeJs](https://nodejs.org/en)


- [Xampp](https://www.apachefriends.org/pt_br/index.html) 


- [Composer](https://getcomposer.org/download/ ) 


- [MySQL workbench](https://www.mysql.com/products/workbench/ ) 


*Todos os softwares podem ser instalados da forma padrão como é recomendado, ou também seguindo suas próprias preferências.* 

 

## Alteração necessária no xampp 

Após a instalação, acesse a pasta de instalação do XAMPP e abra a pasta `php` (por padrão, em `C:\xampp\php`). Edite o arquivo `php.ini` com um editor de texto e descomente a linha contendo `;extension=zip`, removendo o `;` no início.

 

### Xampp 

Abra o xampp e dê “start” no “MySQL”. 

 

### MySQL Workbench

Abra o workbench, crie uma conexão e execute o código “create database laravel” 

 

## 📚 Com o projeto clonado... 

1. No terminal aberto no projeto dê o comando `composer i` para a instalação do composer; 

2. No projeto, você encontrará um arquivo de exemplo chamado `.env.example`. Crie um novo arquivo chamado `.env` na raiz do projeto. Copie o conteúdo do arquivo `.env.example` e cole no novo arquivo `.env`. Certifique-se de gerar uma chave de aplicação com: `php artisan key:generate`

3. Execute o código  `php artisan migrate`;

4. Execute os seguintes códigos em sequência: 

   -`npm i`

   -`npm run dev`

   -`php artisan serve`

5. Agora abra o MySQL Workbench e execute o código que está no arquivo “Inserir itens no Banco”, basta copiar o texto.


# Como realizar os testes atraves do cypress
## 🛠️ Preparando o ambiente para os testes

Antes de rodar os testes, certifique-se de que o Node.js está instalado em sua máquina:

- [NodeJs](https://nodejs.org/en)

*Todos os softwares podem ser instalados da forma padrão como é recomendado, ou também seguindo suas próprias preferências.* 

## 🔍 Abrindo e utilizando o Cypress

Para rodar os testes End-to-End usando o Cypress, siga os passos abaixo:
1. Abra o terminal no diretório do projeto;
2. Dê o comando: `npx cypress open` para executar o cypress; 
3. Abrirá uma janela com duas opções, escolha "E2E Testing", que é o tipo de teste realizado;
4. Selecione o navegador de sua preferência;
5. Terão alguns testes dentro da pasta "*cypress\e2e*", selecione o que deseja executar;
6. Após abrir o teste desejado, ele automaticamente irá realizá-lo, a partir disso você pode:
   - Repetir o teste clicando no botão de "Reload";
   - Editar o código do teste clicando no nome da spec(teste) onde aparece a opção "open in IDL";
   - Ver e analisar cada passo do teste, tanto os sucessos quanto as falhas.

> Lembre se, sempre que quiser realizar os testes, terá que seguir esses passos :smile:

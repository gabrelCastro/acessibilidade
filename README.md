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

Após a instalação do mesmo, será necessário abrir a sua pasta de instalação e procurar a pasta “php” (possivelmente no endereço “C:\xampp\php”). Procure o arquivo também chamado “php” do tipo “parâmetro de configuração” e o abra com algum programa de editor de texto (como bloco de notas). 

Ache o texto “;extension=zip” e exclua o “;” que precede o “extension”. 

 

### Xampp 

Abra o xampp e dê “start” no “MySQL”. 

 

### MySQL Workbench

Abra o workbench, crie uma conexão e execute o código “create database laravel” 

 

## 📚 Com o projeto clonado... 

1. No terminal aberto no projeto dê o comando `composer i` para a instalação do composer; 

2. Adicione o arquivo “.env” na pasta do projeto (perceba que existe a chance do “.” sumir, se atente em renomear o arquivo); 

3. Abra o arquivo “.env”, editando a linha que possui “DB_PASSWORD", apagando a senha que vem como padrão (admin), deixando espaço vazio após o “=”; 

4. Cole o arquivo “2024_05_01_220147_create_erros_table” na pasta “...database\migrations”; 

5. Execute o código  `php artisan migrate`, no qual dará um erro quando for realizada a ação no arquivo recém adicionado; 

6. Exclua o arquivo “2024_05_01_220147_create_erros_table”, o qual foi adicionado; 

7. Execute novamente o `php artisan migrate`; 

8. Execute os seguintes códigos em sequência: 

   -`npm i`

   -`npm run dev`

   -`php artisan serve`

9. Agora abra o MySQL Workbench e execute o código que está no arquivo “Inserir itens no Banco”, basta copiar o texto.

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
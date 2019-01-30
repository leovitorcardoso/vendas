# Instuções para instalar o projeto

#### Utilizado o GitBash para executar os comandos
#### Php 7.1.26
#### MySql 10.1.37
#### Npm 1.3.21
#### node 0.10.24

## Composer
Siga as instruções para instalar o composer. Link: https://getcomposer.org/download/.
Execute o comando <code>(caminho onde o composer.phar foi instalado)/composer.phar install</code> dentro da pasta raiz do projeto.

## Banco de Dados
Na pasta raiz do projete, execute os comandos <code>php bin/console doctrine:database:create</code> e <code>php bin/console doctrine:schema:update --force</code> 

## Npm
Siga as instruções para instalar o NPM. Link: https://www.npmjs.com/get-npm
Exevute os comandos <code>npm install</code> e <code>grunt</code> dentro da pasta <code>/public</code>.

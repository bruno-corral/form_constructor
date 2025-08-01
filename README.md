# Painel de construção de formulários (Laravel 12 + Filament 3 + PHP 8.3 + MySQL 8)

### Desenvolvido por Bruno Corral

Este projeto foi desenvolvido como parte do processo seletivo para a vaga de Desenvolvedor - ACTO, atendendo a todos os requisitos funcionais, técnicos e diferenciais solicitados.

---

## Tecnologias utilizadas

- PHP 8.3
- Laravel 12.x
- Filament 3
- Docker 
- Docker Compose
- MySQL 8.x
- GIT para versionamento do projeto

---

## Instalação e configuração

### Clonando o projeto
```bash
git clone https://github.com/seu-usuario/form_constructor
cd form_constructor
```

### Configurando o arquivo `.env`
```bash
cp .env.example .env
```

### Subindo o ambiente com Docker
```bash
docker compose up
```

### Acessando o container da aplicação em outro terminal
```bash
docker exec -it testeacto bash
```

### Gerando a key da aplicação
```bash
php artisan key:generate
```

### Rodando as migrations
```bash
php artisan migrate
```

### Acessando a aplicação no navegador
```
http://127.0.0.1:8000/admin/
```

---

### Criando usuário
* Para criar um usuário use o comando no terminal:
```bash
php artisan make:filament-user 
```

### Logando no sistema
* Para logar no sistema entre com o e-mail e senha que foram escolhidas
no terminal com o comando filament-user

## Requisitos atendidos (conforme orientado na descrição do projeto)

* Para todas as opções o usuário deve estar logado

- ✅ Gerenciamento de formulários
    ° Cadastrar com título, descrição e status, Editar e Excluir formulários
- ✅ Gerenciamento de perguntas
    ° Cadastrar com texto da pergunta, tipo, Editar e Excluir perguntas
- ✅ Gerenciamento de alternativas
    ° Cadastrar com texto da alternativa e resosta correta, Editar e Excluir perguntas
- ✅ Resposta de Formulários
    ° Escolhendo o formulário ativo, perguntas e alternativas de cada pergunta
- ✅ Visualização de Respostas
    ° Visualizar as opções escolhidas para cada formulário na listagem

## Seguindo padrões de commits baseados do site
* https://www.conventionalcommits.org/pt-br/v1.0.0-beta.4/

---

## Sobre mim

Projeto desenvolvido por Bruno Corral como parte do processo seletivo para Desenvolvedor para ACTO.  
Focado em boas práticas, clareza de código e eficiência.

---

## Licença
Este projeto foi desenvolvido exclusivamente para fins de avaliação técnica.
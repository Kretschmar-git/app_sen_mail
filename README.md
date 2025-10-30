# app_send_mail
# App Mail Send ✉️

Um aplicativo web simples e funcional para envio de e-mails, utilizando PHP e a biblioteca PHPMailer. O projeto demonstra boas práticas de segurança ao separar a lógica de negócio e as credenciais do diretório público.

## ✨ Funcionalidades Principais

-   **Interface Simples:** Um formulário limpo para inserir o destinatário, assunto e a mensagem do e-mail.
-   **Envio via SMTP:** Utiliza o PHPMailer para enviar e-mails de forma autenticada através de um servidor SMTP (configurado para o Gmail por padrão).
-   **Validação de Campos:** Verifica se todos os campos do formulário foram preenchidos antes de processar o envio.
-   **Feedback ao Usuário:** Exibe páginas de sucesso ou erro claras após a tentativa de envio.
-   **Estrutura Segura:** A lógica de envio e as credenciais são mantidas fora do diretório web acessível publicamente, prevenindo exposição de dados sensíveis.

## 🚀 Tecnologias Utilizadas

-   **Backend:** PHP
-   **Frontend:** HTML5
-   **Estilização:** Bootstrap 4
-   **Biblioteca de E-mail:** PHPMailer

## 📂 Estrutura do Projeto

O projeto foi organizado para garantir maior segurança, separando os arquivos públicos dos arquivos de lógica interna.

/

├── app_send_mail/           # <-- Diretório PRIVADO (fora do alcance do servidor web)

│   ├── bibliotecas/

│   │   └── PHPMailer/       # <-- Arquivos da biblioteca PHPMailer

│   └── processa_envio.php   # <-- Lógica principal: classe, config. SMTP e envio

│

├── public_html/             # <-- Diretório PÚBLICO (raiz do seu site)

│   ├── index.html           # <-- Formulário de envio (Interface do usuário)

│   ├── processa_envio.php   # <-- Ponte que inclui a lógica privada

│   └── logo.png             # <-- Imagem do logo

-   **`public_html/`**: Contém os arquivos que o usuário acessa diretamente pelo navegador.
-   **`app_send_mail/`**: Contém o "coração" da aplicação, incluindo a biblioteca PHPMailer e o script com a lógica de envio e as credenciais, que nunca deve ser acessível diretamente pela web.

## ⚙️ Instalação e Configuração

Siga os passos abaixo para executar o projeto em seu ambiente local.

### Pré-requisitos

-   Um servidor web com PHP (XAMPP, WAMP, MAMP, etc.).
-   [Composer](https://getcomposer.org/) para gerenciar as dependências do PHP.

### Passos

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/seu-repositorio.git](https://github.com/seu-usuario/seu-repositorio.git)
    ```

2.  **Navegue até o diretório do projeto e instale o PHPMailer:**
    A forma recomendada de instalar o PHPMailer é via Composer. Se você ainda não tem os arquivos da biblioteca, execute o comando abaixo dentro da pasta `app_send_mail`:
    ```bash
    composer require phpmailer/phpmailer
    ```
    Isso criará a pasta `vendor` com o PHPMailer. Você precisará ajustar os `require` no topo do arquivo `processa_envio.php` para usar o `autoload.php` do Composer.

3.  **Configure suas credenciais de e-mail:**
    Abra o arquivo `app_send_mail/processa_envio.php` e edite as seguintes linhas com suas informações do servidor SMTP:

    ```php
    // --- Server settings --- //
    $mail->Host       = 'smtp.seu-provedor.com'; // Ex: smtp.gmail.com
    $mail->Username   = 'seu-email@dominio.com';   // Seu e-mail
    $mail->Password   = 'sua-senha';             // Sua senha de e-mail ou senha de app
    $mail->Port       = 587;                     // Porta (587 para TLS ou 465 para SSL)

    // --- Email remetente --- //
    $mail->setFrom('seu-email@dominio.com', 'Nome do Remetente');
    ```

    > **⚠️ Importante para usuários do Gmail:** O Gmail requer uma **"Senha de App"** para enviar e-mails através de aplicações de terceiros se você tiver a autenticação de dois fatores ativada. Você pode gerar uma [aqui](https://myaccount.google.com/apppasswords).

4.  **Aponte seu servidor web:**
    Configure a raiz do seu servidor web (DocumentRoot) para apontar para a pasta `public_html`. Acesse o site (ex: `http://localhost`) e o formulário de envio será exibido.

## 💡 Como Usar

1.  Abra o `index.html` no seu navegador.
2.  Preencha o campo "Para" com o e-mail do destinatário.
3.  Digite o "Assunto" do e-mail.
4.  Escreva sua "Mensagem".
5.  Clique no botão "Enviar Mensagem".
6.  Você será redirecionado para uma página de confirmação de sucesso ou de erro.

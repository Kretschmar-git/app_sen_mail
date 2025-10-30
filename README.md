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

/ ├── app_send_mail/ # <-- Diretório PRIVADO (fora do alcance do servidor web) │ ├── bibliotecas/ │ │ └── PHPMailer/ # <-- Arquivos da biblioteca PHPMailer │ └── processa_envio.php # <-- Lógica principal: classe, config. SMTP e envio │ ├── public_html/ # <-- Diretório PÚBLICO (raiz do seu site) │ ├── index.html # <-- Formulário de envio (Interface do usuário) │ ├── processa_envio.php # <-- Ponte que inclui a lógica privada │ └── logo.png # <-- Imagem do logo

<?php
    // --- Namespace --- //
    use PHPMailer\PHPMailer\PHPMailer; // necessario para tratar erros
    use PHPMailer\PHPMailer\SMTP;      // necessario para tratar erros
    use PHPMailer\PHPMailer\Exception; // necessario para tratar erros

    

    class Mensagem {
        // --- Atributos --- //
        private $para     = null;
        private $assunto  = null;
        private $mensagem = null;
        public $status    = array('codigo_status' => null, 'descricao_status' => '');
        
    
        // --- Método Construtor --- //
        public function __construct($atributo1, $atributo2, $atributo3)
        {
            $this->para     = $atributo1;
            $this->assunto  = $atributo2;
            $this->mensagem = $atributo3;
           
            
        }
    
        // --- Métodos Mágicos Get e Set --- //
        public function __get($atributo)
        {
            return $this->$atributo;
        }
    
        public function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }
    
        // --- Métodos Públicos --- //
        public function MensagemValida()
        {
            if (empty($this->para) || empty($this->assunto) || empty($this->mensagem))  {
                return false;
            } else {
                return true;
            }
            
        }

    }

    $mensagem = new Mensagem($_POST['para'], $_POST['assunto'], $_POST['mensagem']);
    
    
    if(!$mensagem->MensagemValida()) {
        echo "Mensagem inválida! Por favor, preencha todos os campos."; // <-- CORRIGIDO 1: Mensagem de erro correta
        header('Location: index.php?campo=vazio');
        die();
    }
    
    // --- Cria uma instância da classe PHPMailer --- //
    $mail = new PHPMailer(true);

    try {
        // --- Server settings --- //                        //IMPORTANTE esse (SMTP::DEBUG_SERVER)
        $mail->SMTPDebug  = false;                           // Mude para (SMTP::DEBUG_SERVER) para ver os detalhes do envio
        $mail->isSMTP();                                     // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                // Set the SMTP server to send through gmail 
        $mail->SMTPAuth   = true;                            // Enable SMTP authentication
        $mail->Username   = 'bom.dia.calendario@gmail.com';  // SMTP username (seu e-mail)
        $mail->Password   = 'gtvuhbnmmdramdga';              // SMTP password (sua SENHA DE APP)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;     // <-- CORRIGIDO 3: Mudei para SMTPS (SSL)
        $mail->Port       = 465;                             // <usar porta 465 ou 587>

        // --- Email remetente --- //
        $mail->setFrom('bom.dia.calendario@gmail.com', 'App Mail Remetente');
        
        // --- Email destino da mensagem --- //
        $mail->addAddress($mensagem->para);             // Usando o e-mail do formulário via post e armazenado dentro da classe
        
        // $mail->addReplyTo('seu-email@provedor.com', 'Informação');

        //Content
        $mail->isHTML(true);                                                 // Set email format to HTML
        $mail->CharSet = 'UTF-8';                                            // Para garantir a acentuação correta
        
        // --- Conteúdo da mensagem --- //
        $mail->Subject = $mensagem->assunto;                                 // Usando o assunto do formulário
        $mail->Body    = $mensagem->mensagem;                                // Usando a mensagem do formulário
        $mail->AltBody = strip_tags($mensagem->mensagem);                    // Versão em texto puro da mensagem

        $mail->send();
        $mensagem->status['codigo_status'] = 1;
        $mensagem->status['descricao_status'] = 'Mensagem enviada com sucesso!';
        
        

    } catch (Exception $e) {
        $mensagem->status['codigo_status'] = 0;
        $mensagem->status['descricao_status'] = 'Não foi possível enviar a mensagem! 
        Por favor tente novamente mais tarde.<br> 
        Detalhes do erro: {$mail->ErrorInfo}';   
    }

    ?>
<html>
    <head>
        <title>App Mail Send</title>
        <meta charset="utf-8" />    
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" 
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            
            <div class="py-3 text-center">
				<img class="d-block mx-auto mb-2" src="logo.png" alt="" width="72" height="72">
				<h2>Send Mail</h2>
				<p class="lead">Seu app de envio de e-mails particular!</p>
			</div> 

            <div class="row">
                <div class="col-md-12">

                    <?php if ($mensagem->status['codigo_status'] == 1) { ?>

                        <div class="container">
                            <div class="text-center">

                                <h1 class="display-4 text-success">Sucesso!</h1>
                                <p><?= $mensagem->status['descricao_status'] ?></p> <!-- Tag de impressão do PHP -->
                                <a href="index.php" class="btn btn-primary btn-lg my-5 text-center text-white">Voltar</a>

                            </div>
                        </div>

                    <?php } ?>

                    <?php if ($mensagem->status['codigo_status'] == 0) { ?>

                        <div class="text-center">

                            <h1 class="display-4 text-danger">Ops!</h1>
                            <p><?= $mensagem->status['descricao_status'] ?></p> <!-- Tag de impressão do PHP -->
                            <a href="index.php" class="btn btn-primary btn-lg my-5 text-center text-white">Voltar</a>

                        </div>
                        
                    <?php } ?>  
                </div>
            </div>              
        </div>
    </body>
</html>
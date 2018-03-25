<?php

namespace Core;

use Libs\ValidatorService\ValidatorService;
use PHPMailer;

class Contact
{
    public function send()
    {
        $post = $_POST;
        $validate = new ValidatorService();
        $post = $validate->validate($post, [
            'firstname' => 'required|max_length:20',
            'lastname' => 'sometimes|max_length:20',
            'email' => 'required|email|max_length:50',
            'content' => 'required|min_length:5|max_length:200',
        ]);

        if ($validate->countErrors() === 0) {
            $this->sendEmail($post);
        } else {
            $this->saveUserInput($post);
            $_SESSION['message'] = $validate->errors;
        }
    }

    private function sendEmail(array $post)
    {
        $body = 'Nowa wiadomość od' . $post['firstname'] . ' ' . $post['lastname'] . '<br>';
        $body .= 'Email Nadawcy: ' . $post['email'] . '<br>';
        $body .= 'Treść wiadomości: <br>' . $post['content'];

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = "smtp.example.com";
        // optional
        // used only when SMTP requires authentication
        $mail->SMTPAuth = true;
        $mail->Username = 'smtp_username';
        $mail->Password = 'smtp_password';
        $mail->setFrom('website@example.com', 'Your domain');
        $mail->addAddress('my_email@domain.com', 'My personal data.');
        $mail->Subject = 'Nowa wiadomość z kontaktu kontaktowego.';
        $mail->isHTML(true);
        $mail->Body = $body;

        if(!$mail->send()) {
            error_log('Mailer error: ' . $mail->ErrorInfo);
        } else {
            unset($_SESSION['user_input']);
            $_SESSION['message'] = ['Wiadomość została wysłana poprawnie.'];
        }
    }

    private function saveUserInput($post)
    {
        foreach ($post as $key => $value) {
            $_SESSION['user_input'][$key] = $value;
        }
    }
}

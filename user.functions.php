<?php

require 'medoo/Medoo.php';

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use medoo\Medoo;
use PHPMailer\PHPMailer\PHPMailer;

class User{
    
    public $email, $passwd, $name, $surname, $phone, $city, $address, $post_code, $is_verified, $is_admin;

    public function __construct($email, $passwd, $name, $surname, $phone, $city, $address, $post_code, $is_verified = 0, $is_admin = 0)
    {
        $this->email = $email;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->city = $city;
        $this->address = $address;
        $this->post_code = $post_code;
        $this->is_verified = $is_verified;
        $this->is_admin = $is_admin;
    }
    public function __toString()
    {
        return $this->email;
    }

    public function get_verification_code() : string{

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => 'pitcernia',
            'server' => $_SERVER['SERVER_NAME'],
            'username' => 'root',
            'password' => ''
        ));

        $code = $db->select(
            'users',
            'verification_code',
            ['email' => $this->email]
        )[0];

        $db = null;

        return $code;
    }

    public function send_verification_mail() : bool{

        $mail = new PHPMailer();
        $email = $this->email;

        //SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->CharSet= 'UTF-8';

        $mail->Username = 'pitcernia.projekt@gmail.com';
        $mail->Password = 'uygguxmgiieqpghd';

        $mail->Port = 587; //465
        $mail->SMTPSecure = 'tls'; //ssl

        //generowanie linku do weryfikacji
        $url = $_SERVER['SERVER_NAME'] . '/pitcernia/' . "confirm-verification?email={$email}&code={$this->get_verification_code()}"; 

        $htmlContent = "
        <html>
        <head>
            <title>Zweryfikuj swoje konto</title>
        </head>
        <body>
            <h3>Dziękujemy za dołączenie do społeczności Pitcerni</h3>
            <p>Aby dokończyć rejestracje swojego konta, musisz dokonać weryfikacji. Aby zweryfikować swój email przejdź pod podany adres:</p>
            <br>
            <a href=".$url.">.$url.</a>
        </body>
        </html> 
        ";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('pitcernia.projekt@gmail.com', 'Pitcernia');
        $mail->addAddress($email);
        $mail->Subject = 'Weryfikacja konta';
        $mail->Body = $htmlContent;
    
        //<a href=".$url."></a>
        if($mail->send()){
            return true;
        }else{
            return false;
        }

    }
    
}

final class UserFunctions{
    public static function register_user(User $user) : bool{

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => 'pitcernia',
            'server' => $_SERVER['SERVER_NAME'],
            'username' => 'root',
            'password' => ''
        ));

        
        $users = $db->select(
            'users',
            'email',
            ['email' => $user->email]
        );

        //Sprawdź czy email istnieje w bazie
        if($users){
            //Jeśli tak zakończ rejestracje z niepowodzeniem
            exit(json_encode($users));
            return false;
        }

        $db->pdo->beginTransaction();

        $db->insert(
            'users',
            [
                'id' => null,
                'email' => $user->email,
                'passwd' => $user->passwd,
                'name' => $user->name,
                'surname' => $user->surname,
                'phone' => $user->phone,
                'post_code' => $user->post_code,
                'city' => $user->city,
                'address' => $user->address,
                'verification_code' => self::generte_verification_code(),
                'is_verified' => $user->is_verified,
                'is_admin' => $user->is_admin
            ]
        );

        $db->pdo->commit();

        $db = null;

        return true;

    }
    public static function verify_user(User $user, string $code) : bool{

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => 'pitcernia',
            'server' => $_SERVER['SERVER_NAME'],
            'username' => 'root',
            'password' => ''
        ));

        if($code !== $user->get_verification_code()){
            return false;
        }

        $db->pdo->beginTransaction();

        $db->update(
            'users',
            [
                'is_verified' => true
            ],
            [
                'email' => $user->email
            ]
        );

        $db->pdo->commit();

        $db = null;

        return true;
    }
    public static function log_user(string $string, string $passwd){
        //logowanie użytkownika
    }
    public static function get_user_by_email(string $email) : User{

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => 'pitcernia',
            'server' => $_SERVER['SERVER_NAME'],
            'username' => 'root',
            'password' => ''
        ));

        $user = $db->select(
            'users',
            [
                'email',
                'passwd',
                'name',
                'surname',
                'phone',
                'city',
                'address',
                'post_code',
                'is_verified',
                'is_admin'
            ],
            ['email' => $email]
        );

        $db = null;

        return new User(
            $user[0]['email'],
            $user[0]['passwd'],
            $user[0]['name'],
            $user[0]['surname'],
            $user[0]['phone'],
            $user[0]['city'],
            $user[0]['address'],
            $user[0]['post_code'],
            $user[0]['is_verified'],
            $user[0]['is_admin']
        );

    }

    private static function generte_verification_code() : string{
        return bin2hex(random_bytes(16));
    }
}

<?php

require_once 'medoo/Medoo.php';

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use medoo\Medoo;
use PHPMailer\PHPMailer\PHPMailer;

class User{
    
    public $email, $passwd, $name, $surname, $phone, $is_verified, $is_admin;

    public function __construct($email, $passwd, $name, $surname, $phone, $is_verified = 0, $is_admin = 0) {
        $this->email = $email;
        $this->passwd = $passwd;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->is_verified = $is_verified;
        $this->is_admin = $is_admin;
    }
    public function __toString() {
        return $this->email;
    }

    public function send_verification_mail() : bool {

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
        $v_code = UserFunctions::get_user_verification_code($this);
        $url = $_SERVER['SERVER_NAME'] . '/pitcernia/' . "confirm-verification?email={$email}&code={$v_code}"; 

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
    
        if($mail->send()){
            return true;
        }else{
            return false;
        }

    }
    
}
class UserFunctionStatus{
    public $status;
    public $message;

    function __construct(bool $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    function __toString()
    {
        return $this->message;
    }
}

final class UserFunctions {

    private static $db_name = 'pitcernia';
    private static $db_server = 'localhost';
    private static $db_user = 'root';
    private static $db_passwd = '';

    public static function register_user(User $user) : UserFunctionStatus {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));
        
        $users = $db->select(
            'users',
            'email',
            ['email' => $user->email]
        );

        //Sprawdź czy email istnieje w bazie
        if($users){
            //Jeśli tak zakończ rejestracje z niepowodzeniem
            unset($db);
            return new UserFunctionStatus(false, "Konto pod tym adresem jest już zarejestrowane.");
        }

        $db->insert(
            'users',
            [
                'id' => null,
                'email' => $user->email,
                'passwd' => $user->passwd,
                'name' => $user->name,
                'surname' => $user->surname,
                'phone' => $user->phone,
                'verification_code' => self::generte_verification_code(),
                'is_verified' => $user->is_verified,
                'is_admin' => $user->is_admin
            ]
        );

        unset($db);

        return new UserFunctionStatus(true, "Zarejestrowano nowego użytkownika.");

    }

    public static function verify_user(User $user, string $code) : UserFunctionStatus {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        if($code !== UserFunctions::get_user_verification_code($user)){
            unset($db);
            return new UserFunctionStatus(false, "Kody weryfikacji nie są takie same.");
        }

        $db->update(
            'users',
            [
                'is_verified' => true
            ],
            [
                'email' => $user->email
            ]
        );

        unset($db);

        return new UserFunctionStatus(true, "Email zweryfikowany poprawnie.");
    }

    public static function log_in_user(string $email, string $passwd) : UserFunctionStatus {

        session_start();

        $user = self::get_user_by_email($email);

        if($user === false || !password_verify($passwd, $user->passwd)){
            //wrong email
            return new UserFunctionStatus(false, "Zły adres email lub hasło.");
        }

        $_SESSION['user'] = json_encode((array)$user);

        session_write_close();

        return new UserFunctionStatus(true, "Zalogowano.");

    }

    public static function log_out_user() : UserFunctionStatus {

        session_start();

        unset($_SESSION['user']);

        session_write_close();

        return new UserFunctionStatus(true, "Wylogowano.");
    }

    public static function get_user_from_session() : User {
        session_start();

        $d_json = json_decode($_SESSION['user']);

        $user = new User(
            $d_json->email,
            $d_json->passwd,
            $d_json->name,
            $d_json->surname,
            $d_json->phone,
            $d_json->is_verified,
            $d_json->is_admin,
        );

        session_write_close();

        return $user;
    }

    public static function edit_user_data(User $oldUser, User $newUser) : UserFunctionStatus {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        if($oldUser->email !== $newUser->email){
            $exist_check = $db->select(
                'users',
                'email',
                [
                    'email' => $newUser->email
                ]
            ) ? true : false;
            if($exist_check){
                unset($db);
                return new UserFunctionStatus(false, "Podany email już jest zarejestrowany.");
            } 
        }

        $db->update(
            'users',
            [
                'email' => $newUser->email,
                'name' => $newUser->name,
                'surname' => $newUser->surname,
                'is_verified' => $oldUser->email === $newUser->email ? 1 : 0
            ],
            [
                'email' => $oldUser->email
            ]
        );

        session_start();
        $_SESSION['user'] = json_encode((array)$newUser);
        session_write_close();

        unset($db);

        return new UserFunctionStatus(true, "Poprawna edycja danych użytkownika.");
    }

    public static function change_user_passwd(string $email, string $oldPasswd, string $oldPasswdR, string $newPasswd) : UserFunctionStatus {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $res = $db->select(
            'users',
            'passwd',
            [
                'email' => $email
            ]
        );

        if($res['passwd'] != $oldPasswd){
            return new UserFunctionStatus(false, "Złe hasło.");
        }

        if($oldPasswd != $oldPasswdR){
            return new UserFunctionStatus(false, "Hasła się nie zgadazają.");
        }

        $db->update(
            'users',
            [
                'passwd' => password_hash($newPasswd, PASSWORD_DEFAULT)
            ],
            [
                'email' => $email
            ]
        );

        unset($db);

        return new UserFunctionStatus(true, "Hasła zostało zmienione poprawnie.");
    }

    public static function send_passwd_restore_mail(string $email) : UserFunctionStatus {

        if(!self::check_if_user_exists($email)){
            return new UserFunctionStatus(false, "Użytkownik o podanym adresie email nie istnieje.");
        }

        $mail = new PHPMailer();

        //SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->CharSet= 'UTF-8';

        $mail->Username = 'pitcernia.projekt@gmail.com';
        $mail->Password = 'uygguxmgiieqpghd';

        $mail->Port = 587; //465
        $mail->SMTPSecure = 'tls'; //ssl

        //url
        $url = $_SERVER['SERVER_NAME'] . '/pitcernia/' . 'restore-password?em=' . base64_encode($email);
        
        //html
        $htmlContent = "
        <html>
        <head>
            <title>Odzyskiwanie hasła</title>
        </head>
        <body>
            <p>Aby zresetować swoje hasło przejdź pod podany adres:</p>
            <br>
            <a href=".$url.">.$url.</a>
        </body>
        </html> 
        ";

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('pitcernia.projekt@gmail.com', 'Pitcernia');
        $mail->addAddress($email);
        $mail->Subject = 'Odzyskiwanie hasła';
        $mail->Body = $htmlContent;
        
        if($mail->send()){
            return new UserFunctionStatus(true, "Mail poprawnie wysłany.");
        }else{
            return new UserFunctionStatus(false, "Wewnętrzny błąd podczas wysyłania maila.");
        }

    }

    public static function restore_user_passwd(string $b64email, string $passwd) : UserFunctionStatus {
        $email = base64_decode($b64email);
        
        if(!self::check_if_user_exists($email)){
            return new UserFunctionStatus(false, "Nie znaleziono użytkownika.");
        }

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));
        
        $res = $db->update(
            'users',
            [
                'passwd' => password_hash($passwd, PASSWORD_DEFAULT)
            ],
            [
                'email' => $email
            ]
        );

        unset($db);

        return new UserFunctionStatus(true, "Hasło zresetowane poprawnie.");
    }

    public static function get_user_by_email($email) {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $user = $db->select(
            'users',
            [
                'email',
                'passwd',
                'name',
                'surname',
                'phone',
                'is_verified',
                'is_admin'
            ],
            ['email' => $email]
        );

        if(!$user){
            return new UserFunctionStatus(false, "Nie znaleziono użytkownika o podanym emailu.");
        }

        unset($db);

        return new User(
            $user[0]['email'],
            $user[0]['passwd'],
            $user[0]['name'],
            $user[0]['surname'],
            $user[0]['phone'],
            $user[0]['is_verified'],
            $user[0]['is_admin']
        );

    }

    public static function get_user_id(User $user) : int {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $id = $db->select(
            'users',
            'id',
            [
                'email' => $user->email
            ]
        );

        unset($db);

        return intval($id[0]);
    }

    public static function get_user_by_id(int $id) {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $user = $db->select(
            'users',
            [
                'email',
                'passwd',
                'name',
                'surname',
                'phone',
                'is_verified',
                'is_admin'
            ],
            ['id' => $id]
        );

        if(!$user){
            return new UserFunctionStatus(false, "Nie znaleziono użytkownika o podanym emailu.");
        }

        unset($db);

        return new User(
            $user[0]['email'],
            $user[0]['passwd'],
            $user[0]['name'],
            $user[0]['surname'],
            $user[0]['phone'],
            $user[0]['is_verified'],
            $user[0]['is_admin']
        );
    }

    public static function get_user_verification_code(User $user) : string {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $code = $db->select(
            'users',
            'verification_code',
            ['email' => $user->email]
        )[0];

        unset($db);

        return $code;
    }

    public static function get_all_users() {
        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $users = $db->select(
            'users',
            '*',
            ''
        );

        return $users;
    }

    private static function check_if_user_exists(string $email) : bool {

        $db = new Medoo(array(
            'database_type' => 'mysql',
            'database_name' => self::$db_name,
            'server' => self::$db_server,
            'username' => self::$db_user,
            'password' => self::$db_passwd
        ));

        $res = $db->select(
            'users',
            [
                'email'
            ],
            [
                'email' => $email
            ]
        );

        unset($db);

        if($res){
            return true;
        }

        return false;
    }

    private static function generte_verification_code() : string {
        return bin2hex(random_bytes(16));
    }
}

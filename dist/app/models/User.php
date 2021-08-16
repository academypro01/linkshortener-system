<?php

class User {
    private $db;
    private $salt = 'ASDFlkjsdf654-+sdljsASFD@#$^$#%$';

    public function __construct() {
        $this->db = new Database();
    }
    public function checkUsername($username) {
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        $this->db->query("SELECT username FROM users_tbl WHERE username='$username'");
        $result = $this->db->rowCount();
        if($result > 0) {
            return true;
        }else {
            return false;
        }
    }
    public function checkEmail($email) {
        $username = filter_var($email, FILTER_SANITIZE_STRING);
        $this->db->query("SELECT email FROM users_tbl WHERE email='$email'");
        $result = $this->db->rowCount();
        if($result > 0) {
            return true;
        }else {
            return false;
        }
    }
    public function checkAuth(){
        if(isset($_SESSION['username']) && isset($_SESSION['user_id']) && isset($_SESSION['isAdmin']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['AuthToken_Generated'])){
            if(AuthToken::check()) {
                return true;
            }else {
                Semej::set('!','login','Please login again.');
                header("Location: ".URLROOT.'login/index');die;
            }
        }else{
            Semej::set('!','login','Please login again.');
            header("Location: ".URLROOT.'login/index');die;
        }
    }
    public function checkToken($token) {
        $token = filter_var($token, FILTER_SANITIZE_STRING);
        $this->db->query("SELECT id from users_tbl WHERE token='$token'");
        $rowCount = $this->db->rowCount();
        if($rowCount > 0) {
            $result = $this->db->single();
            $token_id = $result->id;
            return $token_id;
        }else{
            return false;
        }
    }
    public function register($data) {
        $firstname = filter_var($data['firstname'], FILTER_SANITIZE_STRING);
        $lastname  = filter_var($data['lastname'], FILTER_SANITIZE_STRING);
        $username  = strtolower(filter_var($data['username'], FILTER_SANITIZE_STRING));
        $email     = strtolower(filter_var($data['email'], FILTER_SANITIZE_STRING));
        $password  = filter_var($data['password'], FILTER_SANITIZE_STRING);
        $password  = sha1($password.$this->salt);
        $active    = 0;
        $isAdmin   = 0;
        $token     = md5( (string) microtime().uniqid().rand() );
        if($this->checkUsername($username)) {
            Semej::set('!','error','Username already exists!');
            header("Location: ".URLROOT.'login/index');die;
        }else if($this->checkEmail($email)) {
            Semej::set('!','error','Email already exists!');
            header("Location: ".URLROOT.'login/index');die;
        }else {
            $this->db->query("INSERT INTO users_tbl (firstname, lastname, username, email, password, active, isAdmin, token) VALUES ('$firstname','$lastname','$username','$email','$password','$active','$isAdmin','$token')");
            $this->db->execute();
            $mail_message = "<header style='text-align:center;font-weight:bold;font-family:sans-serif;background-color:#5352ed;color:#f8f8f8;padding:10px'>
            <h4>
          ".SITENAME."
          </h4>
        </header>
        <main style='padding:10px;'>
            <p style='font-size:18px;color:#4caf50;'>
              Hello ".$firstname." !
          </p>
          <p style='font-size:18px;'>
            Please click on the button below to Active your Account!
          </p>
          <p>
            <button>
              <a href='".URLROOT.'mail/activate/'.$token."' style='border:none;outline:none;padding:5px;display:block;font-weight:bold;text-decoration:none;'>Activation Link</a>
            </button>
          </p>
          <hr>
          <cite>Thank you !</cite>
        </main>
        <footer style='text-align:center;background-color:#5352ed;color:#f8f8f8;padding:3px;'>
            System email. don't replay!
        </footer>";
            $phpMailer = new Mailer();
            $phpMailer->sendMail("Activation Link",$mail_message,$email);
            sleep(2);
            Semej::set('200','ok','Please check your email and click on Activation link!');
            header("Location: ".URLROOT.'login/index');die;
        }
    }
    public function activeToken($token) {
        $check = $this->checkToken($token);
        if($check == false) {
            Semej::set('!','error','Wrong Activation Code!');
            header("Location: ".URLROOT.'login/index');die;
        }
        $token     = md5( (string) microtime().uniqid().rand() );
        $active    = 1;
        $this->db->query("UPDATE users_tbl SET active='$active', token='$token' WHERE id='$check'");
        $this->db->execute();
        Semej::set('!','active','Your account is Active Now!');
        header("Location: ".URLROOT.'login/index');die;
    }
    public function login($data) {
        $username = strtolower(filter_var($data['username'], FILTER_SANITIZE_STRING));
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
        if($this->checkUsername($username) == FALSE) {
            Semej::set('!','error','Username or password is Incorrect!');
            header("Location: ".URLROOT.'login/index');die;
        }
        $password = sha1($password . $this->salt);
        $this->db->query("SELECT * FROM users_tbl WHERE username='$username'");
        $result = $this->db->single();
        if($result->password == $password){
            if($result->active == 1){
                $_SESSION['username'] = $result->username;
                $_SESSION['user_id']  = $result->id;
                $_SESSION['isAdmin']  = $result->active;
                $_SESSION['firstname']= $result->firstname;
                $_SESSION['lastname'] = $result->lastname;
                AuthToken::generate();
                header("Location: ".URLROOT.'dashboard/master/index');die;
            }else{
                Semej::set('!','error','Please Active your account first!');
                header("Location: ".URLROOT.'login/index');die;
            }
        }else{
            Semej::set('!','error','Username or password is Incorrect!');
            header("Location: ".URLROOT.'login/index');die;
        }
    }
    public function sendResetLink($email) {
        $email = strtolower(filter_var($email, FILTER_SANITIZE_STRING));
        if($this->checkEmail($email)) {
            $this->db->query("SELECT * FROM users_tbl WHERE email='$email' AND active='1'");
            if ($this->db->rowCount() > 0) {
                $result = $this->db->single();
                $firstname = $result->firstname;
                $token = $result->token;
                $mail_message = "<header style='text-align:center;font-weight:bold;font-family:sans-serif;background-color:#5352ed;color:#f8f8f8;padding:10px'>
            <h4>
          ".SITENAME."
          </h4>
        </header>
        <main style='padding:10px;'>
            <p style='font-size:18px;color:#4caf50;'>
              Hello ".$firstname." !
          </p>
          <p style='font-size:18px;'>
            we receive a request from you to reset your password.
            <br>
            Please click on the button below to reset your password!
          </p>
          <p>
            <button>
              <a href='".URLROOT.'password/renewPassword/'.$token."' style='border:none;outline:none;padding:5px;display:block;font-weight:bold;text-decoration:none;'>Reset Password</a>
            </button>
          </p>
          <hr>
          <cite>if you don't request for new password, ignore this email.</cite>
        </main>
        <footer style='text-align:center;background-color:#5352ed;color:#f8f8f8;padding:3px;'>
            System email. don't replay!
        </footer>";
        $phpMailer = new Mailer();
        $phpMailer->sendMail("Reset Password",$mail_message, $email);
        Semej::set('!','message','if your email was right, please check your inbox.');
        header("Location: ".URLROOT.'login/index');
            }else{
                Semej::set('!','message','if your email was right, please check your inbox.');
                header("Location: ".URLROOT.'login/index');die;
            }
        }else {
            Semej::set('!','message','if your email was right, please check your inbox.');
            header("Location: ".URLROOT.'login/index');die;
        }
    }
    public function resetPasswordLink($data) {
        $token = filter_var($data['token'], FILTER_SANITIZE_STRING);
        $password = filter_var($data['password'], FILTER_SANITIZE_STRING);
        $password_confirm = filter_var($data['password_confirm'], FILTER_SANITIZE_STRING);
        if($this->checkToken($token)){
            if($password != $password_confirm) {
                Semej::set('!','error','Passord not match!');
                header("Location: ".URLROOT.'password/renewPassword/'.$token);die;
            }else{
                $new_token     = md5( (string) microtime().uniqid().rand() );
                $password = sha1($password.$this->salt);
                $this->db->query("UPDATE users_tbl SET token='$new_token',password='$password' WHERE token='$token'");
                $this->db->execute();
                Semej::set("!",'ok','Password Updated!');
                header("Location: ".URLROOT.'login/index');die;
            }
        }else{
            header("Location: ".URLROOT.'errorPage/error');die;
        }
    }
    public function getAllData($id) {
        $this->checkAuth();
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $this->db->query("SELECT * FROM users_tbl WHERE id='$id'");
        $user_information = $this->db->resultSet();
        $this->db->query("SELECT * FROM links_tbl INNER JOIN users_tbl ON users_tbl.id = links_tbl.user_id WHERE users_tbl.id='$id' AND links_tbl.trash='0'");
        $link_information = $this->db->resultSet();
        $fullData = [$user_information, $link_information];
        return $fullData;
    }
}
<?php

class Login extends Controller {
    public $myModel;
    public function __construct() {
        $this->myModel = $this->model("User");
    }
    public function index() {
        $this->view('frontend/login');
    }
    public function register() {
        $data = $_POST['frm'];
        // phpMailer init in require.php file!
        $this->myModel->register($data);
    }
    public function login(){
        $data = $_POST['frm'];
        $this->myModel->login($data);
    }
}
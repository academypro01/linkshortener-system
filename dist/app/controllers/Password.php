<?php

class Password extends Controller {
    private $myModel;
    public function __construct() {
        $this->myModel = $this->model("User");
    }
    public function forgot() {
        $this->view('frontend/forgot');
    } 
    public function sendLink() {
        $data = $_POST['email'];
        $this->myModel->sendResetLink($data);
    }
    public function renewPassword($data) {
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        if ($this->myModel->checkToken($data) != false) {
            $this->view('frontend/reset', $data);
        }else{
            header("Location: ".URLROOT.'errorPage/error');die;
        }
    }
    public function resetPasswordFromLink() {
        $data = $_POST['frm'];
        $this->myModel->resetPasswordLink($data);
    }
}
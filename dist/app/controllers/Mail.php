<?php

class Mail extends Controller {
    private $myModel;
    public function __construct() {
        $this->myModel = $this->model("User");
    }
    public function activate($data) {
        $data = filter_var($data, FILTER_SANITIZE_STRING);
        $this->myModel->activeToken($data);
    }
}
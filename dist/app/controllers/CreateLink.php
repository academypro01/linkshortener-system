<?php

class CreateLink extends Controller {
    public $myModel;
    public function __construct() {
        $this->myModel = $this->model("Link");
    }
    public function create() {
        $data = $_POST['long_link'];
        $this->myModel->addLink($data);
    }
    public function panelCreateLink() {
        $data = $_POST['long_link'];
        $this->myModel->panelAddLink($data);
    }
}
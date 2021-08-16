<?php

class TrashLink extends Controller {
    private $myModel;
    public function __construct() {
        $this->myModel = $this->model("Link");
    }
    public function trash($id){
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $this->myModel->trashLink($id);
    }
}
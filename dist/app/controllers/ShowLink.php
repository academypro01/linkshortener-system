<?php

class ShowLink extends Controller {
    public $myModel;
    public function __construct() {
        $this->myModel = $this->model("Link");
    }
    public function show($data) {
        $result = $this->myModel->getLinkData($data);
        if($result == false){
            header("Location: ".URLROOT."errorPage/error");die;
        }
        $long_link = $result->long_link;
        $link_id   = $result->id;
        $this->myModel->updateLinkView($link_id);
        header("Location: ".$long_link);die;
    }
}
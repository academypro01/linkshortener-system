<?php

class About extends Controller {
    public $myModel;
    public function __construct() {
        
    }
    public function index() {
        $this->view('frontend/about');
    }
}
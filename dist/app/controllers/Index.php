<?php

class Index extends Controller {
    public function index() {
        $this->view('frontend/index');
    }
    public function home() {
        $this->view('frontend/home');
    }
}
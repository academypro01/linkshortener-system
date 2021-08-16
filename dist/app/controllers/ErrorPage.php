<?php

class ErrorPage extends Controller {
    public function error() {
        $this->view('errors/index');
    }
}
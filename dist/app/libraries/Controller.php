<?php

class Controller {
    public function model($model) {
        $model = filter_var($model, FILTER_SANITIZE_STRING);
        if(file_exists('app/models/'.$model.'.php')) {
            require_once 'app/models/'.$model.'.php';
            return new $model;
        }else {
            die('Model Not Found!');
        }
    }

    public function view($view, $data = []) {
        if(file_exists('app/views/'.$view.'.php')) {
            require_once 'app/views/'.$view.'.php';
        }else {
            die("View Not Found!");
        }
    }
}
<?php

class Link {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }
    public function checkAuth(){
        if(isset($_SESSION['username']) && isset($_SESSION['user_id']) && isset($_SESSION['isAdmin']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['AuthToken_Generated'])){
            if(AuthToken::check()) {
                return true;
            }else {
                Semej::set('!','login','Please login again.');
                header("Location: ".URLROOT.'login/index');die;
            }
        }else{
            Semej::set('!','login','Please login again.');
            header("Location: ".URLROOT.'login/index');die;
        }
    }
    public function addLink($long_link) {
        $long_link = filter_var($long_link, FILTER_SANITIZE_URL);
        if (filter_var($long_link, FILTER_VALIDATE_URL)) {
            
                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '' && $_SESSION['user_id'] != NULL) {
                    $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
                } else {
                    $user_id = '1';
                }
                $short_link_id = uniqid();
                $short_link = URLROOT.$short_link_id;
                $views = 0;
                $register_time = date("Y-m-d H:i:s");
                $trash = 0;
                try{
                $this->db->query("INSERT INTO links_tbl (user_id,long_link,short_link,short_link_id,views,register_time,trash) VALUES ('$user_id','$long_link','$short_link','$short_link_id','$views','$register_time','$trash')");
                $this->db->execute();
            }catch(Exception $e){
                echo 'from exception:------------';
                echo $e;die;
            }
                
                Semej::set('200', 'ok', $short_link);
                header("Location: ".URLROOT);die;
            
        }
    }
    public function getLinkData($short_link_id) {
        $short_link_id = filter_var($short_link_id, FILTER_SANITIZE_STRING);
        $this->db->query("SELECT * FROM links_tbl WHERE short_link_id='$short_link_id'");
        $rowCount = $this->db->rowCount();
        if($rowCount > 0) {
            $result = $this->db->single();
            return $result;
        }else {
            return false;
        }
    }
    public function updateLinkView($id) {
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $this->db->query("UPDATE links_tbl SET views=views+1 WHERE id='$id'");
        $this->db->execute();
    }
    public function panelAddLink($long_link) {
        $this->checkAuth();
            $long_link = filter_var($long_link, FILTER_SANITIZE_URL);
            if (filter_var($long_link, FILTER_VALIDATE_URL)) {
                if (isset($_SESSION['user_id'])) {
                    $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
                } else {
                    $user_id = 0;
                }
                $short_link_id = uniqid();
                $short_link = URLROOT.$short_link_id;
                $views = 0;
                $register_time = date("Y-m-d H:i:s");
                $trash = 0;
                $this->db->query("INSERT INTO links_tbl (user_id,long_link,short_link,short_link_id,views,register_time,trash) VALUES ('$user_id','$long_link','$short_link','$short_link_id','$views','$register_time','$trash')");
                $this->db->execute();
                Semej::set('200', 'ok', $short_link);
                header("Location: ".URLROOT.'dashboard/master/createLink');die;
            
        }
    }
    public function trashLink($id){
        $this->checkAuth();
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $this->db->query("UPDATE links_tbl SET trash='1' WHERE short_link_id='$id'");
        $this->db->execute();
        header("Location: ".URLROOT.'dashboard/master/linkList');die;
    }
}
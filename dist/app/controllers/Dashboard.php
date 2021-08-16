<?php
if (session_id() == '') {
    session_start();
}
class Dashboard extends Controller
{
    private $myModel;
    private $fullData;
    public function __construct()
    {
        Semej::checkSession();
        $this->myModel = $this->model("User");
        $this->checkAuth();
        $this->fullData = $this->getAllData($_SESSION['user_id']);
    }
    public function master($page=null)
    {
        $page = filter_var($page, FILTER_SANITIZE_STRING);
        $this->view('dashboard/master', [$page, $this->fullData]);
    }
    public function home()
    {
        header("Location: ".URLROOT.'dashboard/master/index');
        die;
    }
    public function logout()
    {
        try {
            AuthToken::delete();
            $_SESSION['user_id'] = null;
            session_write_close();
            session_unset();
            // session_destroy();
            session_write_close();
            Semej::set('!', 'logout', 'loged out successfully!');
            header("Location: ".URLROOT.'login/index');
            die;
        } catch (Exception $e) {
            echo $e;
            die;
        }
    }
    public function checkAuth()
    {
        if (isset($_SESSION['username']) && isset($_SESSION['user_id']) && isset($_SESSION['isAdmin']) && isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['AuthToken_Generated'])) {
            if (AuthToken::check()) {
                return true;
            } else {
                Semej::set('!', 'login', 'Please login again.');
                header("Location: ".URLROOT.'login/index');
                die;
            }
        } else {
            Semej::set('!', 'login', 'Please login again.');
            header("Location: ".URLROOT.'login/index');
            die;
        }
    }
    public function getAllData($id)
    {
        $id = filter_var($id, FILTER_SANITIZE_STRING);
        $fullData = $this->myModel->getAllData($id);
        return $fullData;
    }
}

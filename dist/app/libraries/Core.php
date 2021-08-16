<?php
// Core App Class
class Core
{
    protected $currentController = 'Index';
    protected $currentMethod = 'home';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getUrl();

        if (isset($url)) {
            if (file_exists('app/controllers/'. ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]);
            } else {
                if (count($url) == 1) {
                    $this->currentController = "ShowLink";
                    $this->currentMethod     = "show";
                }
            }
        }
        try {
            require_once 'app/controllers/' . $this->currentController . '.php';
            $this->currentController = new $this->currentController;

            if (isset($url[1])) {
                if (method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                } else {
                }
            }

            $this->params = $url ? array_values($url) : [];
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        } catch (Exception $e) {
            header("Location: ".URLROOT."errorPage/error");die;
        }
    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}

<?php
class main
{
    public $url;
    public $controllerName = "index";
    public $methodName = "index";
    public $controllerPath = "app/controller/";
    public $controller;
    public function __construct()
    {
        // echo 'this is man';
        $this->getUrl();
        $this->loadController();
        $this->callMethod();
    }
    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $this->url = $_GET['url'];
            if ($this->url != null) {
                $this->url = rtrim($this->url, '/');
                $this->url = explode('/', filter_var($this->url, FILTER_SANITIZE_URL));
            } else {
                unset($this->url);
            }
        }
    }

    public function loadController()
    {
        if (!isset($this->url[0])) {
            include_once($this->controllerPath . $this->controllerName . '.php');
            //include_once('app/controller/index.php');
            $this->controller = new $this->controllerName();
            $this->controller->{$this->methodName}();
        } else {
            $this->controllerName = $this->url[0];
            // $this->controllerName = 'category';
            $fileName = $this->controllerPath . $this->controllerName . '.php';
            if (file_exists($fileName)) {
                include_once($fileName);
                if (class_exists($this->controllerName)) {
                    $this->controller = new $this->controllerName();
                } else {
                }
            } else {
                // $this->controllerName = 'index';
                // include_once($this->controllerPath . $this->controllerName . '.php');
                // $this->controller = new $this->controllerName();
                // $this->controller->{$this->methodName}();
                header("Location:" . BASE_URL . "index/notfound");
            }
        }
    }
    public function callMethod()
    {
        if (isset($this->url[2])) {
            $this->methodName = $this->url[1];
            if (method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}($this->url[2]);
            } else {
                header("Location:" . BASE_URL . "/index");
            }
        } else {
            if (isset($this->url[1])) {
                $this->methodName = $this->url[1];
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location:" . BASE_URL . "index/notfound");
                }
            } else {
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                }
                // else {
                //     header("Location:" . BASE_URL . "/index");
                // }

            }
        }
    }
}
<?php

class login extends Dcontroller
{
    protected $data = array();
    protected $message = array();
    public function __construct()
    {
        // echo 'from controller login';

        parent::__construct();
    }
    public function index()
    {
        $this->login();
    }
    public function login()
    {
        // echo 'thí is homepage from class index <br>';
        // $this->load->view('header');
        Session::init();
        if (Session::get('login') == true) {
            header("Location:" . BASE_URL . "login/dashboard");
        }
        $this->load->view('cpanel/login');
        // $this->load->view('footer');
    }
    public function dashboard()
    {
        // session_start();
        // session_destroy();
        // session_unset();
        Session::checkSession();
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/dashboard');
        $this->load->view('cpanel/footer');
    }
    public function authentication_login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $table_name = 'tbl_admin';
        $loginmodel = $this->load->model('loginmodel');
        $cout =  $loginmodel->login($table_name, $username, $password);

        if ($cout == 0) {
            $message['msg'] = 'username hoặc password sai';
            header("Location:" . BASE_URL . "login/index");
        } else {
            $result = $loginmodel->getlogin($table_name, $username, $password);
            // echo $result[0]['username'];
            // echo $result[0]['password'];
            Session::init();
            Session::set('login', true);
            Session::set('username', $result[0]['username']);
            Session::set('userid', $result[0]['admin_id']);
            header("Location:" . BASE_URL . "login/dashboard");
        }
    }
    public function logout()
    {
        Session::init();
        Session::destroy();
        header("Location:" . BASE_URL . "login/index");
    }
}
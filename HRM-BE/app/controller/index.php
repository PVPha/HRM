<?php

class index extends Dcontroller
{
    protected $data = array();
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }
    public function index()
    {
        $this->homepage();
    }
    public function homepage()
    {
        $categorymodel =  $this->load->model('categorymodel');
        $projectmodel =  $this->load->model('productmodel');
        $table_name_join = 'tbl_category';
        $table_name = 'tbl_project';
        $data['category'] = $categorymodel->listcategoryhome($table_name_join);
        $data['project'] = $projectmodel->listprojecthome($table_name, $table_name_join);
        // echo 'thí is homepage from class index <br>';
        $this->load->view('header');
        // $this->load->view('slider');
        // $homemodel =  $this->load->model('homemodel');
        $this->load->view('index', $data);
        $this->load->view('footer');
    }
    public function notfound()
    {
        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_category';
        $data['category'] = $categorymodel->listcategoryhome($table_name);
        $this->load->view('header', $data);
        $this->load->view('404');
        $this->load->view('footer');
    }

    public function about()
    {
        $loginmodel =  $this->load->model('loginmodel');
        $table_name = 'tbl_admin';
        $data['admin'] = $loginmodel->listadminhome($table_name);
        $this->load->view('header');
        $this->load->view('about', $data);
        $this->load->view('footer');
    }

    public function contact()
    {
        $loginmodel =  $this->load->model('loginmodel');
        $table_name = 'tbl_admin';
        $data['admin'] = $loginmodel->listadminhome($table_name);
        $this->load->view('header');
        $this->load->view('contact', $data);
        $this->load->view('footer');
    }
}
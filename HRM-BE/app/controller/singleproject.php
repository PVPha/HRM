<?php

class singleproject extends Dcontroller
{
    protected $data = array();
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }
    // public function index()
    // {
    //     $this->category();
    // }
    public function notfound()
    {
        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_category_test';
        $data['category'] = $categorymodel->listcategoryhome($table_name);
        $this->load->view('header', $data);
        $this->load->view('404');
        $this->load->view('footer');
    }

    public function category($id)
    {
        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_category_test';
        $table_name_join = 'tbl_product';
        $data['product'] = $categorymodel->productbyidhome($table_name, $table_name_join, $id);
        $data['category'] = $categorymodel->listcategoryhome($table_name);
        $this->load->view('header', $data);
        $this->load->view('category', $data);
        $this->load->view('footer');
    }
    public function detail($id)
    {
        $projectmodel =  $this->load->model('productmodel');
        $categorytmodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_project';
        $table_name_join = 'tbl_category';
        $data['category'] = $categorytmodel->similarbyidhome($table_name_join, $table_name,  $id);
        $data['project'] = $projectmodel->listprojectbyid($table_name, $table_name_join, $id);
        $this->load->view('header');
        $this->load->view('singleproject', $data);
        $this->load->view('footer');
    }
}
<?php
class testphpmvc extends Dcontroller
{
    function __construct()
    {
        Session::checkSession();
        parent::__construct();
        // echo "class testphpmvc <br>";
    }
    public function index()
    {
        $this->testmethods();
    }
    public function testmethods()
    {

        // $this->load->view('cpanel/header');
        // $this->load->view('cpanel/menu');
        // $this->load->view('cpanel/category/category');
        // $this->load->view('cpanel/footer');
    }
    // public function testmethods($id, $slug)
    // {
    //     echo 'testmethod <br>';

    //     echo $id . '<br>';
    //     echo $slug . '<br>';
    // }
}
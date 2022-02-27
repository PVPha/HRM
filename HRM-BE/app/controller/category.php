<?php

class category extends Dcontroller
{
    protected $data = array();
    public function __construct()
    {
        // echo 'test controller category';
        Session::checkSession();
        $message = array();
        parent::__construct();
    }

    // admin
    public function listcategory()
    {
        // echo 'thí is homepage from class index <br>';
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        // $this->load->view('header');
        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_category';
        $data['category'] = $categorymodel->category($table_name);
        // $this->load->view('category', $data);
        $this->load->view('cpanel/category/list_category', $data);
        // $this->load->view('footer');
        $this->load->view('cpanel/footer');
    }
    public function catebyid($id)
    {
        // echo 'thí is homepage from class index <br>';

        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_category';
        $cond = "tbl_category.id_category=$id";
        $data['categorybyid'] = $categorymodel->updatecategorybyid($table_name, $cond);
        // $data['categorybyid'] = $categorymodel->catebyid($table_name, $id);
        // $this->load->view('categorybyid', $data);
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/category/edit_category', $data);
        $this->load->view('cpanel/footer');
    }
    public function addcategory()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        // $this->load->view('addcategory');
        $this->load->view('cpanel/category/add_category');
        $this->load->view('cpanel/footer');
    }
    public function insertcategory()
    {
        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_category';
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $data = array(
            'title_category' => $title,
            'desc_category' => $desc
        );
        $result = $categorymodel->insertcategory($table_name, $data);
        if ($result == 1) {
            $message['msg'] = 'thêm thành công';
            header("Location:" . BASE_URL . "category/addcategory?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'thêm không thành công';
            header("Location:" . BASE_URL . "category/addcategory?msg=" . urldecode(serialize($message)));
        }
        // $this->load->view('addcategory', $message);
        // $this->load->view('cpanel/header');
        // $this->load->view('cpanel/menu');
        // // $this->load->view('addcategory');
        // $this->load->view('cpanel/category/add_category', $message['msg']);
        // $this->load->view('cpanel/footer');
    }
    public function updatecategory($id)
    {
        $table_name = 'tbl_category';
        $categorymodel =  $this->load->model('categorymodel');
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $cond = "tbl_category.id_category=$id";
        $data = array(
            'title_category' => $title,
            'desc_category' => $desc
        );
        $result = $categorymodel->updatecategory($table_name, $data, $cond);
        // if ($result == 1) {
        //     echo 'cập nhật dữ liệu thành công';
        // } else {
        //     echo  'cập nhật dữ liệu không thành công';
        // }
        if ($result == 1) {
            $message['msg'] = 'cập nhật thành công';
            header("Location:" . BASE_URL . "category/listcategory?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'cập nhật không thành công';
            header("Location:" . BASE_URL . "category/listcategory?msg=" . urldecode(serialize($message)));
        }
    }
    public function deletecategory($id)
    {
        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_category';
        // $title = $_POST['title'];
        // $desc = $_POST['desc'];
        // $id = 20;
        $cond = "tbl_category.id_category=$id";
        $result = $categorymodel->deletecategory($table_name, $cond);
        if ($result == 1) {
            $message['msg'] = 'xóa thành công';
            header("Location:" . BASE_URL . "category/listcategory?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'xóa không thành công';
            header("Location:" . BASE_URL . "category/listcategory?msg=" . urldecode(serialize($message)));
        }
    }
    // end admin

    // homepage

    // end homepage
}
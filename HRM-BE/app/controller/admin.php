<?php

class admin extends Dcontroller
{
    protected $data = array();
    public function __construct()
    {
        // echo 'test controller category';
        Session::checkSession();
        $message = array();
        parent::__construct();
    }
    public function addadmin()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        // $this->load->view('addcategory');
        $this->load->view('cpanel/category/add_admin');
        $this->load->view('cpanel/footer');
    }
    public function insertadmin()
    {
        $loginmodel =  $this->load->model('loginmodel');
        $table_name = 'tbl_admin';
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $pos = $_POST['position'];

        $image = $_FILES['image']['name'];
        $tmp_image = $_FILES['image']['tmp_name'];
        // $imgupload = &$tmp_image;
        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0] . time() . '.' . $file_ext;
        $path_uploads = "public/uploads/project/" . $unique_image;
        $data = array(
            'username' => $user,
            'password' => $pass,
            'position' => $pos,
            'image_admin' => $unique_image
        );
        $result = $loginmodel->insertadmin($table_name, $data);
        if ($result == 1) {
            move_uploaded_file($tmp_image, $path_uploads);
            $message['msg'] = 'thêm thành công';
            header("Location:" . BASE_URL . "admin/addadmin?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'thêm không thành công';
            header("Location:" . BASE_URL . "admin/addadmin?msg=" . urldecode(serialize($message)));
        }
    }
    public function listadmin()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $loginmodel =  $this->load->model('loginmodel');
        $table_name = 'tbl_admin';
        $data['admin'] = $loginmodel->listadmin($table_name);
        // $this->load->view('category', $data);
        $this->load->view('cpanel/category/list_admin', $data);
        $this->load->view('cpanel/footer');
    }

    public function deleteadmin($id)
    {
        $loginmodel =  $this->load->model('loginmodel');
        $table_name = 'tbl_admin';
        $cond = "tbl_admin.admin_id=$id";
        $data['adminbyid'] = $loginmodel->adminbyid($table_name, $cond);
        foreach ($data['adminbyid'] as $key => $value) {
            unlink("public/uploads/project/" . $value['image_admin']);
        }
        $result = $loginmodel->deleteadmin($table_name, $cond);
        if ($result == 1) {
            $message['msg'] = 'xóa thành công';
            header("Location:" . BASE_URL . "admin/listadmin?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'xóa không thành công';
            header("Location:" . BASE_URL . "admin/listadmin?msg=" . urldecode(serialize($message)));
        }
    }
}
<?php

class project extends Dcontroller
{
    protected $data = array();
    public function __construct()
    {
        // echo 'test controller category';
        Session::checkSession();
        $message = array();
        parent::__construct();
    }
    public function listproject()
    {
        // echo 'thí is homepage from class index <br>';
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        // $this->load->view('header');
        $projectmodel =  $this->load->model('productmodel');
        $table_name = 'tbl_project';
        $table_name_join = 'tbl_category';
        $data['project'] = $projectmodel->project($table_name, $table_name_join);
        // $this->load->view('category', $data);
        $this->load->view('cpanel/category/list_project', $data);
        // $this->load->view('footer');
        $this->load->view('cpanel/footer');
    }
    public function projectbyid($id)
    {
        // echo 'thí is homepage from class index <br>';
        $projectmodel =  $this->load->model('productmodel');
        $categorymodel =  $this->load->model('categorymodel');
        $table_name = 'tbl_project';
        $table_name_join = 'tbl_category';
        $cond = "tbl_project.id_project=$id";
        $data['projectbyid'] = $projectmodel->updateprojectbyid($table_name, $cond);
        $data['category'] = $categorymodel->category($table_name_join);
        // $this->load->view('categorybyid', $data);
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/category/edit_project', $data);
        $this->load->view('cpanel/footer');
    }
    public function addproject()
    {
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $categorymodel =  $this->load->model('categorymodel');
        $table_name_join = 'tbl_category';
        $data['category'] = $categorymodel->category($table_name_join);
        $this->load->view('cpanel/category/add_project', $data);
        $this->load->view('cpanel/footer');
    }
    public function insertproject()
    {
        $productmodel =  $this->load->model('productmodel');
        $table_name = 'tbl_project';

        $title = $_POST['title'];
        $price = $_POST['price'];
        $area = $_POST['area'];
        $id_category = $_POST['id_category'];
        $desc = $_POST['desc'];
        $address = $_POST['address'];
        $tmp_unique_image = '';
        for ($i = 0; $i <= 4; $i++) {
            $image = $_FILES['image']['name'][$i];
            $tmp_image = $_FILES['image']['tmp_name'][$i];
            // $imgupload = &$tmp_image;
            $div = explode('.', ltrim(substr($image, strrpos($image, '\\')), '\\'));
            $file_ext = strtolower(end($div));
            $unique_image = $div[0] . time() . '.' . $file_ext;
            $tmp_unique_image .= $unique_image . ' ';
            $rs = &$tmp_unique_image;
            // $path_uploads = "public/uploads/project/" . $unique_image;
        }

        $cut = explode(' ', $rs);
        $data = array(
            'title_project' => $title,
            'desc_project' => $desc,
            'price_project' => $price,
            'area_project' => $area,
            'address_project' => $address,
            'id_category' => $id_category,
            'image_1_project' => $cut[0],
            'image_2_project' => $cut[1],
            'image_3_project' => $cut[2],
            'image_4_project' => $cut[3],
            'image_5_project' => $cut[4]
        );
        $result = $productmodel->insertproduct($table_name, $data);
        if ($result == 1) {
            for ($i = 0; $i <= 4; $i++) {
                $tmp_img =  $_FILES['image']['tmp_name'][$i];
                $path_uploads = "public/uploads/project/" . $cut[$i];
                move_uploaded_file($tmp_img, $path_uploads);
            }
            $message['msg'] = 'thêm thành công';    # code...
            header("Location:" . BASE_URL . "project/addproject?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'thêm không thành công';
            header("Location:" . BASE_URL . "project/addproject?msg=" . urldecode(serialize($message)));
        }
    }
    public function updateproject($id)
    {
        // $table_name = 'tbl_product';
        // $productmodel =  $this->load->model('productmodel');
        // $title = $_POST['title'];
        // $desc = $_POST['desc'];
        // $cond = "tbl_category_test.id_category_test=$id";
        // $data = array(
        //     'title_category_test' => $title,
        //     'desc_category_test' => $desc
        // );
        $projectmodel =  $this->load->model('productmodel');
        $table_name = 'tbl_project';
        $cond = "tbl_project.id_project=$id";
        $title = $_POST['title'];
        $price = $_POST['price'];
        $area = $_POST['area'];
        $id_category = $_POST['id_category'];
        $desc = $_POST['desc'];
        $address = $_POST['address'];
        // $image = $_FILES['image']['name'];
        // $tmp_image = $_FILES['image']['tmp_name'];

        // $div = explode('.', $image);
        // $file_ext = strtolower(end($div));
        // $unique_image = $div[0] . time() . '.' . $file_ext;

        // $path_uploads = "public/uploads/product/" . $unique_image;


        // if ($image) {
        //     $cond = "tbl_product.id_product=$id";
        //     $data['productbyid'] = $productmodel->updateproductbyid($table_name, $cond);
        //     foreach ($data['productbyid'] as $key => $value) {
        //         unlink("public/uploads/product/" . $value['image_product']);
        //     }
        //     $data = array(
        //         'title_product' => $title,
        //         'desc_product' => $desc,
        //         'price_product' => $price,
        //         'address_project' => $address,
        //         'image_product' => $unique_image,
        //         'id_category' => $id_category
        //     );
        //     move_uploaded_file($tmp_image, $path_uploads);
        // } else {
        //     $data = array(
        //         'title_project' => $title,
        //         'desc_project' => $desc,
        //         'price_project' => $price,
        //         'area_project' => $area,
        //         'address_project' => $address,
        //         'id_category' => $id_category
        //     );
        // }
        $data = array(
            'title_project' => $title,
            'desc_project' => $desc,
            'price_project' => $price,
            'area_project' => $area,
            'address_project' => $address,
            'id_category' => $id_category
        );
        $result = $projectmodel->updateproject($table_name, $data, $cond);
        if ($result == 1) {
            $message['msg'] = 'cập nhật thành công';
            header("Location:" . BASE_URL . "project/listproject?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'cập nhật không thành công';
            header("Location:" . BASE_URL . "project/listproject?msg=" . urldecode(serialize($message)));
        }
    }
    public function deleteproject($id)
    {
        $projectmodel =  $this->load->model('productmodel');
        $table_name = 'tbl_project';
        $cond = "tbl_project.id_project=$id";
        $data['projectbyid'] = $projectmodel->projectbyid($table_name, $cond);
        foreach ($data['projectbyid'] as $key => $value) {
            unlink("public/uploads/project/" . $value['image_1_project']);
            unlink("public/uploads/project/" . $value['image_2_project']);
            unlink("public/uploads/project/" . $value['image_3_project']);
            unlink("public/uploads/project/" . $value['image_4_project']);
            unlink("public/uploads/project/" . $value['image_5_project']);
        }
        $result = $projectmodel->deleteproject($table_name, $cond);
        if ($result == 1) {
            $message['msg'] = 'xóa thành công';
            header("Location:" . BASE_URL . "project/listproject?msg=" . urldecode(serialize($message)));
        } else {
            $message['msg'] = 'xóa không thành công';
            header("Location:" . BASE_URL . "project/listproject?msg=" . urldecode(serialize($message)));
        }
    }
}
<?php
class categorymodel extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function category($table_name)
    {
        // $sql = "SELECT * FROM tbl_category_test";
        $sql = "SELECT * FROM $table_name ORDER BY id_category DESC";
        return $this->db->select($sql);

        // $result = $this->db->select($sql);
        // return $result;
        // $sql = "SELECT * FROM tbl_category_test";
        // $query = $this->db->query($sql);
        // $result = $query->fetchAll();
        // return $result;
        // return  $category = array(
        //     'catOne' => 'điện thoại',
        //     'catTwo' => 'laptop',
        //     'catThree' => 'PC'
        // );
    }
    public function catebyid($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond ";
        return $this->db->select($sql);
    }
    public function updatecategorybyid($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond";
        return $this->db->select($sql);
    }
    public function insertcategory($table_name, $data)
    {
        return $this->db->insert($table_name, $data);
    }
    public function updatecategory($table_name, $data, $cond)
    {
        return $this->db->update($table_name, $data, $cond);
    }
    public function deletecategory($table_name, $cond)
    {
        return $this->db->delete($table_name, $cond);
    }
    // end admin
    public function listcategoryhome($table_name)
    {
        $sql = "SELECT * FROM $table_name ORDER BY id_category DESC";
        return $this->db->select($sql);
    }
    public function productbyidhome($table_name, $table_name_join, $id)
    {
        $sql = "SELECT * FROM $table_name,$table_name_join WHERE $table_name.id_category=$table_name_join.id_category AND $table_name.id_category=$id ORDER BY $table_name.id_category DESC";
        return $this->db->select($sql);
    }
    public function similarbyidhome($table_name_join, $table_name,  $id)
    {
        $sql = "SELECT * FROM $table_name_join,$table_name WHERE $table_name_join.id_category = $table_name.id_category AND $table_name_join.id_category = (SELECT $table_name.id_category FROM $table_name WHERE $table_name.id_project = $id )";
        return $this->db->select($sql);
    }
}
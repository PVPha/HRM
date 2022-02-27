<?php
class productmodel extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function project($table_name, $table_name_join)
    {
        // $sql = "SELECT * FROM tbl_category_test";
        $sql = "SELECT * FROM $table_name,$table_name_join WHERE $table_name.id_category = $table_name_join.id_category ORDER BY $table_name.id_project DESC";
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
    public function projectbyid($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond ";
        return $this->db->select($sql);
    }
    public function updateprojectbyid($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond";
        return $this->db->select($sql);
    }
    public function insertproduct($table_name, $data)
    {
        return $this->db->insert($table_name, $data);
    }
    public function updateproject($table_name, $data, $cond)
    {
        return $this->db->update($table_name, $data, $cond);
    }
    public function deleteproject($table_name, $cond)
    {
        return $this->db->delete($table_name, $cond);
    }

    public function listprojecthome($table_name, $table_name_join)
    {
        $sql = "SELECT * FROM $table_name,$table_name_join WHERE $table_name.id_category = $table_name_join.id_category ORDER BY $table_name.id_project DESC";
        return $this->db->select($sql);
    }
    public function listprojectbyid($table_name, $table_name_join, $id)
    {
        $sql = "SELECT * FROM $table_name,$table_name_join WHERE $table_name.id_category = $table_name_join.id_category AND $table_name.id_project = $id ORDER BY $table_name.id_project DESC";
        return $this->db->select($sql);
    }
}
<?php
class salarymodel extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function getData($table_name)
    {
        $sql = "SELECT * FROM $table_name ORDER BY ID DESC";
        return $this->db->select($sql);
    }

    public function getDataCalculation()
    {
        $sql = "SELECT * FROM tbl_calculations";
        return $this->db->select($sql);
    }

    public function execute($table_name, $set)
    {
        $sql = "UPDATE $table_name SET $set";
        // echo $sql;
        return $this->db->execute($sql);
    }

    public function getDataById($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond ";
        return $this->db->select($sql);
    }
    public function insertData($table_name, $data)
    {
        return $this->db->insert($table_name, $data);
    }
    public function calculation($col, $res)
    {
        $sql = "SELECT $col FROM tbl_calculations LIMIT 1";
        $calculation = $this->db->select($sql);
        $calculation = $calculation[0][$col];
        //print_r($calculation);

        $sql = "UPDATE tbl_salary SET $res = $calculation";
        return $this->db->execute($sql);
    }


    public function updateData($table_name, $data, $cond)
    {
        return $this->db->update($table_name, $data, $cond);
    }
    public function deleteData($table_name, $cond)
    {
        return $this->db->delete($table_name, $cond);
    }
    public function getDataWI()
    {
        $sql = "SELECT * FROM tbl_test";
        return $this->db->select($sql);
    }
}
<?php
class interviewmodel extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function getData()
    {
        $sql = "SELECT * FROM tbl_recruitment";
        return $this->db->select($sql);
    }
    public function getDataById($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond ";
        return $this->db->select($sql);
    }
    public function insertDataSchedule($table_name, $data)
    {
        return $this->db->insertSchedule($table_name, $data);
    }
    public function insertDataPoint($table_name, $data, $cond)
    {
        return $this->db->update($table_name, $data, $cond);
    }
    public function updateDataCandidate($table_name, $data, $cond)
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
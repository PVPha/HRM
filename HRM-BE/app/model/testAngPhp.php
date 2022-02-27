<?php
class testAngPhp extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function getData()
    {
        $sql = "SELECT * FROM taskTracker";
        return $this->db->select($sql);
    }

    public function getDataWI()
    {
        $sql = "SELECT * FROM tbl_test";
        return $this->db->select($sql);
    }
}
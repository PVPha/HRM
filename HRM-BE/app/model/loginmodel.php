<?php
class loginmodel extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function login($table_name, $username, $password)
    {
        $sql = "SELECT * FROM $table_name WHERE username=? AND password=? ";
        return $this->db->affectedRows($sql, $username, $password);
    }
    public function getlogin($table_name, $username, $password)
    {
        $sql = "SELECT * FROM $table_name WHERE username=? AND password=? ";
        return $this->db->selectUser($sql, $username, $password);
    }


    public function insertadmin($table_name, $data)
    {
        return $this->db->insert($table_name, $data);
    }

    public function listadmin($table_name)
    {
        $sql = "SELECT * FROM $table_name ORDER BY admin_id DESC";
        return $this->db->select($sql);
    }

    public function adminbyid($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond ";
        return $this->db->select($sql);
    }
    public function deleteadmin($table_name, $cond)
    {
        return $this->db->delete($table_name, $cond);
    }

    public function listadminhome($table_name)
    {
        $sql = "SELECT * FROM $table_name ORDER BY admin_id DESC";
        return $this->db->select($sql);
    }
}
<?php
class trainingmodel extends Dmodel
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
    public function getData2File($cond)
    {
        $sql = "SELECT id_staff, fullName, position, department, id_training, name, time, result FROM `tbl_participate` WHERE id_training = '$cond' ORDER BY result DESC";
        return $this->db->select($sql);
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
    public function insertParticipate($ID)
    {
        $sql = "INSERT INTO `tbl_participate`(`id_staff`, `fullName`, `position`, `department`, `id_training`, `name`, `time`) SELECT st.id_staff, st.fullName, st.position, st.department, tr.id_training, tr.name, tr.time FROM tbl_staff st JOIN tbl_training tr ON tr.ID = $ID";
        // echo $sql;
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
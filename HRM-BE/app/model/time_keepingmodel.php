<?php
class time_keepingmodel extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function insertDataTK($table_name, $data)
    {
        return $this->db->insertTimeKeep($table_name, $data);
    }
    public function insertDataTKKPI($table_name, $data)
    {
        return $this->db->insertTimeKeepKPI($table_name, $data);
    }
    public function insertDataTKSale($table_name, $data)
    {
        return $this->db->insertTimeKeepSale($table_name, $data);
    }
    public function insertDataSalary($table_name, $data)
    {
        return $this->db->insertSalaryFromTK($table_name, $data);
    }
    public function getData($table_name)
    {
        $sql = "SELECT * FROM $table_name ORDER BY ID DESC";
        return $this->db->select($sql);
    }
    public function getDataWD()
    {
        $sql = "SELECT id_timeKeeping, id_staff, fullName, position, department,absent, holiday, mission, workDay, overtime, early, late FROM tbl_timekeep_temp";
        return $this->db->select($sql);
    }
    public function getDataKPI()
    {
        $sql = "SELECT id_timeKeeping, id_staff, fullName, position, department, setKPI, achieveKPI, classification FROM tbl_timekeep_temp";
        return $this->db->select($sql);
    }
    public function getDataSale()
    {
        $sql = "SELECT id_timeKeeping, id_staff, fullName, position, department, setSales, achieveSales,missingSales,exceedSales FROM tbl_timekeep_temp;";
        return $this->db->select($sql);
    }
    public function updateDataSalary($set)
    {
        $sql  = "UPDATE `tbl_salary` sa JOIN tbl_timekeep_temp tk ON sa.id_staff = tk.id_staff SET $set";
        return $this->db->execute($sql);
    }
    public function getDataById($table_name, $cond)
    {
        $sql = "SELECT * FROM $table_name WHERE $cond ";
        return $this->db->select($sql);
    }
    public function insertDataMission($table_name, $data)
    {
        return $this->db->insert($table_name, $data);
    }
    public function insertDataAbsent($table_name, $data)
    {
        return $this->db->insert($table_name, $data);
    }
    // public function insertDataPoint($table_name, $data, $cond)
    // {
    //     return $this->db->update($table_name, $data, $cond);
    // }
    public function updateDataMission($table_name, $data, $cond)
    {
        return $this->db->update($table_name, $data, $cond);
    }

    public function updateData($table_name, $data, $cond)
    {
        return $this->db->update($table_name, $data, $cond);
    }
    public function execute($sql)
    {
        return $this->db->execute($sql);
    }
    // public function deleteData($table_name, $cond)
    // {
    //     return $this->db->delete($table_name, $cond);
    // }
    // public function getDataWI()
    // {
    //     $sql = "SELECT * FROM tbl_test";
    //     return $this->db->select($sql);
    // }
}
<?php
class recordmodel extends Dmodel
{
    public function __construct()
    {
        // echo 'this is homemodel <br>';
        parent::__construct();
    }
    public function getData($table_name)
    {
        $sql = "SELECT * FROM $table_name  ORDER BY ID DESC";
        return $this->db->select($sql);
    }

    public function probation($now)
    {
        $sql = "UPDATE tbl_staff SET tbl_staff.status = 'chính thức' WHERE tbl_staff.id_staff in (SELECT tbl_hiring.id_staff FROM tbl_hiring WHERE DATEDIFF(tbl_hiring.time_end, 
        '$now') <= 0)";
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
    public function insertDataCancelContract($table_name, $data)
    {
        return $this->db->insert($table_name, $data);
    }
    public function updateData($table_name, $data, $cond)
    {
        return $this->db->update($table_name, $data, $cond);
    }
    public function updateFromRecord($table_name, $set, $cond)
    {
        $sql = "UPDATE `$table_name`  SET $set  WHERE $cond ";
        // echo $sql;
        return $this->db->execute($sql);
    }
    public function execute($table_name, $cond)
    {
        $sql = "UPDATE `$table_name` SET status = 'chính thức' WHERE $cond ";
        // echo $sql;
        return $this->db->execute($sql);
    }
    public function deleteCancel($cond)
    {
        $sql = " UPDATE `tbl_staff` s SET s.status = 'thôi việc' WHERE s.id_staff = '$cond';
        DELETE FROM tbl_timekeep_temp WHERE id_staff = '$cond'; 
        DELETE FROM tbl_salary WHERE id_staff = '$cond'; 
        DELETE FROM `tbl_candidate` WHERE id_candidate = (SELECT hr.id_candidate FROM tbl_hiring hr WHERE hr.id_staff = '$cond' );  
        DELETE FROM `tbl_hiring` WHERE id_staff = '$cond'
         ";
        //echo $sql;
        return $this->db->execute($sql);
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
    public function insertDataFromHiring($cond)
    {
        $sql = "INSERT INTO `tbl_staff`(`id_staff`, `fullName`, `sex`, `dateOfBirth`, `email`, `phoneNumber`, `address`, `position`, `department`, `salary`, `education`, `languageSkill`, `image`, `status`) SELECT hr.id_staff, cd.fullName, cd.sex, cd.dateOfBirth, cd.email, cd.phoneNumber, cd.address, cd.position, hr.department, hr.salary, cd.education, cd.languageSkill, cd.image, 'thử việc' FROM (tbl_hiring hr JOIN tbl_candidate cd ON hr.id_candidate = cd.id_candidate ) WHERE $cond";
        return $this->db->execute($sql);
    }
    public function insertDataSalaryFromHiring($cond)
    {
        $sql = "INSERT INTO `tbl_salary`( `id_staff`, `fullName`, `position`, `department`, `salary`, `coefficientSalary`) SELECT s.id_staff, s.fullName, s.position, s.department, s.salary, s.coefficientSalary FROM tbl_staff s WHERE $cond";
        return $this->db->execute($sql);
    }
    public function insertDataTimeKeepFromHiring($cond)
    {
        $sql = "INSERT INTO `tbl_timekeep_temp`( `id_timeKeeping`, `id_staff`, `fullName`, `position`, `department`, `leaveDay`) SELECT CONCAT('tk', s.ID), s.id_staff, s.fullName, s.position, s.department, s.leaveDay FROM tbl_staff s WHERE  $cond";
        return $this->db->execute($sql);
    }
}
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
// error_reporting(0);
class hiring extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }

    public function getData()
    {
        $recruitmentModel = $this->load->model('recruitmentmodel');
        $data = $recruitmentModel->getData();
        $data = json_encode($data);
        echo $data;
    }

    // public function getDataById($id)
    // {
    //     $recruitmentModel =  $this->load->model('recruitmentModel');
    //     $table_name = 'tbl_recruitment';
    //     $cond = "tbl_recruitment.ID='$id'";
    //     $data = $recruitmentModel->getDataById($table_name, $cond);
    //     echo json_encode($data);
    // }

    public function insertDataHiring()
    {
        $hiringModel = $this->load->model('hiringmodel');
        $table_name = 'tbl_hiring';

        // $id = $_POST['ID'];
        // $id_dicision = $_POST['id_dicision'];
        // $id_staff = $_POST['id_staff'];
        // $fullName = $_POST['fullName'];
        // $position = $_POST['position'];
        // $time = $_POST['time'];
        // $salary = $_POST['salary'];
        $data = json_decode($_POST['hiring']);
        $id = $data->ID;
        $id_dicision = $data->id_dicision;
        $id_candidate = $data->id_candidate;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $time = $data->time;
        $start = $data->start;
        $end = $data->end;
        $salary = $data->salary;

        $data = array(
            'ID' => '',
            'id_dicision' => $id_dicision,
            'id_candidate' => $id_candidate,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'time' => $time,
            'time_start' => $start,
            'time_end' => $end,
            'salary' => $salary,
        );
        // echo json_encode($data);
        // var_dump($data);
        $result = $hiringModel->insertDataHiring($table_name, $data);
        $candidateModel = $this->load->model('candidatemodel');
        $table_name = 'tbl_candidate';
        $cond = "tbl_candidate.ID=$id";
        $data = array('status' => 'tuyển dụng');
        $result =  $candidateModel->updateData($table_name, $data, $cond);
        $recordModel = $this->load->model('recordmodel');
        $cond = "hr.id_candidate = '$id_candidate'";
        $result = $recordModel->insertDataFromHiring($cond);
        echo json_encode($result);
        $cond = "s.id_staff = '$id_staff'";
        $recordModel->insertDataSalaryFromHiring($cond);
        $recordModel->insertDataTimeKeepFromHiring($cond);
    }

    public function insertDataPoint()
    {
        $interviewModel = $this->load->model('interviewmodel');
        $table_name = 'tbl_interview';

        // $id_candidate = $_POST['id_candidate'];
        // $fullName = $_POST['fullName'];
        // $time = $_POST['time'];
        // $location = $_POST['location'];
        // $form = $_POST['form'];
        // $noteSchedule = $_POST['noteSchedule'];
        // $expertise = $_POST['expertise'];
        // $evaluate = $_POST['evaluate'];
        // $noteInterview = $_POST['noteInterview'];
        // $approval = $_POST['approval'];

        if (isset($_POST['point'])) {
            $data = json_decode($_POST['point']);
            $id = $data->ID;
            $id_candidate = $data->id_candidate;
            $expertise = $data->expertise;
            $evaluate = $data->evaluate;
            $noteInterview = $data->noteInterview;
            $approval = $data->approval;
        }
        $cond = "tbl_interview.id_candidate=$id_candidate";
        $data = array(
            'id_candidate' => $id_candidate,
            'expertise' => $expertise,
            'evaluate' => $evaluate,
            'noteInterview' => $noteInterview,
            'approval' => $approval
        );
        $result = $interviewModel->insertDataPoint($table_name, $data, $cond);
        $table_name = 'tbl_candidate';
        $cond = "tbl_candidate.ID=$id";
        $data = array('status' => $approval);
        $result =  $interviewModel->updateDataCandidate($table_name, $data, $cond);
        echo json_encode($result);
    }

    // public function updateData()
    // {
    //     //$data = ['ID' => $_POST['ID'], 'require' => $_POST['require']];

    //     //$data = ['ID' => $_POST['ID'], 'id_recruit' => $_POST['id_recruit'], 'department' => $_POST['department'], 'position' => $_POST['position'],  'amount' => $_POST['amount'],  'time' => $_POST['time'], 'location' => $_POST['location']];

    //     //$data = ['ID' => $_POST['ID'], 'id_recruit' => $_POST['id_recruit'], 'department' => $_POST['department'], 'position' => $_POST['position'], 'require' => $_POST['require'], 'describe' => $_POST['describe'], 'amuont' => $_POST['amount'],  'time' => $_POST['time'], 'location' => $_POST['location'], 'benefit' => $_POST['benefit']];
    //     //$data = ['ID' => 18, 'id_recruit' => 'testupdate', 'department' => 'testupdate', 'time' => '2021-07-07', 'benefit' => '<p>testupdate</p>'];
    //     // var_dump($data);
    //     //$datajson = json_encode($data);
    //     $recruitmentModel = $this->load->model('recruitmentmodel');
    //     $parse = json_decode($_POST['recruitment']);
    //     //$parse = json_decode($datajson);
    //     // var_dump($parse);
    //     $id = $parse->ID;
    //     $table_name = 'tbl_recruitment';
    //     $cond = "tbl_recruitment.ID=$id";
    //     $getKey = '';
    //     $getValue = '';
    //     foreach ($parse as $key => $value) {
    //         $getKey .= $key . ',';
    //         $getValue .= $value . ',';
    //     };
    //     $getKey = rtrim($getKey, ',');
    //     $getValue = rtrim($getValue, ',');
    //     $key = explode(',', $getKey);
    //     $value = explode(',', $getValue);
    //     // var_dump($key);
    //     // $key = array_map($key[0], $key);
    //     // $value = array_map($value[0], $value);

    //     $count = count($key);
    //     // echo $count;
    //     $data = [];
    //     for ($i = 0; $i < $count; $i++) {
    //         $data[$key[$i]] = $value[$i];
    //     }
    //     // var_dump($data);
    //     $result = $recruitmentModel->updateData($table_name, $data, $cond);
    //     echo json_encode($data);
    // }

    // public function deleteData()
    // {
    //     $recruitmentModel = $this->load->model('recruitmentmodel');
    //     $table_name = 'tbl_recruitment';
    //     $parse = json_decode($_POST['recruitment']);
    //     $id = $parse->ID;
    //     //$id = $_POST['ID'];
    //     $cond = "tbl_recruitment.ID=$id";
    //     $result = $recruitmentModel->deleteData($table_name, $cond);
    //     $data = $recruitmentModel->getData();
    //     echo json_encode($data);
    // }
}
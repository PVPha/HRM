<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
error_reporting(0);
class records extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }
    public function test()
    {
        echo 'test';
    }
    // public function getDataById($id)
    // {
    //     $recruitmentModel =  $this->load->model('recruitmentModel');
    //     $table_name = 'tbl_recruitment';
    //     $cond = "tbl_recruitment.ID='$id'";
    //     $data = $recruitmentModel->getDataById($table_name, $cond);
    //     echo json_encode($data);
    // }

    public function insertDataStaffProfile()
    {

        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_staff';

        $data = json_decode($_POST['staff']);
        $id = $data->ID;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $sex = $data->sex;
        $dateOfBirth = $data->dateOfBirth;
        $identityCard = $data->identityCard;
        $nation = $data->nation;
        $homeTown = $data->homeTown;
        $email = $data->email;
        $phoneNumber = $data->phoneNumber;
        $address = $data->address;
        $position = $data->position;
        $department = $data->department;
        $health = $data->health;
        $salary = $data->salary;
        $coefficientSalary = $data->coefficientSalary;
        $leaveDay = $data->leaveDay;
        $education = $data->education;
        $languageSkill = $data->languageSkill;
        $data = array(
            // 'ID' => '',
            // 'id_staff' => $id_staff,
            'fullName' => $fullName,
            'sex' => $sex,
            'dateOfBirth' => $dateOfBirth,
            'identityCard' => $identityCard,
            'nation' => $nation,
            'homeTown' => $homeTown,
            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'address' => $address,
            'position' => $position,
            'department' => $department,
            'health' => $health,
            'salary' => $salary,
            'coefficientSalary' => $coefficientSalary,
            'leaveDay' => $leaveDay,
            'education' => $education,
            'languageSkill' => $languageSkill
        );
        $cond = "tbl_staff.id_staff = '$id_staff'";
        $result = $recordModel->updateData($table_name, $data, $cond);
        echo json_encode($data);
        $table_name = "tbl_salary";
        $data = [
            'coefficientSalary' => $coefficientSalary,
        ];
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $recordModel->updateData($table_name, $data, $cond);
        $table_name = "tbl_timekeep_temp";
        $data = [
            'leaveDay' => $leaveDay,
        ];
        $cond = "tbl_timekeep_temp.id_staff = '$id_staff'";
        $recordModel->updateData($table_name, $data, $cond);

        // $table_name = 'tbl_candidate';
        // $cond = "tbl_candidate.id_candidate = (SELECT hi.id_candidate FROM tbl_hiring hi JOIN tbl_staff st ON hi.id_staff = st.id_staff WHERE st.id_staff='$id_staff')";
        // $recordModel->execute($table_name, $cond);
    }

    public function updateDataStaffProfile()
    {

        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_staff';

        $data = json_decode($_POST['staff']);

        $id_staff = $data->id_staff;

        $email = $data->email;
        $phoneNumber = $data->phoneNumber;
        $address = $data->address;
        $position = $data->position;
        $department = $data->department;

        $salary = $data->salary;
        $coefficientSalary = $data->coefficientSalary;
        $leaveDay = $data->leaveDay;

        $data = array(
            // 'ID' => '',
            // 'id_staff' => $id_staff,

            'email' => $email,
            'phoneNumber' => $phoneNumber,
            'address' => $address,
            'position' => $position,
            'department' => $department,

            'salary' => $salary,
            'coefficientSalary' => $coefficientSalary,
            'leaveDay' => $leaveDay
        );
        $cond = "tbl_staff.id_staff = '$id_staff'";
        $result = $recordModel->updateData($table_name, $data, $cond);
        echo json_encode($data);
        $table_name = "tbl_salary";
        $data = [
            'position' => $position,
            'department' => $department,
            'salary' => $salary,
            'coefficientSalary' => $coefficientSalary,
        ];
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $recordModel->updateData($table_name, $data, $cond);
        $table_name = "tbl_timekeep_temp";
        $data = [
            'position' => $position,
            'department' => $department,
            'leaveDay' => $leaveDay,
        ];
        $cond = "tbl_timekeep_temp.id_staff = '$id_staff'";
        $recordModel->updateData($table_name, $data, $cond);
        $salary = $this->load->controller('salary');
        $salary->all();
        // $table_name = 'tbl_candidate';
        // $cond = "tbl_candidate.id_candidate = (SELECT hi.id_candidate FROM tbl_hiring hi JOIN tbl_staff st ON hi.id_staff = st.id_staff WHERE st.id_staff='$id_staff')";
        // $recordModel->execute($table_name, $cond);
    }

    public function insertDataContract()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_contract';
        $data = json_decode($_POST['contract']);
        $id_contract = $data->id_contract;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $dateOfBirth = $data->dateOfBirth;
        $typeContract = $data->typeContract;
        $duration = $data->duration;
        $time = json_encode($data->time);
        $phoneNumber = $data->phoneNumber;
        $address = $data->address;
        $identityCard = $data->identityCard;
        $position = $data->position;
        $department = $data->department;
        $content = $data->content;
        $data = array(
            'ID' => '',
            'id_contract' => $id_contract,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'dateOfBirth' => $dateOfBirth,
            'typeContract' => $typeContract,
            'duration' => $duration,
            'time' => $time,
            'phoneNumber' => $phoneNumber,
            'address' => $address,
            'identityCard' => $identityCard,
            'position' => $position,
            'department' => $department,
            'content' => $content
        );
        $result = $recordModel->insertData($table_name, $data);
        echo json_encode($result);
    }

    public function insertDataCancleContract()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_cancel_contract';
        $data = json_decode($_POST['cancle']);
        $id_decision = $data->id_decision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $time = $data->time;
        $reason = $data->reason;
        $status = $data->status;
        $data = [
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'time' => $time,
            'reason' => $reason,
            'status' => $status
        ];
        //print_r($data);
        $result = $recordModel->insertDataCancelContract($table_name, $data);
        echo json_encode($result);
        $table_name = "tbl_staff";
        $data = [
            'status' => $status
        ];
        $cond = "tbl_staff.id_staff = '$id_staff'";
        //$result2 = $recordModel->updateData($table_name, $data, $cond);
        //echo json_encode($result2);
        $result3 = $recordModel->deleteCancel($id_staff);
    }

    public function insertDataResource()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_resources';

        // $id_contract = $_POST['id_contract'];
        // $id_staff = $_POST['id_staff'];
        // $fullName = $_POST['fullName'];
        // $dateOfBirth = $_POST['dateOfBirth'];
        // $typeContract = $_POST['typeContract'];
        // $duration = $_POST['duration'];
        // $time = $_POST['time'];
        // $phoneNumber = $_POST['phoneNumber'];
        // $address = $_POST['address'];
        // $identityCard = $_POST['identityCard'];
        // $position = $_POST['position'];
        // $department = $_POST['department'];
        // $content = $_POST['content'];
        $data = json_decode($_POST['resources']);
        $id_dicision = $data->id_dicision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $time = $data->time;
        $content = $data->content;
        $data = array(
            'ID' => '',
            'id_dicision' => $id_dicision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'time' => $time,
            'content' => $content
        );
        $result = $recordModel->insertData($table_name, $data);
        echo json_encode($result);
    }
    public function insertDataReward()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_reward';
        $data = json_decode($_POST['reward']);
        $id_decision = $data->id_decision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $time = $data->time;

        $content = $data->content;
        $money = $this->content($content, 2);
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'time' => $time,
            'money' => $money,
            'content' => $content
        );
        // print_r($data);
        $result = $recordModel->insertData($table_name, $data);
        echo json_encode($data);
        $table_name = 'tbl_salary';
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $reward = $recordModel->getDataById($table_name, $cond);
        // print_r($reward);
        $reward = $reward[0]['reward'];
        // echo $cond;
        $data = [
            'money' => $money,
            'reward' => $reward
        ];
        $set = "tbl_salary.reward = '"  . $data['reward'] + $data['money'] . "'";
        $recordModel->updateFromRecord($table_name, $set, $cond);
        $salary = $this->load->controller('salary');
        $salary->all();
    }
    public function insertDataAppoint()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_appoint';
        $data = json_decode($_POST['appoint']);
        $id_decision = $data->id_decision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $pos_appoint = $data->pos_appoint;
        $dep_appoint = $data->dep_appoint;
        $time = $data->time;
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'pos_appoint' => $pos_appoint,
            'dep_appoint' => $dep_appoint,
            'time' => $time
        );
        // print_r($data);
        $result = $recordModel->insertData($table_name, $data);
        echo json_encode($data);
        $table_name = 'tbl_staff';
        $cond = "tbl_staff.id_staff = '$id_staff'";
        $set = "tbl_staff.position = '$pos_appoint' , tbl_staff.department = '$dep_appoint'";
        // echo $set;
        $recordModel->updateFromRecord($table_name, $set, $cond);
    }
    public function getDataCC()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_cancel_contract';
        $data = $recordModel->getData($table_name);
        echo json_encode($data);
    }
    public function content($content, $col)
    {
        $content = str_replace("\n", '', $content);
        $content = substr($content, strpos($content, '<tbody>') + 6, strpos($content, '</tbody>'));
        $content = substr($content, strpos($content, '<td>'), strrpos($content, '</td>'));
        $content = explode('</tr><tr>', $content);
        foreach ($content as $key => $value) {
            $content[$key] = str_replace('</td>', '<td>', $content[$key]);
            $content[$key] = trim($content[$key], "<td>");
            $content[$key] = explode('<td><td>', $content[$key]);
        }

        $sum = 0;
        $count = count($content);
        for ($i = 0; $i < $count; $i++) {
            $sum += $content[$i][$col];
        }
        return $sum;
    }

    public function insertDataDiscipline()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_discipline';
        $data = json_decode($_POST['discipline']);
        $id_decision = $data->id_decision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $time = $data->time;
        $content = $data->content;
        $money =  $this->content($content, 2);
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'money' => $money,
            'time' => $time,
            'content' => $content
        );
        // print_r($data);
        $result = $recordModel->insertData($table_name, $data);
        //echo json_encode($data);
        $table_name = 'tbl_salary';
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $reward = $recordModel->getDataById($table_name, $cond);
        // print_r($reward);
        $discipline = $reward[0]['discipline'];
        // echo $cond;
        // $data = [
        //     'money' => $money,
        //     'reward' => $reward
        // ];
        $set = "tbl_salary.discipline = '"  . $discipline + $money . "'";
        $recordModel->updateFromRecord($table_name, $set, $cond);
        $salary = $this->load->controller('salary');
        $salary->all();
    }

    public function insertDataTax()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_tax';
        $data = json_decode($_POST['tax']);
        $id_decision = $data->id_decision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $time = $data->time;
        $percent = ($data->percent / 100);
        $content = $data->content;
        $deduction = $this->content($content, 1);
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'time' => $time,
            'deduction' => $deduction,
            'percent' => $percent,
            'content' => $content
        );
        // print_r($data);
        $result = $recordModel->insertData($table_name, $data);
        echo $result;
        echo json_encode($data);
        $table_name = 'tbl_salary';
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $set = "tbl_salary.tax = $percent, tbl_salary.deduction = $deduction";
        $recordModel->updateFromRecord($table_name, $set, $cond);
        $salary = $this->load->controller('salary');
        $salary->all();
    }
    public function insertDataInsurance()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_insurance';
        $data = json_decode($_POST['insurance']);
        $id_decision = $data->id_decision;
        $id_insurance = $data->id_insurance;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $time = json_encode($data->time);
        $insurance = $data->insurance;
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_insurance' => $id_insurance,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'time' => $time,
            'insurance' => $insurance
        );
        $recordModel->insertData($table_name, $data);
        echo json_encode($data);
        $table_name = 'tbl_salary';
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $set = "tbl_salary.insurance = $insurance";
        $recordModel->updateFromRecord($table_name, $set, $cond);
        $salary = $this->load->controller('salary');
        $salary->all();
    }
    public function insertDataAllowance()
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_allowance';
        $data = json_decode($_POST['allowance']);
        $id_decision = $data->id_decision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $time = $data->time;
        $content_allowance = $data->content_allowance;
        $content_subsidy = $data->content_subsidy;
        $allowance = $this->content($content_allowance, 1);
        $subsidy = $this->content($content_subsidy, 1);
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'time' => $time,
            'content_allowance' => $content_allowance,
            'content_subsidy' => $content_subsidy,
            'allowance' => $allowance,
            'subsidy' => $subsidy
        );

        $recordModel->insertData($table_name, $data);
        echo json_encode($data);
        $table_name = 'tbl_salary';
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $set = "tbl_salary.allowance = $allowance, tbl_salary.subsidy = $subsidy ";
        $recordModel->updateFromRecord($table_name, $set, $cond);
        $salary = $this->load->controller('salary');
        $salary->all();
    }
    public function getDataStaffProfile()
    {
        $recordModel = $this->load->model('recordmodel');
        $recordModel->probation(date('Y-m-d'));
        $data = $recordModel->getData('tbl_staff');
        $data = json_encode($data);
        echo $data;
    }
    public function decision($table)
    {
        $recordModel = $this->load->model('recordmodel');
        $data = $recordModel->getData("tbl_$table");
        $data = json_encode($data);
        echo $data;
    }
    public function getDataStaffProfileById($id)
    {
        $recordModel = $this->load->model('recordmodel');
        $table_name = 'tbl_staff';
        $cond = "tbl_staff.ID='$id'";
        $data = $recordModel->getDataById($table_name, $cond);
        echo json_encode($data);
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
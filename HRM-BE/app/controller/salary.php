<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
class salary extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }

    public function getData()
    {
        $salaryModel = $this->load->model('salarymodel');
        $data = $salaryModel->getData('tbl_salary');
        $data = json_encode($data);
        echo $data;
    }
    public function getDataIncrease()
    {
        $salaryModel = $this->load->model('salarymodel');
        $data = $salaryModel->getData('tbl_increasesalary');
        $data = json_encode($data);
        echo $data;
    }
    public function getDataAdvance()
    {
        $salaryModel = $this->load->model('salarymodel');
        $data = $salaryModel->getData('tbl_advance');
        $data = json_encode($data);
        echo $data;
    }

    public function getDataCalculation()
    {
        $salaryModel = $this->load->model('salarymodel');
        $data = $salaryModel->getDataCalculation();
        $data = json_encode($data);
        echo $data;
    }

    public function updateDataCalculation()
    {
        $salaryModel = $this->load->model('salarymodel');
        $data = json_decode($_POST['calculation']);
        $workDay = $data->workDay;
        $KPI = $data->KPI;
        $sale = $data->sale;
        $table_name = 'tbl_calculations';
        $set = "workDay = '$workDay', KPI = '$KPI', sale = '$sale' ";
        $result =  $salaryModel->execute($table_name, $set);
        echo json_encode($result);
        $col = 'KPI';
        $res = 'KPI_salary';
        $salaryModel->calculation($col, $res);
        $col = 'sale';
        $res = 'sale_salary';
        $salaryModel->calculation($col, $res);
        $col = 'workDay';
        $res = 'workDay_salary';
        $salaryModel->calculation($col, $res);
        $col = 'received';
        $res = 'received';
        $salaryModel->calculation($col, $res);
    }
    public function getDataById($id)
    {
        $salaryModel = $this->load->model('salarymodel');
        $table_name = 'tbl_salary';
        $cond = "tbl_salary.ID='$id'";
        $data = $salaryModel->getDataById($table_name, $cond);
        $data = json_encode($data);
        echo $data;
    }


    public function salaryWorkDay()
    {
        $col = 'workDay';
        $res = 'workDay_salary';
        $this->calculation($col, $res);
    }

    public function salaryKPI()
    {
        $col = 'KPI';
        $res = 'KPI_salary';
        $this->calculation($col, $res);
    }

    public function salarySale()
    {
        $col = 'sale';
        $res = 'sale_salary';
        $this->calculation($col, $res);
    }

    public function received()
    {
        $col = 'received';
        $res = 'received';
        $this->calculation($col, $res);
    }
    public function calculation($col, $res)
    {
        $salaryModel = $this->load->model('salarymodel');
        $salaryModel->calculation($col, $res);
    }
    public function all()
    {
        $salaryModel = $this->load->model('salarymodel');
        $col = 'KPI';
        $res = 'KPI_salary';
        $salaryModel->calculation($col, $res);
        $col = 'sale';
        $res = 'sale_salary';
        $salaryModel->calculation($col, $res);
        $col = 'workDay';
        $res = 'workDay_salary';
        $salaryModel->calculation($col, $res);
        $col = 'received';
        $res = 'received';
        $salaryModel->calculation($col, $res);
        // echo 'work';
    }
    public function insertData()
    {
        $recruitmentModel = $this->load->model('recruitmentmodel');
        $table_name = 'tbl_recruitment';
        if (isset($_POST['recruitment'])) {
            $data = json_decode($_POST['recruitment']);
            $id_recruit = $data->id_recruit;
            $department = $data->department;
            $position = $data->position;
            $require = $data->require;
            $describe = $data->describe;
            $amount = $data->amount;
            $time = $data->time;
            $location = $data->location;
            $benefit = $data->benefit;
            $approval = $data->approval;
        }
        $data = array(
            'ID' => '',
            'id_recruit' => $id_recruit,
            'department' => $department,
            'position' => $position,
            'require' => $require,
            'describe' => $describe,
            'amount' => $amount,
            'time' => $time,
            'location' => $location,
            'benefit' => $benefit,
            'approval' => $approval
        );
        $result = $recruitmentModel->insertData($table_name, $data);
        echo json_encode($data);
    }

    public function insertDataIncreaseSalary()
    {
        $salaryModel = $this->load->model('salarymodel');
        $table_name = 'tbl_increasesalary';
        if (isset($_POST['increase'])) {
            $data = json_decode($_POST['increase']);
            $id_decision = $data->id_decision;
            $id_staff = $data->id_staff;
            $fullName = $data->fullName;
            $department = $data->department;
            $position = $data->position;
            $time = $data->time;
            $current = $data->current;
            $increase = $data->increase;
            $content = $data->content;
        }
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'department' => $department,
            'position' => $position,
            'time' => $time,
            'current' => $current,
            'increase' => $increase,
            'content' => $content
        );
        $result = $salaryModel->insertData($table_name, $data);
        $table_name = 'tbl_salary';
        $salaryIncrease = $current + $increase;
        $data = [
            'salary' => $salaryIncrease
        ];
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $result = $salaryModel->updateData($table_name, $data, $cond);
        echo json_encode($result);
        $col = 'workDay';
        $res = 'workDay_salary';
        $salaryModel->calculation($col, $res);
        $col = 'received';
        $res = 'received';
        $salaryModel->calculation($col, $res);
    }


    public function insertDataAdvanceSalary()
    {
        $salaryModel = $this->load->model('salarymodel');
        $table_name = 'tbl_advance';
        if (isset($_POST['advance'])) {
            $data = json_decode($_POST['advance']);
            $ID = $data->ID;
            $id_decision = $data->id_decision;
            $id_staff = $data->id_staff;
            $fullName = $data->fullName;
            $department = $data->department;
            $position = $data->position;
            $time = $data->time;
            $advance = $data->advance;
            $content = $data->content;
        }
        $data = array(
            'ID' => '',
            'id_decision' => $id_decision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'department' => $department,
            'position' => $position,
            'time' => $time,
            'advance' => $advance,
            'content' => $content
        );
        $result = $salaryModel->insertData($table_name, $data);
        $table_name = 'tbl_salary';
        $cond = "tbl_salary.ID = '$ID'";
        $dataAdvance = $salaryModel->getDataById($table_name, $cond);
        $salaryAdvance = $dataAdvance[0]['advance'] + $advance;
        $data = [
            'advance' => $salaryAdvance
        ];
        $cond = "tbl_salary.id_staff = '$id_staff'";
        $result = $salaryModel->updateData($table_name, $data, $cond);
        echo json_encode($result);
        $col = 'workDay';
        $res = 'workDay_salary';
        $salaryModel->calculation($col, $res);
        $col = 'received';
        $res = 'received';
        $salaryModel->calculation($col, $res);
    }

    public function updateData()
    {
        $recruitmentModel = $this->load->model('recruitmentmodel');
        $parse = json_decode($_POST['recruitment']);

        $id = $parse->ID;
        $table_name = 'tbl_recruitment';
        $cond = "tbl_recruitment.ID=$id";
        $getKey = '';
        $getValue = '';
        foreach ($parse as $key => $value) {
            $getKey .= $key . ',';
            $getValue .= $value . ',';
        };
        $getKey = rtrim($getKey, ',');
        $getValue = rtrim($getValue, ',');
        $key = explode(',', $getKey);
        $value = explode(',', $getValue);
        // var_dump($key);
        // $key = array_map($key[0], $key);
        // $value = array_map($value[0], $value);

        $count = count($key);
        // echo $count;
        $data = [];
        for ($i = 0; $i < $count; $i++) {
            $data[$key[$i]] = $value[$i];
        }
        // var_dump($data);
        $result = $recruitmentModel->updateData($table_name, $data, $cond);
        echo json_encode($data);
    }

    public function deleteData()
    {
        $recruitmentModel = $this->load->model('recruitmentmodel');
        $table_name = 'tbl_recruitment';
        $parse = json_decode($_POST['recruitment']);
        $id = $parse->ID;
        //$id = $_POST['ID'];
        $cond = "tbl_recruitment.ID=$id";
        $result = $recruitmentModel->deleteData($table_name, $cond);
        $data = $recruitmentModel->getData();
        echo json_encode($data);
    }
}
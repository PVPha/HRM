<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
class recruitment extends Dcontroller
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

    public function getDataById($id)
    {
        $recruitmentModel =  $this->load->model('recruitmentModel');
        $table_name = 'tbl_recruitment';
        $cond = "tbl_recruitment.ID='$id'";
        $data = $recruitmentModel->getDataById($table_name, $cond);
        echo json_encode($data);
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

    public function updateData()
    {
        //$data = ['ID' => $_POST['ID'], 'require' => $_POST['require']];

        //$data = ['ID' => $_POST['ID'], 'id_recruit' => $_POST['id_recruit'], 'department' => $_POST['department'], 'position' => $_POST['position'],  'amount' => $_POST['amount'],  'time' => $_POST['time'], 'location' => $_POST['location']];

        //$data = ['ID' => $_POST['ID'], 'id_recruit' => $_POST['id_recruit'], 'department' => $_POST['department'], 'position' => $_POST['position'], 'require' => $_POST['require'], 'describe' => $_POST['describe'], 'amuont' => $_POST['amount'],  'time' => $_POST['time'], 'location' => $_POST['location'], 'benefit' => $_POST['benefit']];
        //$data = ['ID' => 18, 'id_recruit' => 'testupdate', 'department' => 'testupdate', 'time' => '2021-07-07', 'benefit' => '<p>testupdate</p>'];
        // var_dump($data);
        //$datajson = json_encode($data);
        $recruitmentModel = $this->load->model('recruitmentmodel');
        $parse = json_decode($_POST['recruitment']);
        //$parse = json_decode($datajson);
        // var_dump($parse);
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
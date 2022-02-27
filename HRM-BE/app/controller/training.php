<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
error_reporting(0);
class training extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }

    public function getData()
    {
        $trainingmodel = $this->load->model('trainingmodel');
        $data = $trainingmodel->getData('tbl_training');
        $data = json_encode($data);
        echo $data;
    }
    public function getData2File($id_training)
    {
        $trainingmodel = $this->load->model('trainingmodel');
        $data = $trainingmodel->getData2File($id_training);
        $data = json_encode($data);
        echo $data;
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

    public function getDataById($id)
    {
        $trainingmodel =  $this->load->model('trainingmodel');
        $table_name = 'tbl_training';
        $cond = "tbl_training.ID='$id'";
        $data = $trainingmodel->getDataById($table_name, $cond);
        echo json_encode($data);
    }

    public function getDataParticipate($id)
    {
        $trainingmodel =  $this->load->model('trainingmodel');
        $table_name = 'tbl_participate';
        $cond = "tbl_participate.id_training='$id'";
        $data = $trainingmodel->getDataById($table_name, $cond);
        echo json_encode($data);
    }

    public function getDataProcess($id)
    {
        $trainingmodel =  $this->load->model('trainingmodel');
        $table_name = 'tbl_participate';
        $cond = "tbl_participate.id_staff='$id'";
        $data = $trainingmodel->getDataById($table_name, $cond);
        echo json_encode($data);
    }

    public function updateDataProcess()
    {
        $trainingmodel =  $this->load->model('trainingmodel');
        $table_name = 'tbl_participate';
        $parse = json_decode($_POST['process']);
        $id_training = $parse->id_training;
        $id_staff = $parse->id_staff;
        $time = $parse->time;
        $diligence = $parse->diligence;
        $note = $parse->note;
        $evaluate = $parse->evaluate;
        $result = $this->content($evaluate, 2);
        $data = array(
            'time' => $time,
            'diligence' => $diligence,
            'note' => $note,
            'evaluate' => $evaluate,
            'result' => $result,
            'status' => 'Hoàn thành'
        );
        $cond = "tbl_participate.id_staff = '$id_staff'";
        $result = $trainingmodel->updateData($table_name, $data, $cond);
        echo json_encode($data);
    }
    public function insertData()
    {
        $trainingmodel = $this->load->model('trainingmodel');
        $table_name = 'tbl_training';
        if (isset($_POST['training'])) {
            $data = json_decode($_POST['training']);
            $id_training = $data->id_training;
            $name = $data->name;
            $time = $data->time;
            $location = $data->location;
            $trainers = $data->trainers;
            $content = $data->content;
        }
        $data = array(
            'ID' => '',
            'id_training' => $id_training,
            'name' => $name,
            'time' => $time,
            'location' => $location,
            'trainers' => $trainers,
            'content' => $content,
            'status' => 'chờ'
        );
        $result = $trainingmodel->insertData($table_name, $data);
        echo json_encode($data);
    }

    public function insertDataParticipate()
    {
        $trainingmodel = $this->load->model('trainingmodel');
        $table_name = 'tbl_training';
        if (isset($_POST['approval'])) {
            $data = json_decode($_POST['approval']);
            $ID = $data->ID;
            $approval = $data->approval;
        }
        $cond = "tbl_training.ID = '$ID'";
        $data = array(
            'status' => $approval
        );
        $result = $trainingmodel->updateData($table_name, $data, $cond);
        echo json_encode($result);
        if ($approval == 'duyệt') {
            $trainingmodel->insertParticipate($ID);
        }
    }


    public function updateData()
    {
        //$data = ['ID' => $_POST['ID'], 'require' => $_POST['require']];

        //$data = ['ID' => $_POST['ID'], 'id_training' => $_POST['id_training'], 'department' => $_POST['department'], 'position' => $_POST['position'],  'amount' => $_POST['amount'],  'time' => $_POST['time'], 'location' => $_POST['location']];

        //$data = ['ID' => $_POST['ID'], 'id_training' => $_POST['id_training'], 'department' => $_POST['department'], 'position' => $_POST['position'], 'require' => $_POST['require'], 'describe' => $_POST['describe'], 'amuont' => $_POST['amount'],  'time' => $_POST['time'], 'location' => $_POST['location'], 'benefit' => $_POST['benefit']];
        //$data = ['ID' => 18, 'id_training' => 'testupdate', 'department' => 'testupdate', 'time' => '2021-07-07', 'benefit' => '<p>testupdate</p>'];
        // var_dump($data);
        //$datajson = json_encode($data);
        $trainingmodel = $this->load->model('trainingmodel');
        $parse = json_decode($_POST['recruitment']);
        //$parse = json_decode($datajson);
        // var_dump($parse);
        $id = $parse->ID;
        $table_name = 'tbl_training';
        $cond = "tbl_training.ID=$id";
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
        $result = $trainingmodel->updateData($table_name, $data, $cond);
        echo json_encode($data);
    }

    public function deleteData()
    {
        $trainingmodel = $this->load->model('trainingmodel');
        $table_name = 'tbl_training';
        $parse = json_decode($_POST['recruitment']);
        $id = $parse->ID;
        //$id = $_POST['ID'];
        $cond = "tbl_training.ID=$id";
        $result = $trainingmodel->deleteData($table_name, $cond);
        $data = $trainingmodel->getData();
        echo json_encode($data);
    }
}
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
// header("Access-Control-Allow-Headers: Content-Type");
error_reporting(0);
class candidate extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }

    public function getData()
    {
        $candidateModel = $this->load->model('candidatemodel');
        $data = $candidateModel->getData('tbl_candidate');
        $data = json_encode($data);
        echo $data;
    }
    public function getDataHiring()
    {
        $candidateModel = $this->load->model('candidatemodel');
        $data = $candidateModel->getData('tbl_hiring');
        $data = json_encode($data);
        echo $data;
    }

    public function getDataById($id)
    {
        $candidateModel =  $this->load->model('candidatemodel');
        $table_name = 'tbl_candidate';
        $cond = "tbl_candidate.ID='$id'";
        $data = $candidateModel->getDataById($table_name, $cond);
        echo json_encode($data);
    }

    public function insertData()
    {
        // $data = array(
        //     'id_candidate' => $_POST['id_candidate'],
        //     'fullName' => $_POST['fullName'],
        //     'sex' => $_POST['sex'],
        //     'dateOfBirth' => $_POST['dateOfBirth'],
        //     'phoneNumber' => $_POST['phoneNumber'],
        //     'email' => $_POST['email'],
        //     'position' => $_POST['position'],
        //     'exp' => $_POST['exp'],
        //     'skill' => $_POST['skill'],
        //     'education' => $_POST['education'],
        //     'languageSkill' => $_POST['languageSkill'],
        //     'status' => $_POST['status']
        // );
        // $data = json_encode($data);

        $candidateModel = $this->load->model('candidatemodel');
        $table_name = 'tbl_candidate';



        $data = json_decode($_POST['candidate']);
        // $data = json_decode($data);
        $id_candidate = $data->id_candidate;
        $fullName = $data->fullName;
        $sex = $data->sex;
        $dateOfBirth = $data->dateOfBirth;
        $phoneNumber = $data->phoneNumber;
        $email = $data->email;
        $address = $data->address;
        $position = $data->position;
        $exp = $data->exp;
        $skill = $data->skill;
        $education = $data->education;
        $languageSkill = $data->languageSkill;
        $status = $data->status;

        $time = time();
        $image = $data->image;
        $imgExt = substr($image, strrpos($image, '.'));
        $image = substr($image, 0, strpos($image, '.'));
        echo $imgExt;
        $image = preg_replace('/[^A-Za-z0-9\-]/', '', $image);
        $url = 'assets/image/' . $time . '-' . $image;


        //start upload file
        // get the file
        $file = $_FILES['file']['name'];
        // echo $file . '<br>';
        // get file extension
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        //target folder
        $target_path = "assets/image/";
        //replace special char in the file name
        $actual_fname = $_FILES['file']['name'];
        $actual_fname = substr($actual_fname, 0, strpos($actual_fname, '.'));
        $actual_fname = preg_replace('/[^A-Za-z0-9\-]/', '', $actual_fname);
        // echo $actual_fname . '<br>';
        //the file exitsting
        $modified_fname = $time . '-' . $actual_fname;
        // $modified_fname = $url;
        // echo $modified_fname . 'br';
        $target_path = $target_path . basename($modified_fname) . "." . $ext;


        // echo $target_path;
        // $target_path = $target_path . $modified_fname . "." . $ext;
        // var_dump($_FILES['file']);
        // move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
        // $div = explode('.', ltrim(substr($file, strrpos($file, '\\')), '\\'));
        // print_r($div);
        //end upload file
        move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
        $data = array(
            'ID' => '',
            'id_candidate' => $id_candidate,
            'fullName' => $fullName,
            'sex' => $sex,
            'dateOfBirth' => $dateOfBirth,
            'phoneNumber' => $phoneNumber,
            'email' => $email,
            'address' => $address,
            'position' => $position,
            'exp' => $exp,
            'skill' => $skill,
            'education' => $education,
            'languageSkill' => $languageSkill,
            'status' => $status,
            'image' => BASE_URL . $url . $imgExt
        );
        // var_dump($data);
        $result = $candidateModel->insertData($table_name, $data);

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
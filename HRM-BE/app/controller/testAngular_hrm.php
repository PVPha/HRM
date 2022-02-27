<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
// error_reporting(0);
class testAngular_hrm extends Dcontroller
{
    private $urlImg = '';

    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }
    public function testGet()
    {
        $testAngPhp = $this->load->model('testAngPhp');
        $data = $testAngPhp->getData();
        $data = json_encode($data);
        echo $data;
    }

    public function testGetWI()
    {
        $testAngPhp = $this->load->model('testAngPhp');
        $data = $testAngPhp->getDataWI();
        $data = json_encode($data);
        $data = trim($data, " \[\]\{\}");
        $data = explode('},{', $data);
        foreach ($data as $key => $value) {
            $data[$key] = explode(',', $value);
            // $data[$key] = json_decode($value);
            // foreach ($data[$key] as $sub_key => $sub_value) {
            //     $data[$key][$sub_key] = substr($sub_value, strpos(':', $sub_value));
            // }
        }
        print_r($data);
    }

    public function testFormData()
    {
        // if (isset($_POST['test'])) {
        //     $res = 'formData work <br> value: ' . $_POST['test'];
        //     echo json_encode($res);
        // }
        if (isset($_POST['recruitment'])) {
            $recruitment =  json_decode($_POST['recruitment']);
            echo json_encode($recruitment->id_recruit);
        }
    }

    public function test()
    {
        $data = ['mot' => 1, 'hai' => 2];
        $key = implode(',', array_keys($data));
        // echo $key . '<br>';
        $value = ':' . implode(', :', array_keys($data));
        // echo ($key);
        echo ($value);
    }

    public function testTimeKeep()
    {
        // echo 'timekeep';
        if (isset($_POST['test'])) {
            echo 'sdf';
        }

        // $data = json_decode($_POST['test']);
        // echo $data->Column1;
        // echo $data
        // var_dump($_POST['test']);
    }

    public function testUploadFile()
    {
        global $urlImg;

        // get the file
        $file = $_FILES['img']['name'];
        // $file = $files['name'];
        // get file extension
        // $ext = pathinfo($file, PATHINFO_EXTENSION);
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        //target folder
        $target_path = "assets/image/";
        //replace special char in the file name
        $actual_fname = $_FILES['img']['name'];
        // $actual_fname = $files['name'];
        $actual_fname = substr($actual_fname, 0, strpos($actual_fname, '.'));
        $actual_fname = preg_replace('/[^A-Za-z0-9\-]/', '', $actual_fname);
        //the file exitsting
        $modified_fname = time() . '-' . $actual_fname;
        $target_path = $target_path . basename($modified_fname) . "." . $ext;
        // var_dump($_FILES['file']);
        // move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
        // echo json_encode(BASE_URL . $target_path);
        // echo json_encode($test);
        // $this->urlImg = $target_path;
        // echo json_encode($this->urlImg);
        // return $this->urlImg;
        // echo $target_path;
        $this->urlImg = &$target_path;
        // $target_path = &$this->urlImg;
        // echo $this->urlImg;
        echo $this->urlImg;
    }


    public function testUpdateID()
    {
        global $test;
        $test = 'test';

        $data = ['test' => $_POST['test'], 'test2' => $_POST['test2']];
        // foreach ($data as $key => $value) {
        //     echo $key;
        // }

        // $data = json_decode($_POST['recruitment']);
        $data = json_encode($data);
        $data2 = json_decode($data);
        $getKey = '';
        $getValue = '';
        foreach ($data2 as $key => $value) {
            $getKey .= $key . ',';
            $getValue .= $value . ',';
        };
        $getKey = rtrim($getKey, ',');
        $getValue = rtrim($getValue, ',');
        $key = explode(',', $getKey);
        $value = explode(',', $getValue);
        $count = count($key);
        // echo $count;
        $data3 = [];
        for ($i = 0; $i < $count; $i++) {
            $data3[$key[$i]] = $value[$i];
        }
        // var_dump($data3);
        // print_r($data3[0]);
        // print_r($value);
        // print_r($getKey);
        // var_dump($data);
        // var_dump($data2);
        echo json_encode($this->testUploadFile($_FILES['file']));
    }



    private $test;

    public function A()
    {
        $rs = $this->testUploadFile($_FILES['file']);
        echo $rs;
    }

    public function B()
    {
    }
}
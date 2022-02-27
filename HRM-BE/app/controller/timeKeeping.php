<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
error_reporting(0);
class timeKeeping extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }

    public function getData()
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $data = $timeKeepingModel->getData('tbl_timekeep_temp');
        $data = json_encode($data);
        echo $data;
    }
    public function getData2File()
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $WD = $timeKeepingModel->getDataWD();
        $KPI = $timeKeepingModel->getDataKPI();

        foreach ($KPI as $key => $value) {
            $value['classification'] = $this->convertClassification($value['classification']);
            $KPI[$key]['classification'] = $value['classification'];
            // print_r($value['classification']);
        };
        //print_r($KPI);
        $SALE = $timeKeepingModel->getDataSale();
        $data = [
            'WD' => $WD,
            'KPI' => $KPI,
            'SALE' => $SALE
        ];
        $file = json_encode($data);
        echo $file;
    }
    public function decision($table)
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $data = $timeKeepingModel->getData('tbl_' . $table);
        $data = json_encode($data);
        echo $data;
    }



    public function getDataById($id)
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $table_name = 'tbl_timekeep_temp';
        $cond = "tbl_timekeep_temp.ID='$id'";
        $data = $timeKeepingModel->getDataById($table_name, $cond);
        echo json_encode($data);
    }

    public function insertDataMission()
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $table_name = 'tbl_mission';
        // var_dump($_POST['test']);
        $data = json_decode($_POST['mission']);
        $id_dicision = $data->id_dicision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $location = $data->location;
        $date_dicision = $data->date_dicision;
        $cost = $data->cost;
        $time = $data->time;
        $content = $data->content;
        $count = $data->count;
        $data = array(
            'ID' => '',
            'id_dicision' => $id_dicision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'location' => $location,
            'date_dicision' => $date_dicision,
            'cost' => $cost,
            'time' => $time,
            'content' => $content,
        );
        // var_dump($data);
        $result =  $timeKeepingModel->insertDataMission($table_name, $data);
        // echo json_encode($result);
        $table_name = "tbl_timekeep_temp";
        $cond = "tbl_timekeep_temp.id_staff = '$id_staff'";
        $time = json_decode($time);
        $start = explode('-', $time->start);
        $end = explode('-', $time->end);
        $time = (($end[1] - $start[1]) - $start[0]) + $end[0];
        echo $time;
        $data = array(
            'mission' => $time
        );
        $timeKeepingModel->updateDataMission($table_name, $data, $cond);
        // if (($_POST['test'])) {
        //     echo 'arr';
        // }

        // echo json_decode($_POST['test'][0]);
        // $data = json_decode($_POST['test'][0]);
        // echo $data;
    }

    public function insertDataAbsent()
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        // $table_name = 'tbl_mission';
        // var_dump($_POST['test']);

        $data = json_decode($_POST['absent']);
        $id_dicision = $data->id_dicision;
        $id_staff = $data->id_staff;
        $fullName = $data->fullName;
        $position = $data->position;
        $department = $data->department;
        $time = $data->time;
        $content = $data->content;
        $data = array(
            'ID' => '',
            'id_dicision' => $id_dicision,
            'id_staff' => $id_staff,
            'fullName' => $fullName,
            'position' => $position,
            'department' => $department,
            'time' => $time,
            'content' => $content,
        );
        $result =  $timeKeepingModel->insertDataAbsent('tbl_absent', $data);
        // echo json_encode($result);
        $table_name = "tbl_timekeep_temp";
        $cond = "tbl_timekeep_temp.id_staff = '$id_staff'";
        $data = $timeKeepingModel->getDataById($table_name, $cond);
        $leaveDay = $data[0]['leaveDay'];
        $absent = $data[0]['absent'];
        if ($leaveDay > 0) {
            $sql = "UPDATE tbl_timekeep_temp SET leaveDay = ($leaveDay - 1), absent = ($absent + 1) WHERE tbl_timekeep_temp.id_staff = '$id_staff' ";
            $timeKeepingModel->execute($sql);
            $data = [
                'leaveDay' => $leaveDay - 1,
                'absent' => $absent + 1
            ];
            echo json_encode($data);
        } else {
            echo json_encode('hết ngày phép');
        }
        // print_r($data);
        // echo $sql;

        // $data = array(
        //     'mission' => $time
        // );
        // $timeKeepingModel->updateDataMission($table_name, $data, $cond);
        // if (($_POST['test'])) {
        //     echo 'arr';
        // }

        // echo json_decode($_POST['test'][0]);
        // $data = json_decode($_POST['test'][0]);
        // echo $data;
    }

    public function insertData()
    {
        // echo 'test';
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $table_name = 'tbl_timekeep_temp';
        // var_dump($_POST['time-keep']);
        $data = trim($_POST['time-keep'], "[\]");
        $data = str_replace('},{', '},,{', $data);
        // echo $data;
        $data = explode(',,', $data);
        // var_dump($data);
        // echo $data[0];
        // echo json_decode($data[0])->fullName;
        $array = [];
        $data_salary = [];
        foreach ($data as $key => $value) {
            $val = json_decode($value);

            $arr = [
                // 'ID' => $val->ID,
                'id_timeKeeping' => $val->id_timeKeeping,
                'id_staff' => $val->id_staff,
                'fullName' => $val->fullName,
                'position' => $val->position,
                'department' => $val->department,
                // 'leaveDay' => $val->leaveDay,
                'absent' => $val->absent,
                'holiday' => $val->holiday,
                'mission' => $val->mission,
                'workDay' => $val->workDay,
                'overtime' => $val->overtime,
                'early' => $val->early,
                'late' => $val->late,
                'setKPI' => '',
                'achieveKPI' => '',
                'classification' => '',
                'setSales' => '',
                'achieveSales' => '',
                'missingSales' => '',
                'exceedSales' => '',
            ];
            array_push($array, $arr);
            // $temp_data = [
            //     'id_staff' => $val->id_staff,
            //     'workDay' => $val->workDay,
            //     'overtime' => $val->overtime,
            // ];
            // array_push($data_salary, $temp_data);
        }
        // var_dump($array);
        $result =  $timeKeepingModel->insertDataTK($table_name, $array);
        echo json_encode($result);
        // var_dump($data_salary);
        // $table_name = "tbl_salary";
        // $timeKeepingModel->insertDataSalary($table_name, $data_salary);
        $set = "sa.workDay = tk.workDay, sa.overtime = tk.overtime ";
        $timeKeepingModel->updateDataSalary($set);

        $salary = $this->load->controller('salary');
        $salary->all();
        // if (($_POST['test'])) {
        //     echo 'arr';
        // }

        // echo json_decode($_POST['test'][0]);
        // $data = json_decode($_POST['test'][0]);
        // echo $data;

    }
    public function classification($classification)
    {
        switch ($classification) {
            case 'A':
                return 0.3;
                break;
            case 'B':
                return 0.15;
                break;
            case 'C':
                return 0.1;
                break;
            case 'D':
                return 0.5;
                break;
            default:
                return 0;
                break;
        }
    }
    public function convertClassification($classification)
    {
        switch ($classification) {
            case 0.3:
                return 'A';
                break;
            case 0.15:
                return 'B';
                break;
            case 0.1:
                return 'C';
                break;
            case 0.5:
                return 'D';
                break;
            default:
                return 0;
                break;
        }
    }
    public function insertDataKPI()
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $table_name = 'tbl_timekeep_temp';
        // var_dump($_POST['test']);
        $data = trim($_POST['time-keep'], "[\]");
        $data = str_replace('},{', '},,{', $data);
        // echo $data;
        $data = explode(',,', $data);
        // var_dump($data);
        // echo $data[0];
        // echo json_decode($data[0])->fullName;
        $array = [];
        foreach ($data as $key => $value) {
            $val = json_decode($value);
            // $cond = "tbl_timekeep_temp.id_staff = \"$val->id_staff\"";
            $arr = [
                // 'ID' => $val->ID,
                // 'id_timeKeeping' => $val->id_timeKeeping,
                'id_staff' => $val->id_staff,
                // 'fullName' => $val->fullName,
                'setKPI' => $val->setKPI,
                'achieveKPI' => $val->achieveKPI,
                'classification' => $this->classification($val->classification),

            ];
            array_push($array, $arr);
        }
        // var_dump($array);
        $result =  $timeKeepingModel->insertDataTKKPI($table_name, $array);
        $set = "sa.setKPI = tk.setKPI, sa.achieveKPI = tk.achieveKPI, sa.classification = tk.classification ";
        $timeKeepingModel->updateDataSalary($set);
        $salary = $this->load->controller('salary');
        $salary->all();
        // if (($_POST['test'])) {
        //     echo 'arr';
        // }

        // echo json_decode($_POST['test'][0]);
        // $data = json_decode($_POST['test'][0]);
        // echo $data;
    }
    public function insertDataSale()
    {
        $timeKeepingModel = $this->load->model('time_keepingmodel');
        $table_name = 'tbl_timekeep_temp';
        // var_dump($_POST['test']);
        $data = trim($_POST['time-keep'], "[\]");
        $data = str_replace('},{', '},,{', $data);
        // echo $data;
        $data = explode(',,', $data);
        // var_dump($data);
        // echo $data[0];
        // echo json_decode($data[0])->fullName;
        $array = [];
        $cond = '';
        foreach ($data as $key => $value) {
            $val = json_decode($value);
            // $cond = "tbl_timekeep_temp.id_staff = \"$val->id_staff\"";
            $arr = [
                // 'ID' => $val->ID,
                // 'id_timeKeeping' => $val->id_timeKeeping,
                'id_staff' => $val->id_staff,
                // 'fullName' => $val->fullName,
                'setSales' => $val->setSales,
                'achieveSales' => $val->achieveSales,
                'missingSales' => $val->missingSales,
                'exceedSales' => $val->exceedSales
            ];
            array_push($array, $arr);
        }
        // var_dump($array);
        $result =  $timeKeepingModel->insertDataTKSale($table_name, $array);
        $set = "sa.achieveSale = tk.achieveSales";
        $timeKeepingModel->updateDataSalary($set);
        $salary = $this->load->controller('salary');
        $salary->all();
        // if (($_POST['test'])) {
        //     echo 'arr';
        // }

        // echo json_decode($_POST['test'][0]);
        // $data = json_decode($_POST['test'][0]);
        // echo $data;

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
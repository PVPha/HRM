<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: *");
error_reporting(0);
require "../HRM-BE/vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class interview extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }

    // public function getData()
    // {
    //     $recruitmentModel = $this->load->model('recruitmentmodel');
    //     $data = $recruitmentModel->getData();
    //     $data = json_encode($data);
    //     echo $data;
    // }

    // public function getDataById($id)
    // {
    //     $recruitmentModel =  $this->load->model('recruitmentModel');
    //     $table_name = 'tbl_recruitment';
    //     $cond = "tbl_recruitment.ID='$id'";
    //     $data = $recruitmentModel->getDataById($table_name, $cond);
    //     echo json_encode($data);
    // }

    public function insertDataSchedule()
    {

        $interviewModel = $this->load->model('interviewmodel');
        $table_name = 'tbl_interview';


        $data = json_decode($_POST['schedule']);

        $id = $data->ID;
        $id_candidate = $data->id_candidate;
        $fullName = $data->fullName;
        $time = $data->time;
        $time = explode("-", $time);

        $location = $data->location;
        $form = $data->form;
        $noteSchedule = $data->noteSchedule;
        $interviewer = $data->interviewer;
        $email = $data->email;
        $position = $data->position;
        $interviewers = '';
        for ($i = 0; $i < 3; $i++) {
            $interviewers .= $interviewer[$i] . ',';
        };
        $interviewers = rtrim($interviewers, ',');
        $content = "
        Chào bạn: $fullName. <br/>
        
        Thay mặt Công ty Cổ phần Phần mềm ISSI, Chúng tôi trân trọng và cảm ơn bạn đã quan tâm đến công việc và vị trí ứng tuyển tại công ty chúng tôi. <br/>
        
        Công ty gửi bạn Lịch phỏng vấn như sau: <br/>
        
        Vị trí: $position. <br/>
        
        Thời gian:15H Ngày $time[2] tháng $time[1] năm $time[0].<br/>
        Hình thức phỏng vấn: $form.<br/>
        Địa điểm: $location.<br/>
        Ghi chú: $noteSchedule.<br/>
        ";
        // $expertise = $data->expertise;
        // $evaluate = $data->evaluate;
        // $noteInterview = $data->noteInterview;
        // $approval = $data->approval;

        //send mail 

        $mail = new PHPMailer(true);

        try {

            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'phadzx32@gmail.com';                     //SMTP username
            $mail->Password   = 'PHAprocf1';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('phadzx32@gmail.com', 'Mailer');
            //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress($email);               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Hen Phong Van';

            $mail->Body    = $content;
            //$mail->AltBody = 
            // $noidungthu = "<b>Chào bạn!</b><br>Chúc an lành!";
            // $mail->Body = $noidungthu;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


        $data = array(
            'ID' => '',
            'id_candidate' => $id_candidate,
            'fullName' => $fullName,
            'time' => $time,
            'location' => $location,
            'form' => $form,
            'noteSchedule' => $noteSchedule,
            // 'interviewer' => $interviewers
            // 'expertise' => $expertise,
            // 'evaluate' => $evaluate,
            // 'noteInterview' => $noteInterview,
            // 'approval' => $approval
        );
        $result = $interviewModel->insertDataSchedule($table_name, $data);

        $table_name = 'tbl_candidate';
        $cond = "tbl_candidate.ID=$id";
        $data2 = array('status' => 'phỏng vấn');
        $result =  $interviewModel->updateDataCandidate($table_name, $data2, $cond);
        echo json_encode($result);
        // var_dump($data);
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
        $cond = "tbl_interview.id_candidate= '$id_candidate'";
        $data = array(
            // 'id_candidate' => $id_candidate,
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
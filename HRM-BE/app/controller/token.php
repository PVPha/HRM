<?php
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Methods: POST, PUT, DELETE, UPDATE");
header("Access-Control-Allow-Origin: * ");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
error_reporting(0);
require "../HRM-BE/vendor/autoload.php";

use \Firebase\JWT\JWT;

class token extends Dcontroller
{
    public function __construct()
    {
        // echo 'tesst call class from index controller';
        parent::__construct();
    }

    public function signIn()
    {
        $tokenModel = $this->load->model('tokenmodel');
        $table_name = 'tbl_user';
        $data = json_decode($_POST['login']);
        $userName = $data->userName;
        $passWord = $data->passWord;
        $cond = "userName = '$userName' AND passWord = '$passWord'";
        $dataUser =  $tokenModel->getData($table_name, $cond);
        // print_r($dataUser[0]);
        $id_user = $dataUser[0]['id_user'];
        $f_name = $dataUser[0]['fullName'];
        $u_name = $dataUser[0]['userName'];
        $pass = $dataUser[0]['password'];
        $role = $dataUser[0]['role'];
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        if (password_verify($passWord, $hash)) {
            $secret_key = "Ph4dzx32";
            $issuer_claim = "localhost";
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time(); // time issued 
            $notbefore_claim = $issuedat_claim + 10;
            $expire_claim = $issuedat_claim + 60;

            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $id_user,
                    "fullName" => $f_name,
                    "role" => $role
                )
            );
            $jwtValue = JWT::encode($token, $secret_key);
            echo json_encode(
                array(
                    "message" => "success",
                    "token" => $jwtValue,
                    "expiry" => $expire_claim
                )
            );
        } else {
            echo json_encode('error');
        };
    }
    public function getDataChart()
    {
        $tokenModel = $this->load->model('tokenmodel');
        //staff
        $cond = "status = 'chính thức'";
        $CT = $tokenModel->getDataChart('tbl_staff', 'id_staff', $cond);
        $cond = "status = 'thử việc'";
        $TV = $tokenModel->getDataChart('tbl_staff', 'id_staff', $cond);
        $cond = "status = 'thôi việc'";
        $NV = $tokenModel->getDataChart('tbl_staff', 'id_staff', $cond);
        //candidate
        $cond = "status IN ('tuyển dụng', 'duyệt')";
        $TD = $tokenModel->getDataChart('tbl_candidate', 'id_candidate', $cond);
        $cond = "status = 'từ chối'";
        $TC = $tokenModel->getDataChart('tbl_candidate', 'id_candidate', $cond);
        $cond = "status IN ('chờ', 'phỏng vấn')";
        $CH = $tokenModel->getDataChart('tbl_candidate', 'id_candidate', $cond);
        $cond = "status = 'phỏng vấn'";
        $PV = $tokenModel->getDataChart('tbl_candidate', 'id_candidate', $cond);
        $DPV = round((($TD[0][0] + $TC[0][0]) * 100) / ($TD[0][0] + $TC[0][0] + $CH[0][0]));

        //salary
        $LCT = $tokenModel->getDataSalary('chính thức');
        $LTV = $tokenModel->getDataSalary('thử việc');

        $data = [
            'CT' => $CT,
            'TV' => $TV,
            'NV' => $NV,
            'TD' => $TD,
            'TC' => $TC,
            'CH' => $CH,
            'LCT' => $LCT,
            'LTV' => $LTV,
            'PV' => $PV,
            'DPV' => $DPV
        ];
        echo json_encode($data);
    }

    function changePass()
    {
        $data = json_decode($_POST['change']);
        $id_user = $data->id_user;
        $oldPass = $data->passWord;
        $newPass = $data->newPassWord;
        $tokenModel = $this->load->model('tokenmodel');
        $cond = "id_user = '$id_user'";
        $user = $tokenModel->getData('tbl_user', $cond);

        if ($user[0]['password'] === $oldPass) {
            $data = [
                'password' => $newPass
            ];
            $tokenModel->updateData('tbl_user', $data, $cond);
            echo json_encode('mật khẩu đã đổi');
        } else {
            echo json_encode('mật khẩu không đúng');
        }
    }
}
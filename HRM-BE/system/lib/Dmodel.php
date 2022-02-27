<?php
class Dmodel
{
    protected $db = array();
    public function __construct()
    {
        $connect = 'mysql:dbname=test; host=localhost; charset=utf8';
        $connect = 'mysql:dbname=hrm; host=localhost; charset=utf8';
        $user = 'root';
        $pass = '';
        $this->db = new Database($connect, $user, $pass);
    }
}
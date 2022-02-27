<?php
class Dcontroller
{
    protected $load = array();
    public function __construct()
    {
        $this->load = new load();
        // echo 'this is root <br>';
    }
    // public function test1()
    // {
    //     echo 'test call function';
    // }
}
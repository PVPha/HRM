<?php
class load
{
    public function __construct()
    {
    }

    public function view($filename, $data = null)
    {
        include 'app/view/' . $filename . '.php';
    }
    public function controller($filename)
    {
        include 'app/controller/' . $filename . '.php';
        return new $filename;
    }
    public function model($filename)
    {
        include 'app/model/' . $filename . '.php';
        return new $filename;
    }
}
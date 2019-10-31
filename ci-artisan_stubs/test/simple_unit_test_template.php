<?php
defined('BASEPATH') or exit('No direct script access allowed');

class {$test_name} extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('unit_test');
    }

    public function exampletest()
    {
        $test = 1 + 1;
        $expected_result = 2;
        $test_name = 'Adds one plus one';
        echo $this->unit->run($test, $expected_result, $test_name);
    }
}

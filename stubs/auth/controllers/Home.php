<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->database();
        $this->load->library('ion_auth');

        // if user is not logged in then redirect to login
        if (! $this->ion_auth->logged_in()) {
            return redirect('auth/login');
        }
    }

    public function index()
    {
        $user = $this->ion_auth->user()->row();
        return $this->load->view('home', array('user' => $user));
    }
}

<?php
class Auth extends CI_Controller
{
    private $redirectTo = 'home';

    public function __construct()
    {
        parent::__construct();

        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->database();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper(['form', 'url']);
    }

    public function login()
    {
        // if user is logged in then redirect to $redirectTo
        if ($this->ion_auth->logged_in()) {
            return redirect($this->redirectTo);
        }

        if ($this->input->method() == 'get') {
            return $this->load->view('auth/login');
        }

        // Validations rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        
        if ($this->form_validation->run() == false) {
            return $this->load->view('auth/login');
        }

        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = (bool) $this->input->post('remember');

        if ($this->ion_auth->login($email, $password, $remember)) {
            return redirect($this->redirectTo);
        } else {
            $this->ion_auth->set_error_delimiters('<div class="alert alert-danger my-2" role="alert">','</div>');
            $errors = $this->ion_auth->errors();
            $this->session->set_flashdata('login_status', $errors);
            return $this->load->view('auth/login');
        }
    }

    public function register()
    {
        // if user is logged in then redirect to $redirectTo
        if ($this->ion_auth->logged_in()) {
            return redirect($this->redirectTo);
        }

        if ($this->input->method() == 'get') {
            return $this->load->view('auth/register');
        }

        // Validations rules
        $this->form_validation->set_rules('first_name', 'First Name', 'required|alpha_numeric_spaces');
        $this->form_validation->set_rules('last_name', 'Last Name', 'alpha_numeric_spaces');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        
        if ($this->form_validation->run() == false) {
            return $this->load->view('auth/register');
        }

        $first_name = $this->input->post('first_name');
        $last_name = $this->input->post('last_name');
        $email = $this->input->post('email');
        $password = $this->input->post('confirm_password');
        $group = 1; //admin

        $additional_data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
        );

        if ($this->ion_auth->register($email, $password, $email, $additional_data, $group)) {
            if ($this->ion_auth->login($email, $password, false)) {
                return redirect($this->redirectTo);
            } else {
                return redirect('auth/login');
            }
        } else {
            $this->ion_auth->set_error_delimiters('<div class="alert alert-danger my-2" role="alert">','</div>');
            $errors = $this->ion_auth->errors();
            $this->session->set_flashdata('register_status', $errors);
            return $this->load->view('auth/register');
        }
    }

    public function logout()
    {
        // check if user is logged in then logout
        if ($this->ion_auth->logged_in()) {
            $this->ion_auth->logout();
        }

        return redirect('auth/login');
    }
}

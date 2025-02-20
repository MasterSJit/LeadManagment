<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{

    /**
     * Summary of __construct
     * Load the required models and libraries
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        // $this->load->library('form_validation');
        date_default_timezone_set("Asia/Kolkata");
    }

    /**
     * Summary of login
     * @return void
     * Load the login view and validate the form
     */
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->load->view('_layouts/header', ['title' => 'Login']);
            $this->load->view('auth/login');
            $this->load->view('_layouts/footer');
        }
        else
        {
            
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            
            $user = $this->user_model->get_user_by_email($email);

            $pwd = base64_encode($password);
            $log_id = $this->logs->save_log(null, 'User submited the Login form', 'Pending', "User perfom a login action with email : '{$email}' and password : '{$pwd}'");

            if ($user && password_verify($password, $user->password))
            {
                $this->logs->update_userid($user->id, $log_id);
                $this->logs->save_log($user->id, 'Successful Login', 'Success', "The user with email : '{$email}' has successfully logged in");

                $this->session->set_userdata('user_id', $user->id);
                $this->session->set_userdata('user_role', $user->user_role);
                $this->session->set_userdata('email', $user->email);
                redirect('lead');
            }
            else
            {
                $this->logs->save_log($user->id, 'Failed Login', 'Failed', "The user with email : '{$email}' has supplied wrong Credential hense login failed");
                $this->session->set_flashdata('error', 'Invalid email or password');
                redirect('auth/login');
            }
        }
    }
    
    /**
     * Summary of logout
     * @return never
     * Destroy the session and redirect to login page
     */
    public function logout()
    {
        $this->logs->save_log($this->session->userdata('user_id'), 'Successful Logout', 'Success', "The user with email : '{$_SESSION['email']}' has successfully logged in");
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_role');
        redirect('auth/login');
    }
}
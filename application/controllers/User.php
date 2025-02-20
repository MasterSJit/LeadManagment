<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
    /**
     * Summary of __construct
     * Load the required models and libraries
     * Check if the user is logged in
     */
    public function __construct()
    {
        parent::__construct();
        if(!isset($_SESSION['user_id']))
        {
            redirect(base_url('auth/login'));
        }
        else
        {
            if($_SESSION['user_role'] != 'admin')
            {
                redirect(base_url('dashboard'));
            }
        }
        $this->load->model('user_model');
        $this->load->library('pagination');
    }

    /**
     * Summary of index
     * @return void
     * Display the list of users
     */
    public function index()
    {
        $config['total_rows'] = $this->user_model->count_users();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['users'] = $this->user_model->get_users($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('_layouts/header', ['title' => 'Lead Lists']);
        $this->load->view('user/user', $data);
        $this->load->view('_layouts/footer');

    }

    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     * Display the edit form
     */
    public function edit($id)
    {
        $this->load->model('lead_model');
        $data['user'] = $this->user_model->get_user($id);

        $data['leads'] = $this->lead_model->get_leads();

        $this->load->view('_layouts/header', ['title' => 'Edit user']);
        $this->load->view('user/edit', $data);
        $this->load->view('_layouts/footer');
    }

    /**
     * Summary of update
     * @param mixed $id
     * @return never
     * Validate the form and Update the user
     */
    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[leads.email]');
        $this->form_validation->set_rules('password', 'Password');
        $this->form_validation->set_rules('assigned_leads', 'Assigned Leads');

        if ($this->form_validation->run() === FALSE)
        {
            $this->logs->save_log($_SESSION['user_id'], 'Edit User', 'Failed', "The user with email : '{$_SESSION['email']}' has failed to edit a User. The user id is : '{$id}'");

            redirect('user/edit/' . $id);
    
        }
        else
        {
            // exit(var_dump($this->input->post('assigned_leads') ));
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => !empty($this->input->post('password')) ? password_hash($this->input->post('password'), PASSWORD_BCRYPT) : $this->input->post('old_password'),
                'assigned_leads' => implode(',', $this->input->post('assigned_leads')),
            );
            $this->logs->save_log($_SESSION['user_id'], 'Edited user', 'Success', "The user with email : '{$_SESSION['email']}' has edited a user. The user id is : '{$id}'");
            
            $this->user_model->update_user($id, $data);
            redirect('user');
        }
    }

}
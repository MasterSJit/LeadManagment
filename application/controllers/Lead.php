<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead extends CI_Controller
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
        $this->load->model('lead_model');
        $this->load->library('form_validation');
        $this->load->library('pagination');
    }

    /**
     * Summary of index
     * @return void
     * Load the leads and display them in the view
     */
    public function index()
    {
        $this->load->model('user_model');
        $config['base_url'] = base_url('lead/index');
        $config['total_rows'] = $this->lead_model->count_leads();
        $config['per_page'] = 9;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $user = $this->user_model->get_user($_SESSION['user_id']);
        $data['leads'] = $this->lead_model->get_leads(explode(',', $user->assigned_leads), $config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('_layouts/header', ['title' => 'Lead Lists']);
        $this->load->view('lead/index', $data);
        $this->load->view('_layouts/footer');

    }

    /**
     * Summary of new
     * @return void
     * Load the view to create a new lead
     */
    public function new()
    {
        $this->load->view('_layouts/header', ['title' => 'Create Lead']);
        $this->load->view('lead/create');
        $this->load->view('_layouts/footer');
    }

    /**
     * Summary of create
     * @return never
     * Create a new lead and validate the input
     */
    public function create()
    {
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[leads.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        
        if ($this->form_validation->run() === FALSE)
        {
            $this->logs->save_log($_SESSION['user_id'], 'Created New Lead', 'Failed', "The user with email : '{$_SESSION['email']}' has failed to crate a new lead.");
            redirect('lead');            
        }
        else
        {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'status' => $this->input->post('status'),
                'date_added' => date('Y-m-d H:i:s')
            );
            
            $lead_id = $this->lead_model->create_lead($data);
            $this->logs->save_log($_SESSION['user_id'], 'Created New Lead', 'Success', "The user with email : '{$_SESSION['email']}' has created a new lead. The lead id is : '{$lead_id}'");
            redirect('lead');
        }
    }

    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     * Load the view to edit a lead
     */
    public function edit($id)
    {
        $data['lead'] = $this->lead_model->get_lead($id);
        $this->load->view('_layouts/header', ['title' => 'Edit Lead']);
        $this->load->view('lead/edit', $data);
        $this->load->view('_layouts/footer');
    }

    /**
     * Summary of update
     * @param mixed $id
     * @return never
     * Update the lead and validate the input
     */
    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE)
        {
            $this->logs->save_log($_SESSION['user_id'], 'Edit Lead', 'Failed', "The user with email : '{$_SESSION['email']}' has failed to edit a lead. The lead id is : '{$id}'");

            $data['lead'] = $this->lead_model->get_lead($id);
            redirect('lead/edit/' . $id);
    
        }
        else
        {
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'status' => $this->input->post('status'),
                'last_updated' => date('Y-m-d H:i:s')
            );
            $this->logs->save_log($_SESSION['user_id'], 'Edited Lead', 'Success', "The user with email : '{$_SESSION['email']}' has edited a lead. The lead id is : '{$id}'");
            
            $this->lead_model->update_lead($id, $data);
            redirect('lead');
        }
    }
    
    /**
     * Summary of delete
     * @param mixed $id
     * @return never
     * Delete the lead
     */
    public function delete($id)
    {
        $this->logs->save_log($_SESSION['user_id'], 'Deleted Lead', 'Success', "The user with email : '{$_SESSION['email']}' has deleted a lead. The lead id is : '{$id}'");
        $this->lead_model->delete_lead($id);
        redirect('lead');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssignLead extends CI_Controller
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
    }

    /**
     * Summary of index
     * @return void
     * Display the list of leads
     */
    public function index()
    {
        $config['base_url'] = base_url('lead/index');
        $config['total_rows'] = $this->lead_model->count_leads();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['leads'] = $this->lead_model->get_leads(NULL, $config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();

        $this->load->view('_layouts/header', ['title' => 'Lead Lists']);
        $this->load->view('lead/index', $data);
        $this->load->view('_layouts/footer');

    }
}
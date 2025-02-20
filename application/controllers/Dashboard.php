<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
     * Load all leads at a glance
     */
    public function index()
    {
        $data['total_leads'] = $this->lead_model->count_leads();
        $data['new_leads'] = count($this->lead_model->get_leads_by_status('New'));
        $data['in_progress_leads'] = count($this->lead_model->get_leads_by_status('In Progress'));
        $data['closed_leads'] = count($this->lead_model->get_leads_by_status('Closed'));

        $this->load->view('_layouts/header', ['title' => 'Dashboard']);
        $this->load->view('dashboard/index', $data);
        $this->load->view('_layouts/footer');

    }
}
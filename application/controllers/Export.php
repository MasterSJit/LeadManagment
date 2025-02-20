<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
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
     * Load the export request and create file
     */
    public function index()
    {
        $this->load->view('_layouts/header', ['title' => 'Export Leads']);
        $this->load->view('export/index');
        $this->load->view('_layouts/footer');

    }

    /**
     * Summary of process
     * @return void
     * Process the export request
     */
    public function process()
    {
        // $this->logs->update_userid($user->id, $log_id);
        $this->logs->save_log($_SESSION['user_id'], 'Exporting InProgress', 'Pending', "The user with email : '{$_SESSION['email']}' has started exporting leads");

        $status = $this->input->post('status');

        if ($status)
        {
            $leads = $this->lead_model->get_leads_by_status($status);
        }
        else
        {
            $leads = $this->lead_model->get_leads(NULL, 1000, 0); // Limit to 1000 leads for this example
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Email');
        $sheet->setCellValue('C1', 'Phone');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Date Added');

        $row = 2;
        foreach ($leads as $lead)
        {
            $sheet->setCellValue('A' . $row, $lead->name);
            $sheet->setCellValue('B' . $row, $lead->email);
            $sheet->setCellValue('C' . $row, $lead->phone);
            $sheet->setCellValue('D' . $row, $lead->status);
            $sheet->setCellValue('E' . $row, $lead->date_added);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'leads_export_' . date('Y-m-d_H-i-s') . '.xlsx';
        $this->logs->save_log($_SESSION['user_id'], 'Export Finished', 'Success', "The user with email : '{$_SESSION['email']}' has downloaded the exported leads");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
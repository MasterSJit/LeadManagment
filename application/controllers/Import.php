<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;


class Import extends CI_Controller
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
     * Load the import view
     */
    public function index()
    {
        $this->load->view('_layouts/header', ['title' => 'Import Leads']);
        $this->load->view('import/index');
        $this->load->view('_layouts/footer');

    }

    /**
     * Summary of process
     * @return never
     * Process the uploaded file and import the leads
     */
    public function process()
    {
        $this->logs->save_log($_SESSION['user_id'], 'Importing InProgress', 'Pending', "The user with email : '{$_SESSION['email']}' has started importing leads");

        if ($_FILES['excel_file']['name'])
        {
            $file_name = $_FILES['excel_file']['name'];
            $array = explode(".", $file_name);
            $extension = end($array);

            if ($extension == 'xlsx' || $extension == 'xls')
            {
                $file_tmp = $_FILES['excel_file']['tmp_name'];
                $spreadsheet = IOFactory::load($file_tmp);
                $sheet = $spreadsheet->getActiveSheet();
                $highestRow = $sheet->getHighestRow();

                $success_count = 0;
                $fail_count = 0;

                for ($row = 2; $row <= $highestRow; $row++)
                {
                    $name = $sheet->getCell([1, $row])->getValue();
                    $email = $sheet->getCell([2, $row])->getValue();
                    $phone = $sheet->getCell([3, $row])->getValue();
                    $status = $sheet->getCell([4, $row])->getValue();

                    if ($name && $email && $phone && $status)
                    {
                        $data = [
                            'name' => $name,
                            'email' => $email,
                            'phone' => $phone,
                            'status' => $status,
                            'date_added' => date('Y-m-d H:i:s')
                        ];

                        if ($this->lead_model->create_lead($data))
                        {
                            $success_count++;
                        }
                        else
                        {
                            $fail_count++;
                        }
                    }
                    else
                    {
                        $fail_count++;
                    }
                }

                $this->logs->save_log($_SESSION['user_id'], 'Import Finished', 'Success', "The user with email : '{$_SESSION['email']}' has successfully imported {$success_count} leads and Failed to import {$fail_count} leads");

                $this->session->set_flashdata('message', "Successfully imported {$success_count} leads. Failed to import {$fail_count} leads.");
            }
            else
            {
                $this->logs->save_log($_SESSION['user_id'], 'Import Error', 'Failed', "The user with email : '{$_SESSION['email']}' has supplied Invalid file format for import");
                
                $this->session->set_flashdata('error', 'Invalid file format. Please upload an Excel file.');
            }
        }
        else
        {
            $this->logs->save_log($_SESSION['user_id'], 'Import Error', 'Failed', "The user with email : '{$_SESSION['email']}' hasn't supplied any file");
            $this->session->set_flashdata('error', 'No file selected.');
        }

        redirect('import');
    }
}
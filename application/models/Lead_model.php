<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lead_model extends CI_Model
{

    /**
     * Summary of __construct
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }

    /**
     * Summary of get_leads
     * @param mixed $leads
     * @param mixed $limit
     * @param mixed $offset
     * @return mixed
     * Get all leads
     */
    public function get_leads( $leads = NULL, $limit = NULL, $offset = NULL)
    {
        if(!is_null($limit) && !is_null($offset))
        {
            $this->db->limit($limit, $offset);
        }
        if($_SESSION['user_role'] != 'admin' && $leads != NULL)
        {
            $this->db->where_in('id', $leads);
        }
        return $this->db->get('leads')->result();
    }

    /**
     * Summary of get_lead
     * @param mixed $id
     * @return mixed
     * Get a single lead by id
     */
    public function get_lead($id)
    {
        return $this->db->get_where('leads', array('id' => $id))->row();
    }

    /**
     * Summary of create_lead
     * @param mixed $data
     * @return mixed
     * Create a new lead
     */
    public function create_lead($data)
    {
        $this->db->insert('leads', $data);
        return $this->db->insert_id();
    }

    /**
     * Summary of update_lead
     * @param mixed $id
     * @param mixed $data
     * @return mixed
     * Update a lead
     */
    public function update_lead($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('leads', $data);
    }

    /**
     * Summary of delete_lead
     * @param mixed $id
     * @return mixed
     * Delete a lead
     */
    public function delete_lead($id)
    {
        return $this->db->delete('leads', array('id' => $id));
    }

    /**
     * Summary of count_leads
     * @return mixed
     * Count all leads
     */
    public function count_leads()
    {
        return $this->db->count_all('leads');
    }

    /**
     * Summary of get_leads_by_status
     * @param mixed $status
     * @return mixed
     * Get leads by status
     */
    public function get_leads_by_status($status)
    {
        return $this->db->get_where('leads', array('status' => $status))->result();
    }
}
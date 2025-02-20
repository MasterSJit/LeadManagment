<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User_model extends CI_Model
{
    private $table_name = 'leads';
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        // if (!$this->db->table_exists($this->table_name))
        //     {
        //         $query = " CREATE TABLE $this->table_name 
        //                                 (
        //                                     id INT NOT NULL AUTO_INCREMENT COMMENT 'Lead ID' , 
        //                                     name VARCHAR(255) COMMENT 'Lead Name' , 
        //                                     email VARCHAR(50) UNIQUE COMMENT 'Lead Email Address' , 
        //                                     phone VARCHAR(15) COMMENT 'Lead Phone Number' , 
        //                                     status ENUM('New', 'In Progress', 'Closed') DEFAULT NULL COMMENT 'Lead status' , 
        //                                     date_added DATETIME COMMENT 'Lead created time' , 
        //                                     updated_at DATETIME NULL COMMENT 'Lead last updated time' , 
        //                                     PRIMARY KEY (id)
        //                                 ) ENGINE = InnoDB;";
        //         $this->db->query($query);
        //     }
    }

    /**
     * Summary of get_user_by_email
     * @param mixed $email
     * @return mixed
     * Get the user by email address
     */
    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', array('email' => $email))->row();
    }

    /**
     * Summary of create_user
     * @param mixed $data
     * @return mixed
     * Create a new user
     */
    public function create_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    /**
     * Summary of update_user
     * @param mixed $id
     * @param mixed $data
     * @return mixed
     * Update the user
     */
    public function update_user($id, $data)
    {
        $this->db->update('users', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    /**
     * Summary of delete_user
     * @param mixed $id
     * @return mixed
     * Delete the user
     */
    public function delete_user($id)
    {
        $this->db->delete('users', ['id' => $id]);
        return $this->db->affected_rows();
    }

    /**
     * Summary of getAllUsers
     * @return mixed
     * Get all users
     */
    public function getAllUsers()
    {
        return $this->db->get('users')->result();
    }

    /**
     * Summary of count_users
     * @return mixed
     * Count the number of users
     */
    public function count_users()
    {
        return $this->db->count_all('users');
    }

    /**
     * Summary of get_users
     * @param mixed $limit
     * @param mixed $offset
     * @return mixed
     * Get the users list
     */
    public function get_users($limit, $offset)
    {
        return $this->db->get('users', $limit, $offset)->result();
    }

    /**
     * Summary of get_user
     * @param mixed $id
     * @return mixed
     * Get the user by id
     */
    public function get_user($id)
    {
        return $this->db->get_where('users', array('id' => $id))->row();
    }

}
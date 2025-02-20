<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Log_model extends CI_Model
{
    /**
     * Summary of __construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Summary of save_log
     * @param mixed $user_id
     * @param mixed $msg
     * @param mixed $type
     * @param mixed $operation
     * @return mixed
     * Save the Log to database
     */
    public function save_log($user_id, $msg, $type, $operation)
    {
        $data = $this->logs_builder($user_id, $msg, $type, $operation);

        $this->db->insert('operation_logs', $data);
        return $this->db->insert_id();
    }

    /**
     * Summary of logs_builder
     * @param mixed $user_id
     * @param mixed $msg
     * @param mixed $type
     * @param mixed $operation
     * @return array
     * Build the log array
     */
    public function logs_builder($user_id, $msg, $type, $operation)
    {
        $log =
        [
            'msg' => $msg,
            'action' => $type,
            'operation' => $operation,
            'ip_address' => $this->input->ip_address(),
        ];
        return ['user_id' => $user_id, 'log' => json_encode($log)];
    }

    /**
     * Summary of update_userid
     * @param mixed $user_id
     * @param mixed $id
     * @return void
     * Update the user_id of the log
     */
    public function update_userid($user_id, $id)
    {
        $this->db->update('operation_logs', ['user_id' => $user_id], ['id' => $id]);
    }
}
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Parent_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }

    /**
     * Insert Parents Details to parent table
     *
     * @param array $parent_details
     * @return bool
     */
    public function insertParentDetails($parent_details)
    {
        $status = false;
        try {
            $this->db->trans_start(FALSE);
            if (!$this->db->insert('parent', $parent_details)) {
                $error = $this->db->error()["message"];
                throw new Exception('Database error! ' .$error);
            }
            $this->db->trans_complete();
            $status = true;

        } catch (Exception $e) {
            log_message('error: ',$e->getMessage());
        }
        return $status;
    }


}
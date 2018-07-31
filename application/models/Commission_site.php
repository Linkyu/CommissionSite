<?php
/**
 * Created by PhpStorm.
 * User: Linkyu
 * Date: 06/07/2018
 * Time: 14:29
 */

class Commission_site extends CI_Model
{
    public function get_top_three_featured()
    {
        $this->load->database();

        $this->db->order_by("star_count", 'DESC');
        $this->db->limit(3);
        $query = $this->db->get('art');

        return $query->result();
    }

    public function get_recent_art($limit = 3, $offset = 0)
    {
        $this->load->database();

        $this->db->order_by("date", 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get('art');

        return $query->result();
    }

    public function get_art($id)
    {
        $this->load->database();

        $this->db->where("id", $id);
        $query = $this->db->get('art');

        return $query->result();
    }

    public function get_arts_total_amount()
    {
        $this->load->database();

        return $this->db->count_all("art");
    }
}
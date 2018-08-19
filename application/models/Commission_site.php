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

    public function get_recent_art(int $limit = 3, int $offset = 0, array $search_query = null)
    {
        $this->load->database();

        $this->db->order_by("date", 'DESC');
        $this->db->limit($limit, $offset);

        if ($search_query != null) {
            $search_string = $search_query["query"];
            if (isset($search_query["tags"]))
            {
                $tags = implode (",", $search_query["tags"]);
            } else {
                $tags = "";
            }

            $this->db->join('art_tag', 'art_tag.art = art.id', 'left');
            $this->db->where("(title like '%{$search_string}%' or description like '%{$search_string}%')");

            if ($tags != "") {
                $this->db->where("tag in ({$tags})");
            }

            $this->db->group_by('art');
        }

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

    public function get_tags()
    {
        $this->load->database();

        $query = $this->db->query("SELECT tag.id as id, tag.name as tag, tag_category.name as category from tag LEFT JOIN tag_category ON tag_category.id = tag.category ORDER BY tag_category.name");
        $tags = $query->result();
        $dict = array();

        foreach ($tags as $element) {
            if (array_key_exists($element->category, $dict)) {
                array_push($dict[$element->category], array("id" => $element->id, "tag" => $element->tag));
            } else {
                $dict[$element->category] = array(array("id" => $element->id, "tag" => $element->tag));
            }
        }

        return $dict;
    }

    public function get_stats(int $art_id)
    {
        $this->load->database();

//        select stats.name, art_stat.value
//        from art_stat
//        left join art on art.id = art_stat.art
//        left join stats on stats.id = art_stat.stat
//        where art = $art_id
        $this->db->select("stats.name, art_stat.value");
        $this->db->join("art", "art.id = art_stat.art", "left");
        $this->db->join("stats", "stats.id = art_stat.stat", "left");
        $this->db->where("art", $art_id);

        $query = $this->db->get("art_stat");

        return $query->result();
    }
}
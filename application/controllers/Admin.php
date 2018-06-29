<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->view('admin/index');
    }

    public function upload()
    {
        $this->load->view('admin/upload');
    }

    public function edit_art()
    {
        $data["id"] = 135;
        $data["title"] = "title";
        $data["file"] = "file";
        $data["description"] = "description";
        $data["time_spent"] = "time_spent";
        $data["software"] = "software";
        $data["layers"] = "layers";
        $data["is_commission"] = true == true ? 'checked="checked"' : '';
        $data["price"] = "price";
        $this->load->view('admin/edit_art', $data);
    }

    public function edit_terms()
    {
        $data["terms"] = file_get_contents(base_url() . "static/files/terms.md");

        $this->load->view('admin/edit_terms', $data);
    }

    public function edit_contact()
    {
        $data["contact"] = file_get_contents(base_url() . "static/files/about.md");

        $this->load->view('admin/edit_contact', $data);
    }

    public function edit_prices($id = null)
    {
        if ($id == null) {
            $data["edit"] = false;
            $data["prices"] = array(
                "sketch" => 15,
                "lines" => 25,
                "flats" => 35
            );
        } else {
            $data["edit"] = true;
            $data["type"] = "sketch";
            $data["price"] = 15;
        }

        $this->load->view('admin/edit_prices', $data);
    }
}

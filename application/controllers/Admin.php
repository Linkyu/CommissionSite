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
        $this->load->view('welcome_message');
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
}

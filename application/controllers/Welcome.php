<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	public function gallery()
	{
		$this->load->view('gallery');
	}

	public function art($id)
	{
	    if (isset($id)) {
            $data["id"] = $id;
            $this->load->view('art', $data);
        } else {
            show_404();
	        throw new InvalidArgumentException("id argument not found.");
        }
	}

    public function terms()
    {
        $this->load->library('markdown');

        $terms =  file_get_contents(base_url() . "static/files/terms.md");
        $data["terms"] = $this->markdown->parse($terms);

        $this->load->view('terms', $data);
    }
}

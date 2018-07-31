<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
	    $this->load->model('Commission_site', 'data_model');

	    $data['featured'] = $this->data_model->get_top_three_featured();
	    $data['latest'] = $this->data_model->get_recent_art();

		$this->load->view('index', $data);
	}

	public function gallery($page = 0)
	{
        $this->load->model('Commission_site', 'data_model');
        $thumbnails_per_page = 9;

        if($page > 0) {
            $offset = $page * $thumbnails_per_page;
            $data['arts'] = $this->data_model->get_recent_art($thumbnails_per_page, $offset);
        } else {
            $data['arts'] = $this->data_model->get_recent_art($thumbnails_per_page);
        }

        $this->load->view('gallery', $data);
	}

	public function art($id)
	{
	    if (isset($id)) {

            $this->load->model('Commission_site', 'data_model');
            $query = $this->data_model->get_art($id);
            $data['art'] = reset($query);

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

    public function commission_details()
    {
        $this->load->library('markdown');

        $com_details =  file_get_contents(base_url() . "static/files/com_details.md");
        $data["com_details"] = $this->markdown->parse($com_details);

        $this->load->view('commission_details', $data);
    }

    public function commission_form()
    {
        $this->load->view('commission_form');
    }

    public function about()
    {
        $this->load->library('markdown');

        $about =  file_get_contents(base_url() . "static/files/about.md");
        $data["about"] = $this->markdown->parse($about);

        $this->load->view('about', $data);
    }

    public function contact()
    {
        $this->load->view('contact');
    }
}

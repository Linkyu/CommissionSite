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
	    $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->model('Commission_site', 'data_model');
        $thumbnails_per_page = 9;

        // Get the thumbnails
        if($page > 0) {
            $offset = ($page - 1) * $thumbnails_per_page;
            $data['arts'] = $this->data_model->get_recent_art($thumbnails_per_page, $offset);
            $data["current_page"] = $page;
        } else {
            $data['arts'] = $this->data_model->get_recent_art($thumbnails_per_page);
            $data["current_page"] = 1;
        }

        // Get the tags
        $data['tag_categories'] = $this->data_model->get_tags();
//        array (
//          'tag category' =>
//            array (
//                0 => array (
//                  'id' => string '4'
//                  'tag' => string 'furries')
//                1 => array (
//                  'id' => string '6'
//                  'tag' => string 'guns')
//                N => ... ),
//          'more categories' => ... )

        $arts_total = $this->data_model->get_arts_total_amount();
        $data["amount_of_pages"] = ceil($arts_total / $thumbnails_per_page);

        $data['path'] = "gallery";

        $this->load->view('gallery', $data);
	}

	public function search($page = 0)
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('query', 'Query', 'htmlspecialchars|trim');
        $this->form_validation->set_rules('tags', 'Tags', 'htmlspecialchars|trim');

        $this->load->model('Commission_site', 'data_model');

        if ($this->form_validation->run() == FALSE)
        {
            echo "noo";
        }
        else
        {
            $thumbnails_per_page = 9;

            // Get the thumbnails
            if($page > 0) {
                $offset = ($page - 1) * $thumbnails_per_page;
                $data['arts'] = $this->data_model->get_recent_art($thumbnails_per_page, $offset, $this->input->post());
                $data["current_page"] = $page;
            } else {
                $data['arts'] = $this->data_model->get_recent_art($thumbnails_per_page, 0, $this->input->post());
                $data["current_page"] = 1;
            }

            // Get the tags
            $data['tag_categories'] = $this->data_model->get_tags();

            $arts_total = $this->data_model->get_arts_total_amount();
            $data["amount_of_pages"] = ceil($arts_total / $thumbnails_per_page);

            $data['path'] = "search";

            $this->load->view('gallery', $data);
        }
    }

	public function art($id)
	{
	    if (isset($id)) {

            $this->load->model('Commission_site', 'data_model');
            $query = $this->data_model->get_art($id);
            $data['art'] = reset($query);

            $data['stats'] = $this->data_model->get_stats($id);

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
        $this->load->helper('form');

        if ($this->input->method() == "get")
        {
            $this->load->view('contact');
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|required|valid_email');
            $this->form_validation->set_rules('message', 'Message', 'htmlspecialchars|trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('contact', $this->input->post());
            }
            else
            {
                $data["sent_flag"] = true;
                $this->load->view('contact', $data);
            }
        }
    }
}

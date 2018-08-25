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

            $data['ip'] = $this->input->ip_address();

            $this->load->view('art', $data);
        } else {
            show_404();
	        throw new InvalidArgumentException("id argument not found.");
        }
	}

	public function star()
    {
        if ($this->input->method() == "get")
        {
            show_error("Bad method!", 400);
        }
        else
        {
            $this->load->model('Commission_site', 'data_model');

            // ////////////////////////////////
            // TODO: REMOVE THIS IN PRODUCTION
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST');
            header("Access-Control-Allow-Headers: X-Requested-With");
            // ////////////////////////////////

            $ip = htmlspecialchars($this->input->post("ip"));
            $art_id = htmlspecialchars($this->input->post("art_id"));

            if ($this->data_model->has_starred($art_id, $ip)) {
                show_error("Already starred", 403);
            } else {
                $star_result = $this->data_model->star($art_id, $ip);

                if ($star_result == "OK") {
                    echo "Starred!";
                } else {
                    show_error("Uh something went wrong.", 501);
                }
            }
        }
    }

    public function get_star_counter($id)
    {
        $this->load->model('Commission_site', 'data_model');

        // ////////////////////////////////
        // TODO: REMOVE THIS IN PRODUCTION
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST');
        header("Access-Control-Allow-Headers: X-Requested-With");
        // ////////////////////////////////
        echo $this->data_model->get_star_counter($id);
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
        $this->load->helper('form');
        if ($this->input->method() == "get")
        {
            $this->load->view('commission_form');
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('category', 'Category', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('scope', 'Scope', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('name', 'Name', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|required|valid_email');
            $this->form_validation->set_rules('description', 'Description', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('terms_agreed', 'TOS agreement', 'callback_check_tos_agreement');


            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('commission_form', $this->input->post());
            }
            else if($this->input->post("terms_agreed") == FALSE)
            {
                $this->load->view('commission_form', $this->input->post());
            }
            else
            {
                $this->send_commission_email($this->input->post());
                $data["sent_flag"] = true;
                $this->load->view('commission_form', $data);
            }
        }
    }

    function check_tos_agreement($is_checked)
    {
	    if ($is_checked == 'on') {
	        return true;
        }

        $this->form_validation->set_message('check_tos_agreement', 'Please read and accept the terms and conditions.');
        return false;
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
                $this->send_contact_email($this->input->post());
                $data["sent_flag"] = true;
                $this->load->view('contact', $data);
            }
        }
    }

    private function send_contact_email($data)
    {
        $this->load->library('email');

        $this->email->from($data["email"], $data["name"]);
        $this->email->to('linkyu.work@gmail.com');

        $this->email->subject('Contact email from linkyu.art');
        $this->email->message($data["message"]);

        $this->email->send();
    }

    private function send_commission_email($data)
    {
        $this->load->library('email');

        $this->email->from($data["email"], $data["name"]);
        $this->email->to('linkyu.work@gmail.com');

        $this->email->subject('Commission request from ' . $data["name"]);
        $this->email->message(
            "Category: " . $data["category"] .
            "\nScope: " . $data["scope"] .
            "\n\nDescription: \n" . $data["description"]);

        $this->email->send();
    }
}

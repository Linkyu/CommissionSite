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

    public function login() {
        $this->load->library('session');
        $this->load->model('Commission_site', 'data_model');
        $this->load->helper('form');

        if ($this->input->method() == "get")
        {
            if ($this->session->userdata("hash") != NULL)  // if the session hash exists
            {
                $session_hash = $this->session->hash;
                $hash = $this->data_model->get_admin_hash();

                if (password_verify($session_hash, $hash))
                {
                    $this->index();
                }
                else
                {
                    $this->load->view('admin/login');
                }
            }
            else
            {
                $this->load->view('admin/login');
            }
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->load->view('admin/login');
            }
            else
            {
                $this->load->model('Commission_site', 'data_model');

                $data = $this->input->post();
                $hash = $this->data_model->get_admin_hash();
                if (password_verify($data["password"], $hash))
                {
                    $this->session->hash = $hash;
                    $this->index();
                }
                else
                {
                    $this->load->view('admin/login');
                }
            }
        }
    }

    public function session()
    {
        $this->load->library('session');
        var_dump($this->session);
    }

    public function del_session()
    {
        $this->load->library('session');
        session_destroy();
        var_dump($this->session);
    }

    public function upload()
    {
        $this->load->helper('form');
        $this->load->model('Commission_site', 'data_model');
        $data['stats'] = $this->data_model->get_stat_names();

        if ($this->input->method() == "get")
        {
            $this->load->view('admin/upload', $data);
        }
        else
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('description', 'Description', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('price', 'Price', 'htmlspecialchars|trim');
            foreach ($data['stats'] as $stat) {
                $this->form_validation->set_rules(strtolower(str_replace(' ', '_', $stat->name)), $stat->name, 'htmlspecialchars|trim');
            }

            if ($this->form_validation->run() == FALSE)
            {
                $data['input'] = $this->input->post();
                $this->load->view('admin/upload', $data);
            }
            else
            {
                var_dump($this->input->post());

                $config['upload_path']          = './static/images/uploads/';
                $config['allowed_types']        = 'gif|jpg|png';

                echo $config['upload_path'];

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('upload_file_input'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);

                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    var_dump($data);

                    $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
                    $db_data["file_name"] = $upload_data['file_name'];
                    $db_data["art_data"] = $this->input->post();
                    $this->data_model->upload_art($db_data);
                    //$this->load->view('art', );
                }
            }
        }
    }

    public function do_upload($data)
    {
        $config['upload_path']          = base_url() . 'static/images/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $data);
        }
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

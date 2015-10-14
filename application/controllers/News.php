<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	protected $ci;

	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('news');
		$this->load->library(array('newslib', 'authlib', 'form_validation', 'session'));
		$this->load->model('newsmodel');
	}

	// Display news landing page
	function home() {

		$data['title'] = "News Portal";
		$data['news_list'] = $this->newsmodel->getAllNews($this->ci->config->item('news_display_limit'));
		$data['loggin'] = $this->authlib->loggedIn();
		$this->load->view('news/index', $data);
	}

	// Display news landing page
	function index() {
		redirect('news/home', 'refresh');
	}

	// Display user publish news
	function manage() {
		if (!$this->authlib->loggedIn()) {
			redirect('user/login', 'refresh');
		}
		$data['title'] = "My news";
		$data['news_list'] = $this->newsmodel->getUserNews($this->ci->session->userdata('user_id'));
		$this->load->view('news/manage_news', $data);
	}

	// Remove news if owner requested
	function remove($id) {

		if (!$this->authlib->loggedIn()) {
			redirect('user/login', 'refresh');
		}
		
		if($this->newslib->removeNews($id)) {
			$this->session->set_flashdata('success', 'Successfully remove the news.');
			redirect('news/manage', 'refresh');
		}

		$this->session->set_flashdata('error', $this->ci->data['errors']);
		redirect('news/manage', 'refresh');
	}

	// Display news detail page
	function details($id) {

		$data['title'] = "News Details";
		$news = $this->newsmodel->getNews($id);
		$data['loggin'] = $this->authlib->loggedIn();
		if($news === FALSE) {
			$this->session->set_flashdata('error', 'Invalid News');
			redirect('news/home', 'refresh');
		}
		if ($data['loggin']) {
			$data['user_id'] = $this->ci->session->userdata('user_id');
		}
		$data['news'] = $news;
		$this->load->view('news/news_details', $data);
	}

	// create a new nees
	function create()
    {
    	if (!$this->authlib->loggedIn()) {
			redirect('user/login', 'refresh');
		}

        $data['title'] = 'News Create';
        $image_error = FALSE;
        // validate form input
        $this->form_validation->set_rules('news_title', 'News Title', 'required|min_length[10]|max_length[100]');
        $this->form_validation->set_rules('news_content', 'News Content', 'required|min_length[100]|max_length[100000]');
        $this->form_validation->set_message('news_image', 'Image error');

        if ($this->form_validation->run() == true) {
        	$this->ci->data['errors'] = '';

        	$title = htmlspecialchars($this->input->post('news_title'));
        	$content = htmlspecialchars($this->input->post('news_content'));
        	$result = $this->newslib->newsCreate($title, $content);
        	if($result === FALSE) {
        		$image_error = TRUE;
        		$data['error'] = '<span>'.$this->ci->data['errors'].'</span><br>';
        	} 

        } else {
        	 $data['error'] = (validation_errors() ? validation_errors('<span>', '</span><br>') : '');
        }

        if ($this->form_validation->run() == true && !$image_error) {
            $this->session->set_flashdata('success', 'Successfully created the news');
            redirect("news/home", 'refresh');
        } else {

            $data['news_title'] = array(
                'name'  => 'news_title',
                'id'    => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('news_title'),
                'class' => 'form-control',
                'placeholder' => 'News Title',
            );
            $data['news_content'] = array(
                'name'  => 'news_content',
                'id'    => 'content',
                'value' => $this->form_validation->set_value('news_content'),
                'class' => 'form-control',
                'placeholder' => 'News Content',
            );
   
            $this->load->view('news/news_create', $data);
        }
    }

   	// PDF generate according to the news detail page
	function createpdf($id) {

		$data['title'] = "News Details";
		$news = $this->newsmodel->getNews($id);
		$data['loggin'] = $this->authlib->loggedIn();
		if($news === FALSE) {
			$this->session->set_flashdata('error', 'Invalid News');
			redirect('news/home', 'refresh');
		}
		if ($data['loggin']) {
			$data['user_id'] = $this->ci->session->userdata('user_id');
		}
		$data['news'] = $news;
		$html = $this->load->view('news/news_details', $data, true);
		
		// Load library
		$this->load->library('dompdf_gen');
		
		// Convert to PDF
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream(termNameToKey($news->title).'.pdf');
		
	}

}
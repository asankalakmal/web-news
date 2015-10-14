<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Feed extends CI_Controller {

	protected $ci;

	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('xml');
        $this->load->helper('text');
        $this->load->helper('url');
		$this->load->model('newsmodel');
	}

	// Create RSS FEED
	function index() {
		$data['feed_name'] = 'News Portal';
        $data['encoding'] = 'utf-8';
        $data['feed_url'] = 'http://www.newsportal.com/feed';
        $data['page_description'] = 'Latest news updates';
        $data['page_language'] = 'en-en';
        $data['creator_email'] = 'asankalakmal@gmail.com';
        $data['news_list'] = $this->newsmodel->getAllNews($this->ci->config->item('news_rss_feed_limit'));    
        header("Content-Type: application/rss+xml");
         
        $this->load->view('news/rss_feed', $data);
	}

}
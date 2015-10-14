<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class newslib
{
	private $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('newsmodel');
		$this->ci->load->library('session');
		$this->ci->load->helper(array('language','url', 'news_helper'));
		$this->ci->load->library('email');
		$this->ci->load->helper('form');

	}

	/**
	 * news Create
	 *
	 * @return boolean
	 * @author Asanka
	 **/
	public function newsCreate($title, $content) {

		$upload_file = $_FILES["news_image"]['name'] ? $_FILES["news_image"]['name']: 'temp.jpg';
		$image_name = imageNameGenerate($this->ci->session->userdata('user_id'), $upload_file);

		$config['upload_path']          = $this->ci->config->item('image_upload_path');
        $config['allowed_types']        = $this->ci->config->item('image_allowed_types');
        $config['max_size']             = $this->ci->config->item('image_max_size');
        $config['max_width']            = $this->ci->config->item('image_max_width');
        $config['max_height']           = $this->ci->config->item('image_max_height');
        $config['file_name']            = $image_name;
        
        $this->ci->load->library('upload', $config);

        if (!$this->ci->upload->do_upload('news_image')) {
            $this->ci->data['errors'] = $this->ci->upload->display_errors();
			return FALSE;
        } else {
            //$datac = $this->ci->upload->data();
            $news_data = array('image' => $image_name, 'title' => $title, 'content' => $content, 'user_id' => $this->ci->session->userdata('user_id'));
            return $this->ci->newsmodel->create($news_data);
        }

	}

	/**
	 * news remove
	 *
	 * @return boolean
	 * @author Asanka
	 **/
	public function removeNews($id) {

		$user_id = $this->ci->session->userdata('user_id');
		if( $this->ci->newsmodel->isAuthor($user_id, $id) ) {
			return $this->ci->newsmodel->removeNews($user_id, $id);
		} else {
			$this->ci->data['errors'] = 'Operation not permited.';
			return FALSE;
		}
		
	}
}
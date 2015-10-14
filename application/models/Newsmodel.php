<?php


class newsmodel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	/**
	 * News Create
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function create($news_data)
	{

		$data = array(
		    'user_id'  => $news_data['user_id'],
		    'title'   => $news_data['title'],
		    'content' => $news_data['content'],
		    'image' => $news_data['image'],
		    'created_on' => time()
		);

		$this->db->insert('news', $data);

		$id = $this->db->insert_id();

		return (isset($id)) ? $id : FALSE;
	}

	/**
	 * Get all news
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function getAllNews($page_limit = 10, $offset = 0)
	{
		$this->db->select('A.* ,B.email, B.first_name, B.last_name');
		$this->db->from('news as A');
		$this->db->join('users as B', ' A.user_id = B.id','INNER');
		if($offset)
		{
			$this->db->limit($offset+$page_limit,$offset);
		}else
		{
			$this->db->limit($page_limit);
		}
		$this->db->order_by('A.created_on', 'desc');
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	/**
	 * Get user news
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function getUserNews($user_id, $page_limit = 100, $offset = 0)
	{
		$this->db->select('A.* ,B.email, B.first_name, B.last_name');
		$this->db->from('news as A');
		$this->db->join('users as B', ' A.user_id = B.id','INNER');
		if($offset)
		{
			$this->db->limit($offset+$page_limit,$offset);
		}else
		{
			$this->db->limit($page_limit);
		}
		$this->db->order_by('A.created_on', 'desc');
		$this->db->where('B.id', $user_id);
		$query = $this->db->get();
		$result = $query->result();
		return $result;
	}

	/**
	 * Get all news
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function getNews($news_id)
	{
		$this->db->select('A.* ,B.email, B.first_name, B.last_name');
		$this->db->from('news as A');
		$this->db->join('users as B', ' A.user_id = B.id','INNER');
		$this->db->where('A.id', $news_id);
		$query = $this->db->get();
		
		if ($query->num_rows() === 1) {
			$news = $query->row();
			return $news;
		}

		return FALSE;
	}

	/**
	 * check news id belongs to the user
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function isAuthor($user_id, $id) {
		$this->db->select('title');
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $id);
		$query = $this->db->get('news');

		if ($query->num_rows() === 1) {
			return true;
		}

		return FALSE;
	}

	/**
	 * Remove news
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function removeNews($user_id, $id) {

		return $this->db->delete('news', array('id' => $id, 'user_id' => $user_id));
	}


}
<?php


class authmodel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/**
	 * activate
	 *
	 * @return void
	 * @author Asanka
	 **/
	public function userActivate($password, $email)
	{

		$data = array(
			'password' => $password,
		    'activation_code' => NULL,
		    'active'          => 1
		);
		$this->db->update('users', $data, array('email' => $email));
		
	}

	/**
	 * register
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function register($registration_data = array())
	{

		if ($this->emailExists($registration_data['email'])) {
			return FALSE;
		}

		// IP Address
		$ip_address = $this->input->ip_address();

		// Users table.
		$data = array(
		    'email'      => $registration_data['email'],
		    'password'   => $registration_data['password'],
		    'first_name' => $registration_data['first_name'],
		    'last_name' => $registration_data['last_name'],
		    'salt' 		=> $registration_data['salt'],
		    'activation_code' => $registration_data['activation_code'],
		    'ip_address' => $ip_address,
		    'created_on' => time(),
		    'active'     => 0
		);

		$this->db->insert('users', $data);

		$id = $this->db->insert_id();

		return (isset($id)) ? $id : FALSE;
	}

	/**
	 * login
	 *
	 * @return bool
	 * @author Asnaka
	 **/
	public function login($email, $password)
	{
		$query = $this->db->select('email, id, password, first_name, last_name')
		                  ->where('email', $email)
		                  ->where('password', $password)
		                  ->where('active', 1)
		                  ->get('users');

		if ($query->num_rows() === 1) {
			$user = $query->row();
			return $user;
		}

		return FALSE;
	}

	/**
	 * get user details by email
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function getUserByEmail($email)
	{
		$query = $this->db->select('email, id, password, first_name, last_name')
		                  ->where('email', $email)
		                  ->where('active', 1)
		                  ->get('users');

		if ($query->num_rows() === 1) {
			$user = $query->row();
			return $user;
		}

		return FALSE;
	}

	/**
	 * Check email already exists
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function emailExists($email = '')
	{
		if (empty($email))
		{
			return FALSE;
		}

		return $this->db->where('email', $email)->count_all_results('users') == 1;
	}

	/**
	 * Validate email activation code
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function activationCodeValidate($id, $code) {
		$query = $this->db->select('email')
			                ->where('activation_code', $code)
			                ->where('id', $id)
			                ->where('active', 0)
			                ->limit(1)
		    				->order_by('id', 'desc')
			                ->get('users');

		$result = $query->row();

		if ($query->num_rows() == 1)
		{
			return $result->email;
		}

		return FALSE;
	}

	/**
	 * Get db salt value
	 *
	 * @return bool
	 * @author Asanka
	 **/
	public function getDbSalt($email) {

		$query = $this->db->select('salt')
			                ->where('email', $email)
			                ->limit(1)
			                ->get('users');

		$result = $query->row();
		if ($query->num_rows() == 1) {
			return $result->salt;
		}

		return FALSE;
	}


}
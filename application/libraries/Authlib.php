<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class authlib
{
	private $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->model('authmodel');
		$this->ci->load->library('session');
		$this->ci->load->helper(array('cookie', 'language','url'));
		$this->ci->load->library('email');

	}

	/**
	 * register
	 *
	 * @return void
	 * @author Asanka
	 **/
	public function register($registration_data = array()) //need to test email activation
	{

		// Activation code generation
		$activation_code = md5($registration_data['email'].time().'csqwwew^#wcw$%dwee');
		$salt = $this->getsaltKey($registration_data['email']);
		$password_key = $this->ci->config->item('auth_password_key');
		$password = $this->passwordGenerate($password_key, $registration_data['email'], $salt);
		$id = $this->ci->authmodel->register(array_merge($registration_data, array('activation_code' => $activation_code, 'salt' => $salt, 'password' => $password)));

		if (!$id) {
			return FALSE;
		}

		$data = array(
			'first_name' => $registration_data['first_name'],
			'id' => $id,
			'email'      => $registration_data['email'],
			'activation' => $activation_code,
		);

		$message = $this->ci->load->view('auth/email/activate', $data, true);

		$this->ci->email->clear();
		$this->ci->email->set_mailtype("html");
		$this->ci->email->from('news-portal@gmail.com', 'News Portal');
		$this->ci->email->to($registration_data['email']);
		$this->ci->email->subject('News Portal - Activation');
		$this->ci->email->message($message);

		if ($this->ci->email->send() == TRUE) {
			return $id;
		} 

		return FALSE;
		
	}

	/**
	 * user login
	 *
	 * @return boolean
	 * @author Asanka
	 **/
	public function login($email, $password, $remember_me = false) {

		$salt = $this->ci->authmodel->getDbSalt($email);
		if($salt !== FALSE) {
			$user_password = $this->passwordGenerate($password, $email, $salt);

			$user_details = $this->ci->authmodel->login($email, $user_password);
			if($user_details !== FALSE) {
				$this->set_session($user_details);

				return TRUE;
			}

		}

		return FALSE;
		
	}

	/**
	 * logout
	 *
	 * @return boolean
	 * @author Asanka
	 **/
	public function logout()
	{
		
		$this->ci->session->unset_userdata( array('email', 'first_name', 'last_name', 'user_id') );
		return TRUE;
	}

	/**
	 * loggedIn
	 *
	 * @return boolean
	 * @author Asanka
	 **/
	public function loggedIn()
	{
		return (bool) $this->ci->session->userdata('email');
	}

	/**
	 * getsaltKey
	 *
	 * @return string salt key
	 * @author Asanka
	 **/
	private function getsaltKey($email)
	{
		$salt_key = $this->ci->config->item('auth_salt_key');
		$salt = md5($email.time().$salt_key);

		return substr($salt, 2, 12);
	}

	/**
	 * activate
	 *
	 * @return boolean
	 * @author Asanka
	 **/
	public function activate($id, $code, $password)
	{
		$email = $this->ci->authmodel->activationCodeValidate($id, $code);
		if ($email !== FALSE) {

			$user_salt = $this->ci->authmodel->getDbSalt($email);
			$db_password = $this->passwordGenerate($password, $email, $user_salt);
			$user_salt = $this->ci->authmodel->userActivate($db_password, $email);
			$user = $this->ci->authmodel->getUserByEmail($email);
			$this->set_session($user);

			$message = $this->ci->load->view('auth/email/activated_success', array('first_name' => $user->first_name), true);

			$this->ci->email->clear();
			$this->ci->email->set_mailtype("html");
			$this->ci->email->from('news-portal@gmail.com', 'News Portal');
			$this->ci->email->to($email);
			$this->ci->email->subject('News Portal - Successfully Activated Your Activation');
			$this->ci->email->message($message);
			$this->ci->email->send();

			return TRUE;
		} 

		return FALSE;	

	}

	/**
	 * password generate
	 *
	 * @return String password
	 * @author Asanka
	 **/
	private function passwordGenerate($password, $email, $salt) {

		$salt = md5($email.$salt.$password);
		return substr($salt, 5, 15);
	}

	/**
	 * set_session
	 *
	 * @return bool
	 * @author asanka
	 **/
	public function set_session($user)
	{

		$session_data = array(
		    'email'       => $user->email,
		    'user_id'     => $user->id,
		    'first_name'  => $user->first_name,
		    'last_name'   => $user->last_name
		);

		$this->ci->session->set_userdata($session_data);

		return TRUE;
	}


}
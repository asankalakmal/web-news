<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	protected $ci;

	function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library(array('authlib','form_validation'));
		$this->load->model('authmodel');

	}

	// log the user in
	function login()
	{
		if ($this->authlib->loggedIn()) {
			redirect('news/home', 'refresh');
		}

		$data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true) {
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->authlib->login($this->input->post('email'), $this->input->post('password'), $remember)) {
				//if the login is successful
				//redirect them back to the home page
				redirect('news/manage', 'refresh');
			} else {
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('error', 'Invalid Username or Password');
				redirect('auth/login', 'refresh'); 
			}
		} else {
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : '';

			$this->data['email'] = array('name' => 'email',
				'id'    => 'email',
				'type'  => 'email',
				'value' => $this->form_validation->set_value('email'),
				'class' => 'form-control',
                'placeholder' => 'Email',
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
				'class' => 'form-control',
                'placeholder' => 'Password',
			);

			$this->load->view('auth/login', $this->data);
		}
	}

	// log the user out
	function logout()
	{
		$data['title'] = "Logout";
		// log the user out
		$logout = $this->authlib->logout();
		// redirect them to the login page
		$this->session->set_flashdata('info', "Successfully logout!");
		redirect('auth/login', 'refresh');
	}


	// activate the user
	function activate($id, $code=false) 
	{

		if ($code !== false && $id !== false) {
			
			if ($this->authmodel->activationCodeValidate($id, $code)) {

				$data = $this->_changePasswordForm($id, $code);
				$this->load->view('auth/change_password', $data);
			} else {
				$this->session->set_flashdata('error', 'Invalid activation link');
				redirect('auth/login', 'refresh');
			}
		} else {
			show_404();
		}

	}

	// activated user change the password
	function changePassword() 
	{

		$id = trim($this->input->post('id'));
		$code = trim($this->input->post('code'));
		if ($id != null && $code != null) {

			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[12]|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required');

            if ($this->form_validation->run() == true) {
            	$activate = $this->authlib->activate($id, $code, trim($this->input->post('password')));
            	
            	if($activate === TRUE) {
            		$this->session->set_flashdata('success', 'Your account has been activated!');
					redirect('news/manage', 'refresh');
            	} else {
            		$this->session->set_flashdata('error', 'Unknown error');
					redirect('auth/login', 'refresh');
            	}

            } else {
            	$data = $this->_changePasswordForm($id, $code);
            	$data['message'] = (validation_errors() ? validation_errors() : '');
				$this->load->view('auth/change_password', $data);
            }
		} else {
			$this->session->set_flashdata('error', 'This action is prohibited');
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		}


	}

	// create a new user
	function signup()
    {
    	if ($this->authlib->loggedIn()) {
			redirect('news/home', 'refresh');
		}

        $data['title'] = "Create User";
        $data['signup'] = true;

        // validate form input
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        if ($this->form_validation->run() == true) {
            $additional_data = array(
            	'email' => strtolower($this->input->post('email')),
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name')
            );
        }
        if ($this->form_validation->run() == true && $this->authlib->register($additional_data)) {
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('success', 'Activation email send!');
            redirect("auth/login", 'refresh');
        } else {
            // display the create user form
            // set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : '');

            $data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
                'class' => 'form-control',
                'placeholder' => 'First Name',
            );
            $data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
                'class' => 'form-control',
                'placeholder' => 'Last Name',
            );
            $data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
                'class' => 'form-control',
                'placeholder' => 'Email Address',
            );

            $this->load->view('auth/signup', $data);
        }
    }

    // Change password form
    function _changePasswordForm($id, $code) {

    	$data['password'] = array(
            'name'  => 'password',
            'id'    => 'password',
            'type'  => 'password',
            'value' => '',
            'class' => 'form-control',
            'placeholder' => 'Password',
        );
        $data['password_confirm'] = array(
            'name'  => 'password_confirm',
            'id'    => 'password_confirm',
            'type'  => 'password',
            'value' => '',
            'class' => 'form-control',
            'placeholder' => 'Confirm Password',

        );
        $data['code'] = array(
            'name'  => 'code',
            'type'  => 'hidden',
            'value' => $code,
        );
        $data['id'] = array(
            'name'  => 'id',
            'type'  => 'hidden',
            'value' => $id,
        );

        return $data;
    }


}

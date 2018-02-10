<?php

Class Auth Extends CI_Controller
{

	public  function  __construct()
	{
		parent::__construct();
		$this->load->helper('Tools');
		$this->load->model('AuthModel');
	}

	public function index()
	{
		if(!empty($this->session->userdata('id')))
		{
			if($this->session->userdata('role') == 'admin')
			{
				redirect('Admin');
			}
			else
			{
				redirect('User');
			}
		}
		else
		{
			$this->load->view('LandingPage');
		}
	}


	public function verifyLogin()
	{
		if(empty($this->input->post('username')) || empty($this->input->post('password')))
		{
			redirect('/');
		}


		$credentials = array(
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password'))
		);

		$login = $this->AuthModel->loginCheck($credentials['username'],$credentials['password']);
		if($login != false)
		{
			$this->session->set_userdata('id',$login['id']);
			$this->session->set_userdata('username',$login['username']);
			$this->session->set_userdata('role',$login['role']);
			redirect('/');
		}
		else
		{
			//redierct to landing page with error message
			if(empty($this->session->userdata('id')))
			 {
				$this->session->set_flashdata('error_msg', 'Invalid Username/Password.');
     		 	$this->load->view("LandingPage");
			 }
			 else
			 {
			 	redirect('/');
			 }

		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
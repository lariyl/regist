<?php

Class Auth Extends CI_Controller
{
	public  function  __construct()
	{
		parent::__construct();
		$this->load->helper('Tools');
		$this->load->model('AuthModel');
		$this->load->library('session');
		$this->load->library('form_validation');
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
			$this->load->view('landingPage');
		}
	}

	public function verifyLogin()
	{
		if(isset($_POST['username']) && isset($_POST['password']))
		{
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
				$this->index();
			}
			else
			{
				$this->session->set_flashdata('error_msg', 'Invalid Username/Password.');
				redirect('Auth');
			}
		}
		else
		{
			redirect('Auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
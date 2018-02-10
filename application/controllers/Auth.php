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
		$credentials = array(
			'username'=>$this->input->post('username'),
			'password'=>md5($this->input->post('password'))
		);

		$login = $this->AuthModel->loginCheck($credentials['username'],$credentials['password']);
		if($login != false)
		{
			if($login['role'] == 'admin')
			{
				$this->load->view('Admin/');
			}
			else
			{
				$this->load->view('User/');
			}
		}
		else
		{
			$this->load->view('LandingPage');
		}
	}

}
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
			$this->load->view('LandingPage');
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

  	public function changePass()
  	{
    	$this->load->view("changepassword");
   	}

  public function updatePwd()
  {
    $this->form_validation->set_rules('password', 'Current Password', 'required|alpha_numeric');
    $this->form_validation->set_rules('newpass', 'New Password', 'required|alpha_numeric');
    $this->form_validation->set_rules('confpassword', 'Password Confirmation', 'required|alpha_numeric');
    if($this->form_validation->run())
    {
      $curr_password = md5($this->input->post('password'));
      $new_password = md5($this->input->post('newpass'));
      $conf_password = md5($this->input->post('confpassword'));
      $this->load->model('AuthModel');
      $userid= $this->session->userdata('id');
      $passwd = $this->AuthModel->getCurrPassword($userid);

      if($passwd->password == $curr_password)
      {
        if($new_password == $conf_password)
        {
          if($this->AuthModel->updatePassword($new_password,$userid))
          {
            $this->index();
          }
          else
          {
            $this->session->set_flashdata('error_msg', 'Failed to update password.');
          }
        }
        else
        {
          $this->session->set_flashdata('error_msg', 'New Password & Confirm Password dont match.');
        }
      }
      else
      {
        $this->session->set_flashdata('error_msg', 'Sorry! Current Password dont match.');
      }
    }

    $this->load->view("changepassword");
  }   	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
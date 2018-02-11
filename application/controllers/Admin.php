<?php

Class Admin extends CI_Controller
{
	public  function  __construct()
	{
		parent::__construct();
    	$this->load->helper('url');		
		  $this->load->helper('Tools');
		  $this->load->model('AdminModel');
      $this->load->model('AuthModel');
    	$this->load->library('session');
	}
	public function  index(){
		$data["fetchData"] = $this->AdminModel->fetchData();
    	$this->load->view("Admin/index", $data);
	}

	public function registerUser()
  	{	
    	$user=array(
        	'username'=>$this->input->post('username'),
        	'email'=>$this->input->post('email'),
        	'password'=>md5($this->input->post('password')),
    );
    	print_r($user);
    	$checkUser=$this->AuthModel->checkUser($user['username']);

    	if($checkUser)
    		{
      			$this->AdminModel->registerUser($user);
      			$this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
      			redirect('Admin/index');
    		}
    	else
    		{
      			$this->session->set_flashdata('error_msg', 'Error! Username has already been taken.');
      			redirect('Admin/index');
    		}
  	}

 	public function deleteUser()
	{
		$id = $_POST['id'];
		$this->AdminModel->deleteUser($id);
		return;
	}

	public function deleted()
  		{
   			$this->index();
  		}
}
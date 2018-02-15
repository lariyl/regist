<?php

Class Admin extends CI_Controller
{
	public  function  __construct()
	{
		parent::__construct();
		$this->load->helper('Tools');
		$this->load->model('AdminModel');
		$this->load->model('AuthModel');
		$this->load->library('session');

		if($this->session->userdata('role') != 'admin')
		{
			redirect('Auth');
		}
	}

	public function index(){
		$data["users"] = $this->AdminModel->fetchUsers();
		$this->load->view("Admin/index", $data);
	}

	public function registerUser()
	{
		$user=array(
			'username'=>$this->input->post('username'),
			'email'=>$this->input->post('email'),
			'password'=>md5($this->input->post('password')),
			'role'=>$this->input->post('role'),
		);

		if($this->AuthModel->checkUser($user['username']))
		{
			$id = $this->AdminModel->registerUser($user);
			if($id)
			{
				echo json_encode(array('isOk' => true, 'id' => $id));
			}
			else
			{
				echo json_encode(array('isOk' => false, 'error' => 'Unknown error. Please try again.'));
			}
		}
		else
		{
			echo json_encode(array('isOk' => false, 'error' => 'Username is already Taken.'));
		}
	}

 	public function deleteUser()
	{
		$id = $_POST['id'];
		$this->AdminModel->deleteUser($id);
		return;
	}
}
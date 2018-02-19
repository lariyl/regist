<?php
 
class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('Tools');
		$this->load->model('UserModel');
		$this->load->library('session');
		$this->load->library('form_validation');

		if($this->session->userdata('role') != 'user')
		{
			redirect('Auth');
		}
	}

	public function index()
	{
		$this->load->view("User/index");
	}

	public function manageClass()
	{
		$data['courses'] = $this->UserModel->getCourses();
		$this->load->view("User/manageClass",$data);
	}

	public function inputGrades()
	{
		$this->load->view("User/inputGrades");
	}

	public function viewReports()
	{
		$this->load->view("User/viewReports");
	}

	public function addClassSchedule(){

		$class = array(
			'course_id' => $this->input->post('course_id'),
			'group' =>  $this->input->post('group'),
			'schedule' =>  $this->input->post('schedule'),
			'user_id' =>  $this->input->post('user_id')
		);

		$classid = $this->UserModel->createCourseClass($class);

		if($classid){
			echo json_encode(array('isOk' => true, 'id' => $classid));
		}
		else{
			echo json_encode(array('isOk' => false, 'error' => 'Unknown error. Please try again.'));
		}
	}

	public function changePassword()
	{
		$this->load->view("User/changePassword");
	}

	public function updatePassword()
	{
		$this->form_validation->set_rules('password', 'Current Password', 'required|alpha_numeric');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|alpha_numeric');
		$this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'required|alpha_numeric');
		if($this->form_validation->run())
		{
			$current_password = md5($this->input->post('password'));
			$new_password = md5($this->input->post('new_password'));
			$confirm_password = md5($this->input->post('confirm_password'));
			$this->load->model('AuthModel');
			$user_id= $this->session->userdata('id');
			$password = $this->AuthModel->getCurrentPassword($user_id);

			if($password->password == $current_password)
			{
				if($new_password == $confirm_password)
				{
					if($this->AuthModel->updatePassword($new_password,$user_id))
					{
						$this->session->set_flashdata('success_msg', 'Password changed successfully.');
					}
					else
					{
						$this->session->set_flashdata('error_msg', 'Failed to update password.');
					}
				}
				else
				{
					$this->session->set_flashdata('error_msg', "New Password & Confirm Password don't match.");
				}
			}
			else
			{
				$this->session->set_flashdata('error_msg', "Sorry! Current Password don't match.");
			}
			$this->load->view("User/changePassword");
		}
		else
		{
			$this->session->set_flashdata('error_msg', 'Password is required.');
			$this->load->view("User/changePassword");
		}
	}
}
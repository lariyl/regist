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
		$data['classes'] = $this->UserModel->getClasses();
		$data['completed'] = $this->UserModel->getClasses("completed");
		$this->load->view("User/manageClass",$data);
	}

	public function deleteClass()
	{
		$id = $_POST['cid'];
		$this->UserModel->deleteClass($id);

		$response['isOk']= true;

		echo json_encode($response);
	}

	public function inputGrades()
	{
		$data['classes'] = $this->UserModel->getClasses();
		$data['students'] = $this->UserModel->getStudentsInClass();
		$this->load->view("User/inputGrades",$data);
	}

	public function startClass(){
		if(isset($_POST['cid'])){
			$this->UserModel->startClass($_POST['cid']);

			$response['isOk'] = true;
			$response['cid'] = $_POST['cid'];
		}else{
			$response['isOk'] = false;
			$response['error'] = 'No Class ID found.';
		}

		echo json_encode($response);
	}

	public function submitReport(){
		if(isset($_POST['cid'])){
			$cid = $_POST['cid'];
			$data = array(
				"class_id" => $cid,
				"data_interpretation" => $_POST['interpretation'],
				"proposed_improvement" => $_POST['improvement_proposal']
			);
			$this->UserModel->endClass($_POST['cid']);

			$response['report_id'] = $this->UserModel->saveReport($data);
			$response['loopback_data'] = $data;
			$response['isOk'] = true;

			redirect("User/viewReports?cid=$cid");

		}else{
			$response['isOk'] = false;
			$response['error'] = "No class ID found.";
		}

		echo json_encode($response);
	}

	public function saveGrades(){

		$gradeTable = array();

		if(isset($_POST['courseClass'])){
			$cid = $_POST['courseClass'];

			foreach ($_POST['studentid'] as $idx => $sid ){
				$studentGrades = array(
					"class_id" => $cid,
					"student_id" => $sid,
					"grade_premidterms" => $_POST['premidterms'][$idx],
					"grade_midterms" => $_POST['midterms'][$idx],
					"grade_prefinals" => $_POST['finals'][$idx],
					"grade_finals" => $_POST['prefinals'][$idx],
					"grade_others" => $_POST['others'][$idx],
					"grade_practicals" => $_POST['practicals'][$idx]
				);

				array_push($gradeTable, $studentGrades);
			}

			$response['insert_status']  = $this->UserModel->saveGradesTable($gradeTable,$cid);
			$response['isOk'] = true;
		}else{
			$response['isOk'] = false;
			$response['error'] = 'Course class not set.';
		}

		echo json_encode($response);
	}

	public function viewReports()
	{
		if(isset($_GET['cid'])) {
			$class_id = $_GET['cid'];

			$data['completed'] = $this->UserModel->isCompleted($class_id);
			$data['evaluation'] = $this->UserModel->evaluateClass($class_id);
			$data['loopback_cid'] = $class_id;

			$this->load->view("User/viewReports",$data);
		}else{
			redirect("User/viewReports");
		}
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
			//first or new students, loop thru insernting students to class
			$test = 0;
			$test2 = 0;
			foreach ($this->input->post('student_ids') as $idx=>$si){
				$si = intval($si);
				$test = $si;
				$student = $this->UserModel->getStudent($si);
				$test = $student;
				if(!isset($student)){
					$new_id = $this->UserModel->registerSutdent(array('id'=> $si, 'name' => $this->input->post('student_names')[$idx]));
					$test2 = $new_id;
					$this->UserModel->enrolStudent($classid,$new_id);
				}else{
					$this->UserModel->enrolStudent($classid,$si);
				}
			}

			echo json_encode(array('isOk' => true, 'id' => $classid, 'test' => $test, 'test2'=>$test2,'student_ids' => $this->input->post('student_ids'), 'student_names' => $this->input->post('student_names')));
		}
		else{
			echo json_encode(array('isOk' => false, 'error' => 'Unknown error. Please try again.'));
		}
	}

	public function changePassword()
	{
		$this->load->view("User/changePassword");
	}

	public function pastClass()
	{
		$this->load->view("User/pastClass");
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
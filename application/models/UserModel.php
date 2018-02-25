<?php

Class UserModel extends CI_model
{
	//New
	public function createCourseClass($data){
		$this->db->insert('course_classes',$data);
		return $this->db->insert_id();
	}

	public function getCourses(){
		return $this->db->get("courses");
	}

	public function getStudent($id){
		return $this->db->query("SELECT * FROM students WHERE id = $id")->row();
//		return $this->db->from('students')->where('id',$id)->get()->row();
	}

	public function registerSutdent($data){
		$this->db->insert('students',$data);
		return $this->db->insert_id();
	}

	public function enrolStudent($class_id, $student_id){
		$enrollment_id = null;
		$enrollment = $this->db->query("SELECT * FROM students_in_class WHERE class_id = $class_id AND student_id = $student_id")->row();
		if(!isset($enrollment)){
			$this->db->insert('students_in_class',array('class_id' => $class_id, 'student_id' => $student_id));
			$enrollment_id = $this->db->insert_id();
		}else{
			$enrollment_id = $enrollment->id;
		}

		return $enrollment_id;
	}
}
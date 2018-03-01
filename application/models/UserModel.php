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

	public function getClasses(){
		$user = $this->session->userdata("id");
		return $this->db->query("
				SELECT *, 
				(SELECT count(id) FROM students_in_class AS sic WHERE cc.int = sic.class_id) AS student_count,
				cc.int AS cc_id
				FROM course_classes AS cc JOIN courses AS c ON c.id =  cc.course_id
				WHERE cc.user_id = $user
			");
	}

	public function getStudentsInClass(){
		$user = $this->session->userdata("id");
		return $this->db->query("
				SELECT *, sic.class_id AS cc_id FROM students_in_class AS sic 
					JOIN students AS s ON s.id= sic.student_id
					WHERE sic.class_id IN (SELECT cc.int FROM course_classes AS cc WHERE user_id = $user) ORDER BY s.name ASC
			");
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

	public function saveGradesTable($table,$class_id){
		$this->db->delete('students_in_class', array('class_id' => $class_id));

		return $this->db->insert_batch('students_in_class', $table);
	}
}
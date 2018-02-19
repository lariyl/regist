<?php

Class UserModel extends CI_model
{
	//New
	public function createCourseClass($data){
		return $this->db->insert('course_classes',$data);
	}

	public function getCourses(){
		return $this->db->get("courses");
	}

}
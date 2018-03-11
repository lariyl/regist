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

	public function getClasses($status = null){

		if ($status == "completed"){
			$status_filter = " AND cc.completed = 1";
		}elseif ($status == "started"){
			$status_filter = " AND cc.started = 1";
		}else{
			$status_filter = " AND cc.completed = 0";
		}

		$user = $this->session->userdata("id");
		return $this->db->query("
				SELECT *, 
				(SELECT count(id) FROM students_in_class AS sic WHERE cc.int = sic.class_id) AS student_count,
				DATE_FORMAT(cr.submitted_at,'%M %e, %Y (%l:%i:%s %p)') AS `submission_date`,
				cc.int AS cc_id
				FROM course_classes AS cc
				JOIN courses AS c ON c.id =  cc.course_id
				LEFT JOIN class_reports AS cr ON cr.class_id = cc.int 
				WHERE cc.user_id = $user
				$status_filter
			");
	}

	public function isCompleted($class_id){
		$query = $this->db->query("SELECT id FROM class_reports WHERE class_id = $class_id");
		return  $query->num_rows() > 0 ? true : false;
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

	public function startClass($class_id){
		$this->db->where('int',$class_id)->update('course_classes',array('started' => 1));
	}

	public function endClass($class_id){
		$this->db->where('int',$class_id)->update('course_classes',array('completed' => 1));
	}

	public function saveGradesTable($table,$class_id){
		$this->db->where('int',$class_id)->update('course_classes',array('started' => 1));

		$this->db->delete('students_in_class', array('class_id' => $class_id));

		return $this->db->insert_batch('students_in_class', $table);
	}

	public function evaluateClass($class_id){
		$passed_qs = "SELECT 
			count(sic.student_id) AS `passed`,
			c.code AS `course_code`,
			c.title AS `course_title`,
			c.co1 AS `course_outcome_1`,
			c.co2 AS `course_outcome_2`,
			c.co3 AS `course_outcome_3`,
			cc.completed AS `is_completed`,
			cr.data_interpretation AS `interpretation`,
			cr.proposed_improvement AS `improvement_proposal`,
			DATE_FORMAT(cr.submitted_at,'%M %e, %Y (%l:%i:%s %p)') AS `submission_date`,
			cc.group AS `class_group`
			FROM students_in_class  AS sic 
			JOIN course_classes AS cc ON sic.class_id = cc.int
			JOIN courses AS c ON cc.course_id = c.id
			LEFT JOIN class_reports AS cr ON cr.class_id = cc.int
			WHERE (
				sic.grade_premidterms * c.weight_premidterms +
				sic.grade_midterms * c.weight_midterms +
				sic.grade_prefinals * c.weight_prefinals +
				sic.grade_finals * c.weight_finals +
				sic.grade_prefinals * c.weight_prefinals +
				sic.grade_practicals *c.weight_practicals +
				sic.grade_others * c.weight_others
			) < 3.0 AND sic.class_id = $class_id";
		
		$ranks_qs = "
			SELECT 
				count(id) AS sc ,
				(SELECT count(id) FROM students_in_class WHERE grade_premidterms >= 1 AND grade_premidterms <= 1.4 AND class_id = $class_id) AS pmr1,
				(SELECT count(id) FROM students_in_class WHERE grade_premidterms > 1.4 AND grade_premidterms <= 2.4 AND class_id = $class_id) AS pmr2,
				(SELECT count(id) FROM students_in_class WHERE grade_premidterms > 2.4 AND grade_premidterms <= 3 AND class_id = $class_id) AS pmr3,
				(SELECT count(id) FROM students_in_class WHERE grade_premidterms > 3 AND class_id = $class_id) AS pmr4,
				
				(SELECT count(id) FROM students_in_class WHERE grade_midterms >= 1 AND grade_midterms <= 1.4 AND class_id = $class_id) AS mr1,
				(SELECT count(id) FROM students_in_class WHERE grade_midterms > 1.4 AND grade_midterms <= 2.4 AND class_id = $class_id) AS mr2,
				(SELECT count(id) FROM students_in_class WHERE grade_midterms > 2.4 AND grade_midterms <= 3 AND class_id = $class_id) AS mr3,
				(SELECT count(id) FROM students_in_class WHERE grade_midterms > 3 AND class_id = $class_id) AS mr4,
				
				(SELECT count(id) FROM students_in_class WHERE grade_prefinals >= 1 AND grade_prefinals <= 1.4 AND class_id = $class_id) AS pfr1,
				(SELECT count(id) FROM students_in_class WHERE grade_prefinals > 1.4 AND grade_prefinals <= 2.4 AND class_id = $class_id) AS pfr2,
				(SELECT count(id) FROM students_in_class WHERE grade_prefinals > 2.4 AND grade_prefinals <= 3 AND class_id = $class_id) AS pfr3,
				(SELECT count(id) FROM students_in_class WHERE grade_prefinals > 3 AND class_id = $class_id) AS pfr4,
				
				(SELECT count(id) FROM students_in_class WHERE grade_finals >= 1 AND grade_finals <= 1.4 AND class_id = $class_id) AS fr1,
				(SELECT count(id) FROM students_in_class WHERE grade_finals > 1.4 AND grade_finals <= 2.4 AND class_id = $class_id) AS fr2,
				(SELECT count(id) FROM students_in_class WHERE grade_finals > 2.4 AND grade_finals <= 3 AND class_id = $class_id) AS fr3,
				(SELECT count(id) FROM students_in_class WHERE grade_finals > 3 AND class_id = $class_id) AS fr4,
				
				(SELECT count(id) FROM students_in_class WHERE grade_practicals >= 1 AND grade_practicals <= 1.4 AND class_id = $class_id) AS pr1,
				(SELECT count(id) FROM students_in_class WHERE grade_practicals > 1.4 AND grade_practicals <= 2.4 AND class_id = $class_id) AS pr2,
				(SELECT count(id) FROM students_in_class WHERE grade_practicals > 2.4 AND grade_practicals <= 3 AND class_id = $class_id) AS pr3,
				(SELECT count(id) FROM students_in_class WHERE grade_practicals > 3 AND class_id = $class_id) AS pr4,
				
				(SELECT count(id) FROM students_in_class WHERE grade_others >= 1 AND grade_others <= 1.4 AND class_id = $class_id) AS or1,
				(SELECT count(id) FROM students_in_class WHERE grade_others > 1.4 AND grade_others <= 2.4 AND class_id = $class_id) AS or2,
				(SELECT count(id) FROM students_in_class WHERE grade_others > 2.4 AND grade_others <= 3 AND class_id = $class_id) AS or3,
				(SELECT count(id) FROM students_in_class WHERE grade_others > 3 AND class_id = $class_id) AS or4

				FROM students_in_class AS sic 
				WHERE sic.class_id = $class_id";

		$data['ranks'] = $this->db->query($ranks_qs)->row();
		$data['tc'] = $this->db->query($passed_qs)->row();

		return $data;
	}

	public function deleteClass($id)
	{
		$this->db->where("int", $id);
		$this->db->delete("course_classes");
 	}

 	public function saveReport($data){
		$this->db->insert('class_reports',$data);
		return $this->db->insert_id();
	}

}
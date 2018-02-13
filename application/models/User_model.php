<?php
class User_model extends CI_model
{

	public function insert_course($data)
		{
			$this->db->insert('courses',$data);
			return $this->db->insert_id();
		}

	public function fetch_course()
		{
			$query = $this->db->get("courses");
			return $query;
		}

	public function select()
		{
			$this->db->order_by('id', 'DESC');
			$query = $this->db->get('students');
			return $query;
		}

	public function insert($data)
  {
    $this->db->insert_batch('students', $data);
  }

}
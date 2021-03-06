<?php

Class AuthModel Extends CI_Model
{

	public function checkUser($username)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$username);
		$query=$this->db->get();

		if($query->num_rows()>0){
			return false;
		}else{
			return true;
		}
	}

	public  function loginCheck($username, $pass)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username',$username);
		$this->db->where('password',$pass);

		if($query=$this->db->get())
		{
			return $query->row_array();
		}
		else{
			return false;
		}
	}

	public function getCurrentPassword($userid)
	{
		$query= $this->db->where(['id'=>$userid])->get('users');
		if($query->num_rows() > 0)
		{
			return $query->row();
		}
	}

	public function updatePassword($new_password,$userid)
	{
		$data = array('password'=>$new_password);
		return $this->db->where('id',$userid)->update('users', $data);
	}

}
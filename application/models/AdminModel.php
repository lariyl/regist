<?php

Class AdminModel extends CI_model
{

	public function registerUser($user)
	{
		return $this->db->insert('users', $user);
	}

	public function fetchUsers()
	{
		$query = $this->db->get("users");
		return $query;
  }

	public function deleteUser($id)
	{
		$this->db->where("id", $id);
		$this->db->delete("users");
 	} 

}
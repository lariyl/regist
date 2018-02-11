<?php

class AdminModel extends CI_model
{

	public function registerUser($user)
	{
  	$this->db->insert('users', $user);
	}

	public function fetchData()
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
?>
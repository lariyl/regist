<?php

class AdminModel extends CI_model
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

	public function registerUser($user)
	{
  	$this->db->insert('users', $user);
	}

	public function fetchData()
	{
    $query = $this->db->get("users");
    return $query;
  }

  public function deleteData($id)
  {
    $this->db->where("id", $id);
    $this->db->delete("users");
 	} 

}
?>
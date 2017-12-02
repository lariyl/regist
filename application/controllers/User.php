<?php
 
class User extends CI_Controller {
 
public function __construct(){
 
        parent::__construct();
  			$this->load->helper('url');
  	 		$this->load->model('user_model');
        $this->load->library('session');
 
}
 
public function index()
{
$this->load->view("register.php");
}
 
public function register_user(){
 
      $user=array(
      'username'=>$this->input->post('username'),
      'email'=>$this->input->post('email'),
      'password'=>md5($this->input->post('password')),
        );
        print_r($user);
 
$username_check=$this->user_model->username_check($user['username']);
 
if($username_check){
  $this->user_model->register_user($user);
  $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
  redirect('user/login_view');
 
}
else{
 
  $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
  redirect('user');
 
 
}
 
}
 
public function login_view(){
 
$this->load->view("login.php");
 
}
 
function login_user(){
  $user_login=array(
 
  'username'=>$this->input->post('username'),
  'password'=>md5($this->input->post('password'))
 
    );
 
    $data=$this->user_model->login_user($user_login['username'],$user_login['password']);
      if($data)
      {
        $this->session->set_userdata('id',$data['id']);
        $this->session->set_userdata('username',$data['username']);
        $this->session->set_userdata('email',$data['email']);

        $this->load->view('user_profile.php');
 
      }
      else{
        $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
        $this->load->view("login.php");
 
      }
 
 
}
 
function user_profile(){
 
$this->load->view('user_profile.php');
 
}
public function user_logout(){
 
  $this->session->sess_destroy();
  redirect('user/login_view', 'refresh');
}
 
}
 
?>  
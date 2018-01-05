<?php
 
class User extends CI_Controller {
 
public function __construct(){
 
        parent::__construct();
  			$this->load->helper('url');
  	 		$this->load->model('user_model');
        $this->load->library('session');
        $this->load->library('form_validation');
}
 
public function index()
{
$this->load->view("login.php");
}
 
public function registration(){
  $this->load->view('register.php');
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
 
  $this->session->set_flashdata('error_msg', 'Error! Username has already been taken.');
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
 
public function changepass(){
 
$this->load->view("changepassword");
} 

public function updatePwd(){
    $this->form_validation->set_rules('password', 'Current Password', 'required|alpha_numeric');
    $this->form_validation->set_rules('newpass', 'New Password', 'required|alpha_numeric');
    $this->form_validation->set_rules('confpassword', 'Password Confirmation', 'required|alpha_numeric');
    if($this->form_validation->run()){
        $curr_password = md5($this->input->post('password')); 
        $new_password = md5($this->input->post('newpass')); 
        $conf_password = md5($this->input->post('confpassword'));
        $this->load->model('user_model'); 
        $userid= $this->session->userdata('id');
        $passwd = $this->user_model->getCurrPassword($userid);
        if($passwd->password == $curr_password){
          if($new_password == $conf_password){
            if($this->user_model->updatePassword($new_password,$userid)){
              $this->load->view("user_profile.php");              
            }
            else{
              $this->session->set_flashdata('error_msg', 'Failed to update password.');
              
            }
          }
          else{
              $this->session->set_flashdata('error_msg', 'New Password & Confirm Password dont match.');
                                  
            }
        }
        else{
              $this->session->set_flashdata('error_msg', 'Sorry! Current Password dont match.');
                                 
        }
      }
   
     $this->load->view("changepassword");  
}

  public function helloworld(){
    $this->load->view("helloworld");
  }

  public function user_action(){
  
    if($_POST["action"] == "Create")
    {
      $insert_data = array(
        'subject' => $_POST['psubject'],
        'description' => $_POST['pdescription'],
        'user_id' =>  $this->session->userdata('id'),
      );
      $this->load->model('user_model');
      $this->user_model->insert_course($insert_data);
      echo 'Data Inserted';
    }

      
  }


}
   
?>  
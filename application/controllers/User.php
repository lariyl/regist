<?php
 
class User extends CI_Controller {
 
public function __construct(){
 
        parent::__construct();
  			$this->load->helper('url');
  	 		$this->load->model('user_model');
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->library('csvimport');

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
    redirect('user/admin_view');
  }
  else{
    $this->session->set_flashdata('error_msg', 'Error! Username has already been taken.');
    redirect('user');
  }
 }
 
public function login_view(){
  $this->load->view("login.php");
  }

public function admin_view(){
      $data["fetch_data"] = $this->user_model->fetch_data();
      $this->load->view("admin.php", $data);
}
public function delete_data(){
    $id = $this->uri->segment(3);
    $this->load->model("user_model");
    $this->user_model->delete_data($id);
    redirect(base_url() . "user/deleted");
  }

public function deleted(){
    $this->admin_view();
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

        $this->user_profile();
 
      }
      else{
        $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
        $this->load->view("login.php");
 
      }
 }
 
public function user_profile(){
  
  $this->db->select('*');
  $this->db->from('courses');
  // $this->db->where('user_id',$this->session->userdata('id'));

  $query = $this->db->get();

  $data['list_course'] = $query->result();

  $this->load->view('user_profile.php',$data);
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
             $this->user_profile();          
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

  public function formfour(){
    $this->load->view("formfour");
  }

  public function user_action(){
  
    if($_POST["action"] == "Create")
    {
      $insert_data = array(
        'subject' => $_POST['psubject'],
        'description' => $_POST['pdescription'],
        // 'user_id' =>  $this->session->userdata('id'),
      );
      $this->load->model('user_model');
      $result['id'] = $this->user_model->insert_course($insert_data);
      $result['subject'] = $_POST['psubject'];

      echo json_encode($result);
    }     
  }

  function load_data()
  {
    $result = $this->user_model->select();
    $output = '
      <div class="w3-responsive table">
        <table class="w3-table-all">
          <tr class="w3-cyan">
            <th>Student Name</th>
            <th>Pre-Mid</th>
            <th>Midterm</th>
            <th>Pre-Fi</th>
            <th>Finals</th>
            <th>Final Grade</th>
          </tr>

    ';
    $count = 0;
    if($result->num_rows() > 0)
    {
      foreach($result->result() as $row)
      {
        $count = $count + 1;
        $output .= '
        <tr>
          <td>'.$count.'</td>
          <td>'.$row->name.'</td>
        </tr>
        ';
      }
    }
    else
    {
      $output .= '
      <tr>
          <td colspan="5" align="center">Data not Available</td>
        </tr>
      ';
    }
    $output .= '</table></div>';
    echo $output;
  }

  function import()
  {
    $file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
    foreach($file_data as $row)
    {
      $data[] = array(
        'name'  =>  $row["Student Name"],
      );
    }
    $this->user_model->insert($data);
  }

  
  
}   
?>  
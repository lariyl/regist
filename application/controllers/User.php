<?php
 
class User extends CI_Controller
{
 
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');    
    $this->load->helper('Tools');
    $this->load->model('user_model');
    $this->load->library('session');
    $this->load->library('form_validation');
    $this->load->library('csvimport');
  }
  public function index()
  {
    $this->db->select('*');
    $this->db->from('courses');
    //$this->db->where('user_id',$this->session->userdata('id'));

    $query = $this->db->get();

    $data['list_course'] = $query->result();

    $this->load->view("user/index.php",$data);
  }

  // public function changePass()
  // {
  //   $this->load->view("ChangePassword");
  //  }

  // public function updatePwd()
  // {
  //   $this->form_validation->set_rules('password', 'Current Password', 'required|alpha_numeric');
  //   $this->form_validation->set_rules('newpass', 'New Password', 'required|alpha_numeric');
  //   $this->form_validation->set_rules('confpassword', 'Password Confirmation', 'required|alpha_numeric');
  //   if($this->form_validation->run())
  //   {
  //     $curr_password = md5($this->input->post('password'));
  //     $new_password = md5($this->input->post('newpass'));
  //     $conf_password = md5($this->input->post('confpassword'));
  //     $this->load->model('user_model');
  //     $userid= $this->session->userdata('id');
  //     $passwd = $this->user_model->getCurrPassword($userid);

  //     if($passwd->password == $curr_password)
  //     {
  //       if($new_password == $conf_password)
  //       {
  //         if($this->user_model->updatePassword($new_password,$userid))
  //         {
  //           $this->user_profile();
  //         }
  //         else
  //         {
  //           $this->session->set_flashdata('error_msg', 'Failed to update password.');
  //         }
  //       }
  //       else
  //       {
  //         $this->session->set_flashdata('error_msg', 'New Password & Confirm Password dont match.');
  //       }
  //     }
  //     else
  //     {
  //       $this->session->set_flashdata('error_msg', 'Sorry! Current Password dont match.');
  //     }
  //   }

  //   $this->load->view("changepassword");
  // }

  public function formfour()
  {
    $this->load->view("formfour");
  }

  public function user_action()
  {
    if($_POST["action"] == "Create")
    {
      $insert_data = array(
      'subject' => $_POST['psubject'],
      'description' => $_POST['pdescription'],
      //        'user_id' =>  $this->session->userdata('id'),
      );
      $this->load->model('user_model');
      $result['id'] = $this->user_model->insert_course($insert_data);
      $result['subject'] = $_POST['psubject'];

      echo json_encode($result);
    }
  }


  // Test Functions as of Feb 10
  public function load_data()
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

  public function import()
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
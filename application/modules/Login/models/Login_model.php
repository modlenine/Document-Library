<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->db2 = $this->load->database('saleecolour', TRUE);
  }

  public function escape_string()
  {
    return mysqli_connect("localhost", "root", "1234", "saleecolour");
  }



  public function check_login()
  {
    $this->load->library('user_agent');
    // เข้ารหัส input

    $user = mysqli_real_escape_string($this->escape_string(), $_POST['username']);
    $pass = mysqli_real_escape_string($this->escape_string(), md5($_POST['password']));
    // If System go on Please add md5 to element name password 'md5'


    $checkuser = $this->db2->query(sprintf(
      "SELECT * FROM member WHERE username = '%s' and password = '%s'  ",
      $user,
      $pass
    ));

    $checkdata = $checkuser->num_rows();

    if ($checkdata == 0) {
      echo $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">Username or Password is Wrong</div>');
      redirect('login');
      die();
    } else {


      foreach ($checkuser->result_array() as $r) {
        $_SESSION['username'] = $r['username'];
        $_SESSION['password'] = $r['password'];
        $_SESSION['Fname'] = $r['Fname'];
        $_SESSION['Lname'] = $r['Lname'];
        $_SESSION['Dept'] = $r['Dept'];
        $_SESSION['ecode'] = $r['ecode'];
        $_SESSION['DeptCode'] = $r['DeptCode'];
        $_SESSION['memberemail'] = $r['memberemail'];



        // insert login log
        // $logindata = array(
        //   "dcuser_loginusername" => $r['username'],
        //   "dcuser_logindatetime" => date("Y-m-d H:i:s"),
        //   "dcuser_loginstatus" => "login",
        //   "dcuser_browser" => $this->agent->browser(),
        //   "dcuser_browser_version" => $this->agent->version(),
        //   "dcuser_ip" => $this->input->ip_address(),
        //   "dcuser_os" => $this->agent->platform()
        // );
        // $this->db->insert("dc_userloginlog" , $logindata);
        loginlog($r['username']);


        $check = check_new_user($r['username']);
        if ($check < 1) {
          echo $this->session->set_flashdata('msg_succss', '<div class="alert alert-success" role="alert" style="font-size:15px;text-align: center;">Login Success</div>');
          header("refresh:0; url=" . base_url('login/verify_user/'));
        } else {

          $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe'] : '/dc2/document/';
          // กำหนดค่าให้กรณีที่ไม่ได้มีการกดเข้าไปหน้าใดๆก่อน
          //  header('location:'.$uri);
          header("refresh:0; url=" . $uri);
        }

        session_write_close();
      }
    }
  }



  public function call_login()
  { //*****Check Session******//

    if (isset($_SESSION['username']) == "") {


      $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];

      echo "<h1 style='text-align:center;margin-top:50px;'>กรุณา Login เข้าสู่ระบบ</h1>";
      header("refresh:1; url=" . base_url() . "login");
      die();
    }
  }





  public function check_permis()
  {
    $ses_username = $_SESSION['username'];
    $result = get_group($ses_username);
    $get_data = $result->row();
    if ($get_data->dc_gp_permis_name == "user") {
      echo "<script>";
      echo "alert('หน้านี้สำหรับ admin เท่านั้น')";
      echo "</script>";
      header("refresh:0; url=" . base_url());
      die();
    }
  }


  public function check_pin($related_code, $doccode)
  {
    $result = $this->db->query("SELECT * FROM dc_related_dept_use 
    WHERE related_dept_doccode='$doccode' && related_dept_status='active' && related_dept_code='$related_code' ");

    if ($result->num_rows() == 0) {
      echo "<script>";
      echo "alert('คุณไม่ได้รับอนุญาตให้เข้าถึงไฟล์นี้')";
      echo "</script>";
      header("refresh:0; url=" . base_url());
      die();
    }
  }



  public function logout()
  {
    session_destroy();
    $this->session->unset_userdata('referrer_url');
    header("refresh:0; url=" . base_url() . "login");
  }

  public function getuser()
  {
    $result = $this->db2->query("SELECT * FROM member WHERE username = '" . $_SESSION['username'] . "' ");
    return $result->row();
  }


  public function save_verify_user()
  {

    $ar_verify = array(
      "dc_user_username" => $this->input->post("dc_user_username"),
      "dc_user_password" => $this->input->post("dc_user_password"),
      "dc_user_Fname" => $this->input->post("dc_user_Fname"),
      "dc_user_Lname" => $this->input->post("dc_user_Lname"),
      "dc_user_Dept" => $this->input->post("dc_user_Dept"),
      "dc_user_ecode" => $this->input->post("dc_user_ecode"),
      "dc_user_DeptCode" => $this->input->post("dc_user_DeptCode"),
      "dc_user_memberemail" => $this->input->post("dc_user_memberemail"),
      "dc_user_data_user" => $this->input->post("conUsername"),
      "dc_user_group" => 0,
      "dc_user_status" => "active",
      "dc_user_new_dept_code" => $this->input->post("verify_dept")
    );
    $saveing = $this->db->insert('dc_user', $ar_verify);
    if (!$saveing) {
      echo "<script>";
      echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
      echo "window.history.back(-1)";
      echo "</script>";
      exit();
    } else {
      echo "<script>";
      echo "alert('บันทึกข้อมูลสำเร็จ')";
      echo "</script>";
      header("refresh:0; url=" . base_url());
    }
  }
}

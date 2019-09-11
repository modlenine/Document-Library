<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->db2 = $this->load->database('saleecolour',TRUE);
  }

  public function escape_string() {
      return mysqli_connect("localhost", "root", "1234", "saleecolour");
  }


  public function check_login(){
// เข้ารหัส input
      $username = mysqli_escape_string($this->escape_string(), isset($_POST['username']) ? ($_POST['username']) : '');
      $password = mysqli_escape_string($this->escape_string(), isset($_POST['password']) ? ($_POST['password']) : '');

      $user = mysqli_real_escape_string($this->escape_string() , $_POST['username']);
      $pass = mysqli_real_escape_string($this->escape_string() , ($_POST['password']));
      // If System go on Please add md5 to element name password 'md5'


      $checkuser = $this->db2->query(sprintf("SELECT * FROM member WHERE username = '%s' and password = '%s'  ", $user, $pass
      ));

      $checkdata = $checkuser->num_rows();

      if ($checkdata == 0) {
          echo '<script language="javascript">';
          echo 'alert("Username หรือ Password ไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง")';
          echo '</script>';

          header("refresh:0; url=".base_url()."login_page");
          die();
      } else {
          echo "<script>";
          echo "alert('เข้าสู่ระบบสำเร็จ กำลังพาท่านเข้าสู่โปรแกรม')";
          echo "</script>";

          foreach ($checkuser->result_array() as $r) {
              $_SESSION['username'] = $r['username'];
              $_SESSION['password'] = $r['password'];
              $_SESSION['Fname'] = $r['Fname'];
              $_SESSION['Lname'] = $r['Lname'];
              $_SESSION['Dept'] = $r['Dept'];
              $_SESSION['ecode'] = $r['ecode'];
              $_SESSION['DeptCode'] = $r['DeptCode'];
              $_SESSION['memberemail'] = $r['memberemail'];


              session_write_close();

              $check = check_new_user($r['username']);
              if($check < 1){
                // $ar_adduser = array(
                //   "dc_user_username" => $r['username'],
                //   "dc_user_password" => $r['password'],
                //   "dc_user_Fname" => $r['Fname'],
                //   "dc_user_Lname" => $r['Lname'],
                //   "dc_user_Dept" => $r['Dept'],
                //   "dc_user_ecode" => $r['ecode'],
                //   "dc_user_DeptCode" => $r['DeptCode'],
                //   "dc_user_memberemail" => $r['memberemail'],
                //   "dc_user_group" => 0
                // );
                // $result = $this->db->insert("dc_user",$ar_adduser);

                header("refresh:0; url=".base_url('login/verify_user/'));
                




                // $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/dc2/document/';
                //    // กำหนดค่าให้กรณีที่ไม่ได้มีการกดเข้าไปหน้าใดๆก่อน
                //   //  header('location:'.$uri);
                //    header("refresh:0; url=".$uri);
              }else{
                $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/dc2/document/';
                   // กำหนดค่าให้กรณีที่ไม่ได้มีการกดเข้าไปหน้าใดๆก่อน
                  //  header('location:'.$uri);
                   header("refresh:0; url=".$uri);
                
              }

              //   if($r['posi']==75){
              //     //  echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : Admin" . "</h3>";
              //      $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/dc2/document/';
              //      // กำหนดค่าให้กรณีที่ไม่ได้มีการกดเข้าไปหน้าใดๆก่อน
              //     //  header('location:'.$uri);
              //      header("refresh:0; url=".$uri);
              // }else{
              //   // echo "<h3 style='color:green;text-align:center;'>" . "Welcome &nbsp;" . $r['Fname'] . "&nbsp;Permission : User" . "</h3>";
              //     $uri = isset($_SESSION['RedirectKe']) ? $_SESSION['RedirectKe']: '/dc2/document/';
              //     // header('location:'.$uri);
              //     header("refresh:0; url=".$uri);
              // }

              


          }


      }
  }



  public function call_login() {//*****Check Session******//
      if (isset($_SESSION['username']) == "") {

          $_SESSION['RedirectKe'] = $_SERVER['REQUEST_URI'];

          echo "<h1 style='text-align:center;margin-top:50px;'>กรุณา Login เข้าสู่ระบบ</h1>";
          header("refresh:1; url=".base_url()."login_page");
          die();
      }
  }

  public function check_permis()
  {
    $ses_username = $_SESSION['username'];
    $result = get_group($ses_username);
    $get_data = $result->row();
    if($get_data->dc_gp_permis_name == "user"){
      echo "<script>";
      echo "alert('หน้านี้สำหรับ admin เท่านั้น')";
      echo "</script>";
      header("refresh:1; url=".base_url());
      die();
    }
  }



  public function logout(){
      session_destroy();
      $this->session->unset_userdata('referrer_url');
      header("refresh:0; url=".base_url()."login_page");
  }

  public function getuser(){
    $result = $this->db2->query("SELECT * FROM member WHERE username = '".$_SESSION['username']."' ");
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
      "dc_user_group" => 0,
      "dc_user_status" => "active",
      "dc_user_new_dept_code" => $this->input->post("verify_dept")
    );
    $saveing = $this->db->insert('dc_user',$ar_verify);
    if(!$saveing){
      echo "<script>";
      echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
      echo "window.history.back(-1)";
      echo "</script>";
      exit();
    }else{
      echo "<script>";
      echo "alert('บันทึกข้อมูลสำเร็จ')";
      echo "</script>";
      header("refresh:0; url=".base_url());
    }


  }





}

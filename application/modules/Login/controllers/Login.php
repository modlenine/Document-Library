<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MX_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model('login_model');
    $this->load->model("document/doc_get_model");

  }

  public function index()
  {
    if (isset($_SESSION['username']) == "") {
      $this->load->view("index");
    }else{
      header("refresh:0; url=".base_url()."document/");
    }
    

  }


  public function validate_login()
  {
    $username = $this->input->post('username',true);
    $password = ($this->input->post('password',true));
    $validate = $this->login_model->validate($username,$password);

    if($validate > 0)
    {

    }else{
      echo $this->session->set_flashdata('msg','<div class="alert alert-danger" role="alert" style="font-size:15px;text-align: center;">Username or Password is Wrong</div>');
        redirect('login');
    }

  }


  public function check_login(){
    $this->login_model->check_login();
  }

  public function logout(){
    $this->login_model->logout();
  }


  public function verify_user()
  {
    $data['verify_user'] = $this->login_model->getuser();

    $this->load->view('template/tp_headcode');
    get_contents('verify_user',$data);
    get_footer();
  }

  public function save_verify_user()
  {
    $this->login_model->save_verify_user();

  }


}

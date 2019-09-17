<?php
class mylogin {
    public $ci;
    function __construct(){
        $this->ci=& get_instance();
        
    }

    public function get_ci()
    {
        return $this->ci;
    }
}





function check_new_user($username)
{
    $obj = new mylogin();

    $query_check = $obj->get_ci()->db->query("SELECT * FROM dc_user WHERE dc_user_username= '$username' ");
    $checknum = $query_check->num_rows();
    return $checknum;
}


function verify_user()
{
    $obj = new mylogin();
    $obj->get_ci()->load->view("login/verify_user");
}

function get_newuser($username)
{
    $obj = new mylogin();
    $result = $obj->get_ci()->db->query("SELECT * FROM dc_user WHERE dc_user_username='$username' ");
    return $result->row();
}

function get_dept_byuser($user_deptcode)
{
    $obj = new mylogin();
    $result = $obj->get_ci()->db->query("SELECT * FROM dc_dept_main WHERE dc_dept_code='$user_deptcode' ");
    return $result->row();
}





?>
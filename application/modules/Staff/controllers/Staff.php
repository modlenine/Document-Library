<?php
class Staff extends MX_Controller{
    
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->lang->load("english");
        $this->load->model("login/login_model");
        $this->load->model("document/doc_get_model");
        $this->load->model("staff/get_staff_model");
        $this->load->model("staff/add_staff_model");
    }

    public function index()
    {
        check_login();
        check_permis();
        $data['get_doc_list'] = $this->get_staff_model->get_doc_list();
        get_head();
        get_contents("index",$data);
        get_footer();
        
    }


    public function gl()
    {
        check_login();
        check_permis();
        $data['get_doc_list'] = $this->get_staff_model->get_doc_list();
        get_head();
        get_contents("gl",$data);
        get_footer();
    }

    
    public function view_full_data($doccode)
    {
        check_login();
        check_permis();
        $data['view_full_data'] = $this->get_staff_model->view_full_data($doccode);

        get_head();
        get_contents("view_full_data",$data);
        get_footer();
    }


    public function manage_dept()
    {
        check_login();
        check_permis();
        $data['get_dept'] = $this->get_staff_model->get_dept();

        get_head();
        get_contents("manage_dept",$data);
        get_footer();
    }


public function save_dept()
{
    check_login();
    check_permis();
    $this->get_staff_model->save_dept();
}



public function del_dept($gl_dept_id)
{
    check_login();
    check_permis();
    $result = get_del("gl_dept_id",$gl_dept_id,"gl_department");
    if(!$result)
        {
            echo "<script>";
            echo "alert('ลบข้อมูลไม่สำเร็จ')";
            echo "window.history.back(-1)";
            echo "</script>";
        }
        else{
            echo "<script>";
            echo "alert('ลบข้อมูลสำเร็จ')";
            echo "</script>";
            header("refresh:0; url=".base_url('staff/manage_dept'));
        }
}



public function select_dept($gl_dept_id)
{
    check_login();
    check_permis();
    $data['select_dept'] = $this->get_staff_model->select_dept($gl_dept_id);
    $data['get_folder'] = $this->get_staff_model->get_folder($gl_dept_id);

    get_head();
    get_contents("select_dept",$data);
    get_footer();
}


public function save_folder()
{
    check_login();
    check_permis();
    $this->add_staff_model->save_folder();
}


public function del_folder($folder_id,$dept_id)
{
    check_login();
    check_permis();
    $result = get_del("gl_folder_id",$folder_id,"gl_folder");
    if(!$result)
        {
            echo "<script>";
            echo "alert('ลบข้อมูลไม่สำเร็จ')";
            echo "window.history.back(-1)";
            echo "</script>";
        }
        else{
            echo "<script>";
            echo "alert('ลบข้อมูลสำเร็จ')";
            echo "</script>";
            header("refresh:0; url=".base_url('staff/select_dept/').$dept_id);
        }
}



public function dept_update()
{
    check_login();
    check_permis();
    $this->add_staff_model->dept_update();
}


public function view_user()
{
    check_login();
    check_permis();
    $data['view_user'] = $this->get_staff_model->view_user();

    get_head();
    get_contents("user_list",$data);
    get_footer();
}


public function save_edit_group()
{
    $this->add_staff_model->save_edit_group();
}

public function save_edit_user()
{
    $this->add_staff_model->save_edit_user();
}

public function delete_user($userid)
{
    $this->add_staff_model->delete_user($userid);
}












    
}
// End Class
?>
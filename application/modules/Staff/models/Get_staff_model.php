<?php
class Get_staff_model extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }


    public function get_doc_list()
    {
        return $this->db->query("SELECT * FROM
            (SELECT MAX(dc_data_id) as dc_data_id_max , dc_data_doccode FROM dc_datamain GROUP BY dc_data_doccode)a
            INNER JOIN
            (SELECT * FROM dc_datamain)b ON a.dc_data_id_max = b.dc_data_id
            INNER JOIN
            (SELECT * FROM (SELECT MAX(lib_main_id) as lib_main_id_max  FROM library_main GROUP BY lib_main_doccode)c 
            INNER JOIN (SELECT * FROM library_main)d ON c.lib_main_id_max = d.lib_main_id)aa 
            ON a.dc_data_doccode = aa.lib_main_doccode");
    }

    
    public function view_full_data($doccode)
    {
        return $this->db->query("SELECT
            library_main.lib_main_id,
            library_main.lib_main_darcode,
            library_main.lib_main_doccode,
            library_main.lib_main_doccode_master,
            library_main.lib_main_doccode_copy,
            library_main.lib_main_file_location_master,
            library_main.lib_main_file_location_copy,
            library_main.lib_main_status,
            dc_datamain.dc_data_id,
            dc_datamain.dc_data_darcode,
            dc_datamain.dc_data_type,
            dc_datamain.dc_data_sub_type,
            dc_datamain.dc_data_sub_type_law,
            dc_datamain.dc_data_sub_type_sds,
            dc_datamain.dc_data_date_m,
            dc_datamain.dc_data_date,
            dc_datamain.dc_data_user,
            dc_datamain.dc_data_dept,
            dc_datamain.dc_data_docname,
            dc_datamain.dc_data_doccode_display,
            dc_datamain.dc_data_doccode,
            dc_datamain.dc_data_law_doccode,
            dc_datamain.dc_data_sds_doccode,
            dc_datamain.dc_data_edit,
            dc_datamain.dc_data_date_start,
            dc_datamain.dc_data_store,
            dc_datamain.dc_data_store_type,
            dc_datamain.dc_data_reson,
            dc_datamain.dc_data_reson_detail,
            dc_datamain.dc_data_file,
            dc_datamain.dc_data_file_location,
            dc_datamain.dc_data_status,
            dc_datamain.dc_data_result_reson_status,
            dc_datamain.dc_data_result_reson_detail,
            dc_datamain.dc_data_date_approve_mgr,
            dc_datamain.dc_data_approve_mgr,
            dc_datamain.dc_data_result_reson_status2,
            dc_datamain.dc_data_result_reson_detail2,
            dc_datamain.dc_data_date_approve_qmr,
            dc_datamain.dc_data_approve_qmr,
            dc_datamain.dc_data_method,
            dc_datamain.dc_data_operation,
            dc_datamain.dc_data_date_operation,
            dc_datamain.dc_data_old_dar,
            dc_datamain.dc_date_modify,
            dc_reason_request.dc_reason_name,
            dc_sub_type.dc_sub_type_name
            FROM
            library_main
            INNER JOIN dc_datamain ON dc_datamain.dc_data_darcode = library_main.lib_main_darcode
            INNER JOIN dc_reason_request ON dc_reason_request.dc_reason_code = dc_datamain.dc_data_reson
            INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
            WHERE lib_main_doccode = '$doccode' ORDER BY dc_data_edit DESC ");
    }

    public function save_dept()
    {
        if(isset($_POST['add_dept'])){
            $ar_dept =array(
                "gl_dept_code" => $this->input->post("gl_dept_code"),
                "gl_dept_name" => $this->input->post("gl_dept_name")
            );

            $result = $this->db->insert("gl_department",$ar_dept);
            if(!$result){
                echo "<script>";
                echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
                echo "</script>";
            }else{
                echo "<script>";
                echo "alert('บันทึกข้อมูลสำเร็จ')";
                echo "</script>";
                header("refresh:0; url=".base_url('staff/manage_dept'));
            }



        }
    }


    public function get_dept()
    {
        return $this->db->get("gl_department");
    }



    public function select_dept($gl_dept_id)
    {
        return $this->db->query("SELECT * FROM gl_department WHERE gl_dept_id='$gl_dept_id' ");
    }

    public function get_folder($gl_dept_id)
    {
        return $this->db->query("SELECT * FROM gl_folder WHERE gl_folder_dept_id='$gl_dept_id' ");
    }


    public function view_user()
    {
        return $this->db->query("SELECT
        dc_user.dc_user_id,
        dc_user.dc_user_username,
        dc_user.dc_user_password,
        dc_user.dc_user_Fname,
        dc_user.dc_user_Lname,
        dc_user.dc_user_Dept,
        dc_user.dc_user_ecode,
        dc_user.dc_user_DeptCode,
        dc_user.dc_user_memberemail,
        dc_user.dc_user_group,
        dc_user.dc_user_status,
        dc_group_permission.dc_gp_permis_name
        FROM
        dc_user
        INNER JOIN dc_group_permission ON dc_group_permission.dc_gp_permis_code = dc_user.dc_user_group
        ORDER BY dc_user_id DESC");
    }







    
}


?>
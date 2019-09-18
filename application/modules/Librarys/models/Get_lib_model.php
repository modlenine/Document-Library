<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Get_lib_model extends CI_Model {

public function __construct()
{
    parent::__construct();
    //Do your magic here
}

public function get_deptlib($newdeptcode)
{
    return $this->db->query("SELECT
    dc_related_dept.related_id,
    dc_related_dept.related_code,
    dc_related_dept.related_dept_code,
    dc_related_dept.related_dept_name
    FROM
    dc_related_dept
    WHERE related_code='$newdeptcode' ");
}


public function get_new_user()
{
    $result = $this->db->query("SELECT * FROM dc_user WHERE dc_user_username= '".$_SESSION['username']."' ");
    return $result->row();
}

public function get_doctype()
{
    return $this->db->get("dc_type");
}

public function get_sub_type()
{
    return $this->db->get("dc_sub_type");
}

public function get_file1($subtype,$related_code)
{
    return $this->db->query("SELECT
    library_main.lib_main_id,
    library_main.lib_main_doccode,
    library_main.lib_main_doccode_master,
    library_main.lib_main_doccode_copy,
    library_main.lib_main_file_location_master,
    library_main.lib_main_file_location_copy,
    dc_related_dept_use.related_dept_code,
    dc_related_dept.related_dept_name,
    dc_datamain.dc_data_sub_type,
    dc_datamain.dc_data_sub_type_law,
    dc_datamain.dc_data_sub_type_sds,
    dc_sub_type.dc_sub_type_name,
    dc_datamain.dc_data_docname,
    dc_datamain.dc_data_date,
    dc_datamain.dc_data_doccode,
    dc_datamain.dc_data_darcode,
    dc_datamain.dc_data_doccode_display,
    dc_datamain.dc_data_edit,
    library_main.lib_main_status,
    library_main.lib_main_modify_status
    FROM
        library_main
        INNER JOIN dc_related_dept_use ON dc_related_dept_use.related_dept_doccode = library_main.lib_main_doccode
        INNER JOIN dc_related_dept ON dc_related_dept.related_code = dc_related_dept_use.related_dept_code
        INNER JOIN dc_datamain ON dc_datamain.dc_data_darcode = library_main.lib_main_darcode
        INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
    WHERE dc_data_sub_type='$subtype' AND dc_related_dept_use.related_dept_code='$related_code' AND lib_main_status = 'active'
    GROUP BY lib_main_doccode DESC
    ");
}


public function get_file2($subtype,$doccode)
{
    return $this->db->query("SELECT
    library_main.lib_main_id,
    library_main.lib_main_doccode,
    library_main.lib_main_doccode_master,
    library_main.lib_main_doccode_copy,
    library_main.lib_main_file_location_master,
    library_main.lib_main_file_location_copy,
    library_main.lib_main_status,
    library_main.lib_main_modify_status,
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
    dc_sub_type.dc_sub_type_name
    FROM
    library_main
    INNER JOIN dc_datamain ON dc_datamain.dc_data_darcode = library_main.lib_main_darcode
    INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
    WHERE dc_data_sub_type='$subtype' AND dc_data_doccode='$doccode' ORDER BY dc_data_edit DESC
    ");
}



//For Loop
public function get_doc_type($subtype,$related_code)
{
    return $this->db->query("SELECT
    library_main.lib_main_id,
    library_main.lib_main_doccode,
    dc_type.dc_type_name,
    dc_type.dc_type_code
    FROM
    library_main
    INNER JOIN dc_related_dept_use ON dc_related_dept_use.related_dept_doccode = library_main.lib_main_doccode
    INNER JOIN dc_related_dept ON dc_related_dept.related_code = dc_related_dept_use.related_dept_code
    INNER JOIN dc_datamain ON dc_datamain.dc_data_doccode = library_main.lib_main_doccode
    INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
    INNER JOIN dc_type_use ON dc_type_use.dc_type_use_doccode = library_main.lib_main_doccode
    INNER JOIN dc_type ON dc_type.dc_type_code = dc_type_use.dc_type_use_code
    WHERE dc_data_sub_type='$subtype' AND dc_related_dept_use.related_dept_code='$related_code' 
    ");
}
//For Loop


public function get_dept_folder()
{
    return $this->db->get("gl_department");
}


public function count_gl_doc($folder_number,$dept_code)
{
    $query = $this->db->query("SELECT
    gl_document.gl_doc_id
    FROM
    gl_document
    WHERE gl_doc_folder_number='$folder_number' AND gl_doc_deptcode='$dept_code' AND gl_doc_approve_status=1 ");
    $count_sum = $query->num_rows();
    return $count_sum;
}


public function view_gl_document($deptcode,$folder_number)
{
    return $this->db->query("SELECT
    gl_document.gl_doc_id,
    gl_document.gl_doc_date_request,
    gl_document.gl_doc_username,
    gl_document.gl_doc_ecode,
    gl_document.gl_doc_deptcode,
    gl_document.gl_doc_deptname,
    gl_document.gl_doc_name,
    gl_document.gl_doc_code,
    gl_document.gl_doc_folder_number,
    gl_document.gl_doc_detail,
    gl_document.gl_doc_file,
    gl_document.gl_doc_file_location,
    gl_document.gl_doc_approve_status,
    gl_document.gl_doc_reson_detail,
    gl_document.gl_doc_approve_by,
    gl_document.gl_doc_status
    FROM
    gl_document
    WHERE gl_doc_deptcode='$deptcode' AND gl_doc_folder_number='$folder_number' AND gl_doc_approve_status=1 ORDER BY gl_doc_id DESC");
}


public function get_foldername_deptname($deptcode,$folder_number)
{
    return $this->db->query("SELECT
    gl_folder.gl_folder_id,
    gl_folder.gl_folder_number,
    gl_folder.gl_folder_name,
    gl_folder.gl_folder_dept_id,
    gl_folder.gl_folder_dept_code,
    gl_department.gl_dept_name
    FROM
    gl_folder
    INNER JOIN gl_department ON gl_department.gl_dept_code = gl_folder.gl_folder_dept_code
    WHERE gl_folder_dept_code='$deptcode' AND gl_folder_number='$folder_number' ");
}


public function viewfull_gl_document($deptcode,$folder_number,$gl_doccode)
{
    return $this->db->query("SELECT
    gl_document.gl_doc_id,
    gl_document.gl_doc_date_request,
    gl_document.gl_doc_username,
    gl_document.gl_doc_ecode,
    gl_document.gl_doc_deptcode,
    gl_document.gl_doc_deptname,
    gl_document.gl_doc_name,
    gl_document.gl_doc_code,
    gl_document.gl_doc_folder_number,
    gl_document.gl_doc_detail,
    gl_document.gl_doc_file,
    gl_document.gl_doc_file_location,
    gl_document.gl_doc_approve_status,
    gl_document.gl_doc_reson_detail,
    gl_document.gl_doc_approve_by,
    gl_document.gl_doc_status
    FROM
    gl_document
    WHERE gl_doc_deptcode='$deptcode' AND gl_doc_folder_number='$folder_number' AND gl_doc_code='$gl_doccode' AND gl_doc_approve_status=1 ");
}


public function gl_card($deptcode,$folder_number,$gl_doccode)
{
    return $this->db->query("SELECT
    gl_document.gl_doc_id,
    gl_document.gl_doc_date_request,
    gl_document.gl_doc_username,
    gl_document.gl_doc_ecode,
    gl_document.gl_doc_deptcode,
    gl_document.gl_doc_deptname,
    gl_document.gl_doc_name,
    gl_document.gl_doc_code,
    gl_document.gl_doc_folder_number,
    gl_document.gl_doc_detail,
    gl_document.gl_doc_file,
    gl_document.gl_doc_file_location,
    gl_document.gl_doc_approve_status,
    gl_document.gl_doc_reson_detail,
    gl_document.gl_doc_approve_by,
    gl_document.gl_doc_status
    FROM
    gl_document
    WHERE gl_doc_deptcode='$deptcode' AND gl_doc_folder_number='$folder_number' AND gl_doc_code='$gl_doccode' AND gl_doc_approve_status=1 ");
}


public function search_hashtag()
{
    $tag = $this->input->post("gl_doc_hashtag");
    if(isset($_POST['btn_search_hashtag'])){
        $result = $this->db->query("SELECT * FROM gl_document WHERE gl_doc_hashtag LIKE '%$tag%' ");
        return $result;
    }
}





    

}

/* End of file ModelName.php */



?>
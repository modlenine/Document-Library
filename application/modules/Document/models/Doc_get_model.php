<?php
class Doc_get_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
    }


    public function get_doc_type()
    {
        return    $this->db->get("dc_type");
    }


    public function get_doc_sub_type()
    {
        return $this->db->get("dc_sub_type");
    }


    public function get_reason()
    {
        return $this->db->get("dc_reason_request");
    }


    public function get_dept()
    {
        return $this->db->get("dc_dept_main");
    }


    public function get_related_dept()
    {
        return $this->db->get("dc_related_dept");
    }


    public function get_law()
    {
        return $this->db->get("dc_law");
    }


    public function get_sds()
    {
        return $this->db->get("dc_sds");
    }

    public function get_short_dept($inputdept)
    {
        // Function get short department
        $get_shortdept = $this->db->query("select dc_dept_short_name from dc_dept_main where dc_dept_code='$inputdept' ");
        $result_shortdept = $get_shortdept->row();
        return $result_shortdept->dc_dept_short_name;
    }

    public function get_list()
    {
        return $this->db->query("SELECT
dc_datamain.dc_data_doccode,
dc_datamain.dc_data_doccode_display,
dc_datamain.dc_data_id,
dc_datamain.dc_data_law_doccode,
dc_datamain.dc_data_sds_doccode,
dc_datamain.dc_data_sub_type,
dc_datamain.dc_data_date,
dc_datamain.dc_data_user,
dc_datamain.dc_data_reson,
dc_datamain.dc_data_status,
dc_sub_type.dc_sub_type_name,
dc_reason_request.dc_reason_name,
dc_datamain.dc_data_darcode
FROM
dc_datamain
INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
INNER JOIN dc_reason_request ON dc_reason_request.dc_reason_code = dc_datamain.dc_data_reson order by dc_datamain.dc_data_id desc
");
    }


    public function get_list_gl()
    {
        return $this->db->query("SELECT * FROM gl_document ORDER BY gl_doc_id DESC");
    }



    public function get_fulldata($darcode)
    {
        return $this->db->query("SELECT
        dc_sub_type.dc_sub_type_name,
        dc_reason_request.dc_reason_name,
        dc_dept_main.dc_dept_main_name,
        dc_dept_main.dc_dept_main_code,
        dc_dept_main.dc_dept_short_name,
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
        dc_datamain.dc_data_doccode,
        dc_datamain.dc_data_doccode_display,
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
        dc_datamain.dc_data_old_dar
        FROM
        dc_datamain
        INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
        INNER JOIN dc_reason_request ON dc_reason_request.dc_reason_code = dc_datamain.dc_data_reson
        INNER JOIN dc_dept_main ON dc_dept_main.dc_dept_code = dc_datamain.dc_data_dept
        WHERE dc_datamain.dc_data_darcode = '$darcode'
        ");
    }


public function getfulldata_edit($doccode)
{
    return $this->db->query("SELECT
    dc_sub_type.dc_sub_type_name,
    dc_reason_request.dc_reason_name,
    dc_dept_main.dc_dept_main_name,
    dc_dept_main.dc_dept_main_code,
    dc_dept_main.dc_dept_short_name,
    dc_datamain.dc_data_id,
    dc_datamain.dc_data_darcode,
    dc_datamain.dc_data_type,
    dc_datamain.dc_data_sub_type,
    dc_datamain.dc_data_sub_type_law,
    dc_datamain.dc_data_sub_type_sds,
    dc_datamain.dc_data_date,
    dc_datamain.dc_data_user,
    dc_datamain.dc_data_dept,
    dc_datamain.dc_data_docname,
    dc_datamain.dc_data_doccode,
    dc_datamain.dc_data_doccode_display,
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
    dc_dept_main.dc_dept_code,
    library_main.lib_main_id,
    library_main.lib_main_darcode,
    library_main.lib_main_doccode,
    library_main.lib_main_doccode_master,
    library_main.lib_main_doccode_copy,
    library_main.lib_main_file_location_master,
    library_main.lib_main_file_location_copy
    FROM
    dc_datamain
    INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
    INNER JOIN dc_reason_request ON dc_reason_request.dc_reason_code = dc_datamain.dc_data_reson
    INNER JOIN dc_dept_main ON dc_dept_main.dc_dept_code = dc_datamain.dc_data_dept
    INNER JOIN library_main ON library_main.lib_main_darcode = dc_datamain.dc_data_darcode
WHERE dc_data_doccode = '$doccode' ORDER BY dc_data_id DESC LIMIT 1 ");
}


public function get_last_dar($doccode)
{
    return $this->db->query("SELECT
    dc_datamain.dc_data_darcode
    FROM
    dc_datamain
    WHERE dc_data_doccode = '$doccode' && dc_data_status = 'Complete' 
    ORDER BY dc_data_id DESC LIMIT 1");
}




    public function get_doctype_use($darcode)
    {
        $callDoccode = $this->get_fulldata($darcode);
        foreach($callDoccode->result_array() as $callDoccodes){
            $doccode = $callDoccodes['dc_data_doccode'];
        }
        $result = $this->db->query("SELECT
        dc_type_use.dc_type_use_doccode,
        dc_type_use.dc_type_use_code,
        dc_type.dc_type_name
        FROM
        dc_type_use
        INNER JOIN dc_type ON dc_type.dc_type_code = dc_type_use.dc_type_use_code
        WHERE dc_type_use.dc_type_use_doccode='$doccode'
        ");

        return $result;
    }


    public function get_related_use($darcode)
    {
        $callDoccode = $this->get_fulldata($darcode);
        foreach($callDoccode->result_array() as $callDoccodes){
            $doccode = $callDoccodes['dc_data_doccode'];
        }

        return $this->db->query("SELECT
        dc_related_dept.related_id,
        dc_related_dept.related_dept_name,
        dc_related_dept_use.related_dept_doccode,
        dc_related_dept_use.related_dept_darcode,
        dc_related_dept_use.related_dept_id,
        dc_related_dept_use.related_dept_code,
        dc_related_dept_use.related_dept_status
        FROM
        dc_related_dept
        INNER JOIN dc_related_dept_use ON dc_related_dept.related_code = dc_related_dept_use.related_dept_code
        WHERE related_dept_darcode='$darcode' ");
    }


    public function get_sds_use($darcode)
    {
        return $this->db->query("SELECT
        dc_datamain.dc_data_sub_type_sds,
        dc_sds.dc_sds_name,
        dc_sds.dc_sds_code
        FROM
        dc_datamain
        INNER JOIN dc_sds ON dc_sds.dc_sds_code = dc_datamain.dc_data_sub_type_sds
        WHERE dc_data_darcode = '$darcode' ");
    }


    public function get_law_use($darcode)
    {
        return $this->db->query("SELECT
        dc_datamain.dc_data_sub_type_law,
        dc_law.dc_law_name,
        dc_law.dc_law_code
        FROM
        dc_datamain
        INNER JOIN dc_law ON dc_law.dc_law_code = dc_datamain.dc_data_sub_type_law
        WHERE dc_data_darcode='$darcode' ");
    }





    // Check Zone 
    public function checkNull_add()
    {
        if (isset($_POST['btnUser_submit'])) {


            // เริ่มต้นการตรวจสอบค่าว่าง

            if ($this->input->post('dc_data_type') == "") {
                echo "<script>";
                echo "alert('กรุณาเลือกประเภทของเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_sub_type') == "") {
                echo "<script>";
                echo "alert('กรุณาเลือกหมวดหมู่ของเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_date') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุวันที่ร้องขอด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_user') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุชื่อผู้ร้องขอด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_dept') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุแผนกด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_docname') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุชื่อเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_docname') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุชื่อเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }
            // else if($this->input->post('dc_data_doccode') == "")
            // {
            //     echo "<script>";
            //     echo "alert('กรุณาระบุรหัสเอกสารด้วยค่ะ');";
            //     echo "window.history.back(-1)";
            //     echo "</script>";
            // }
            else if ($this->input->post('dc_data_date_start') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุวันที่เริ่มใช้เอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_store') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุวันที่จัดเก็บด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_store_type') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุระยะเวลาจัดเก็บด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_reson') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุเหตุผลด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_reson_detail') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุรายละเอียดของเหตุผลด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('related_dept_code') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุแผนกที่เกี่ยวข้องด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($_FILES['dc_data_file']['name'] == "") {
                echo "<script>";
                echo "alert('กรุณาแนบไฟล์เอกสารที่ต้องการดำเนินการด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('li_hashtag') == ""){
                echo "<script>";
                echo "alert('กรุณาระบุแฮชแท็กด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }else {
                echo "<script>";
                echo "alert('ข้อมูลถูกต้องครบถ้วน')";
                echo "</script>";
            }

            // เสร็จสิ้นขั้นตอนการตรวจสอบค่าว่าง

        } else {
            echo "ไม่มีการกดปุ่มมา";
        }
    }
    
    

    public function check_null_change()
    {
        if (isset($_POST['btnUser_submit'])) {


            // เริ่มต้นการตรวจสอบค่าว่าง

            if ($this->input->post('dc_data_type') == "") {
                echo "<script>";
                echo "alert('กรุณาเลือกประเภทของเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_sub_type') == "") {
                echo "<script>";
                echo "alert('กรุณาเลือกหมวดหมู่ของเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_date') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุวันที่ร้องขอด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_user') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุชื่อผู้ร้องขอด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_dept') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุแผนกด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_docname') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุชื่อเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_docname') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุชื่อเอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }else if ($this->input->post('dc_data_date_start') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุวันที่เริ่มใช้เอกสารด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_store') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุวันที่จัดเก็บด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_store_type') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุระยะเวลาจัดเก็บด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_reson') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุเหตุผลด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('dc_data_reson_detail') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุรายละเอียดของเหตุผลด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($this->input->post('related_dept_code') == "") {
                echo "<script>";
                echo "alert('กรุณาระบุแผนกที่เกี่ยวข้องด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            } else if ($_FILES['dc_data_file']['name'] == "") {
                echo "<script>";
                echo "alert('กรุณาแนบไฟล์เอกสารที่ต้องการดำเนินการด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }else {
                echo "<script>";
                echo "alert('ข้อมูลถูกต้องครบถ้วน')";
                echo "</script>";
            }

            // เสร็จสิ้นขั้นตอนการตรวจสอบค่าว่าง

        } else {
            echo "ไม่มีการกดปุ่มมา";
        }
    }


    
    public function check_manager_Zone()
    {
        if(isset($_POST['btnSave_sec2'])){
            if($this->input->post('dc_data_result_reson_status') == ""){
                echo "<script>";
                echo "alert('กรุณาระบุผลการอนุมัติด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }else if ($this->input->post('dc_data_result_reson_detail') == ""){
                echo "<script>";
                echo "alert('กรุณาระบุรายละเอียดผลการอนุมัติด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }
        }
    }


    public function check_qmr_Zone()
    {
        if(isset($_POST['btnSave_sec3'])){
            if($this->input->post('dc_data_result_reson_status2') == ""){
                echo "<script>";
                echo "alert('กรุณาระบุผลการอนุมัติด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }else if ($this->input->post('dc_data_result_reson_detail2') == ""){
                echo "<script>";
                echo "alert('กรุณาระบุรายละเอียดผลการอนุมัติด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }
        }
    }


    public function check_doc_Zone()
    {
        if(isset($_POST['btnOpsave'])){
            if($_FILES['document_master']['name'] == ""){
                echo "<script>";
                echo "alert('กรุณาอัพโหลดเอกสารต้นฉบับด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }else if($_FILES['document_copy']['name'] == ""){
                echo "<script>";
                echo "alert('กรุณาอัพโหลดเอกสารสำหรับแจกจ่ายด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }else if($this->input->post('dc_data_method') == ""){
                echo "<script>";
                echo "alert('กรุณาระบุรายละเอียดด้วยค่ะ');";
                echo "window.history.back(-1)";
                echo "</script>";
                exit();
            }
        }
    }
    
    
    
    
    
    
    
    
    // Check Zone 



    public function get_dar_code()
    {
        $query = $this->db->query("SELECT dc_data_darcode FROM dc_datamain");
        $numrow = $query->num_rows();
        $yearCur = date("Y");
        $cutYearCur = substr($yearCur,2,2);
        $monthCur = date("m");
        
        if($numrow  == 0)
        {
            $rs_darcode = "DAR".$cutYearCur.$monthCur."001";
        }else{
            $getDarCode = $this->db->query("SELECT dc_data_darcode , SUBSTR(dc_data_darcode,8) as cutdarcode FROM dc_datamain ORDER BY SUBSTR(dc_data_darcode,3) DESC LIMIT 1");
            foreach($getDarCode->result_array() as $getDarCodes){
                $resultDarCode = $getDarCodes['cutdarcode'];
            }
            $resultDarCode++;
            if($resultDarCode < 10){
                $rs_darcode = "DAR".$cutYearCur.$monthCur."00".$resultDarCode;
            }else if ($resultDarCode >= 10 && $resultDarCode < 100){
                $rs_darcode = "DAR".$cutYearCur.$monthCur."0".$resultDarCode;
            }else{
                $rs_darcode = "DAR".$cutYearCur.$monthCur.$resultDarCode;
            }
            
            
        }
        return $rs_darcode;
    }



    // Get Document Code
    public function get_doc_code()
    {
        $short_dept = $this->input->post('dc_data_dept');

        if ($this->input->post('dc_data_sub_type') == 's') {
            // Get short dept
            $rs_short_dept  = $this->get_short_dept($short_dept);
            $date_requests = con_date($this->input->post("dc_data_date"));
            $date_request = str_replace("/", "-", $date_requests);


            $s_query = $this->db->query("SELECT dc_data_doccode from dc_datamain where dc_data_doccode like '%$rs_short_dept-S%' ");
            $num_s = $s_query->num_rows();
            if ($num_s == 0) {
                $sfull_code = $rs_short_dept . "-S-001-00-" . $date_request;
                return $sfull_code;
            } else {

                $s_query_get = $this->db->query("SELECT dc_data_doccode, SUBSTR(dc_data_doccode,6,3)AS cutdc_data_sub_type from dc_datamain where dc_data_doccode like '%$rs_short_dept-S%' ORDER BY dc_data_doccode DESC LIMIT 1");
                foreach ($s_query_get->result_array() as $s_querys) {
                    $rs_s_code = $s_querys['cutdc_data_sub_type'];
                }
                $rs_s_code++;

                if ($rs_s_code < 10) {
                    $rs_s_codes = "00" . $rs_s_code;
                } else if ($rs_s_code >= 10 && $rs_s_code < 100) {
                    $rs_s_codes = "0" . $rs_s_code;
                } else {
                    $rs_s_codes = $rs_s_code;
                }
                $rs_s_fullcode = $rs_short_dept . "-S-" . $rs_s_codes . "-00-" . $date_request;


                $reson_doc = $this->input->post("dc_data_reson");
                if ($reson_doc != "r-04" && $reson_doc != "r-02") {
                    return $rs_s_fullcode;
                } else {
                    $dc_data_edit = $this->input->post("dc_data_edit");
                    if ($dc_data_edit < 10) {
                        $dc_data_edits = "0" . $dc_data_edit;
                    } else {
                        $dc_data_edits = $dc_data_edit;
                    }

                    $rs_s_fullcode = $rs_short_dept . "-F-" . $rs_s_codes . "-$dc_data_edits-" . $date_request;
                    return $rs_s_fullcode;
                }
            }
        } else if ($this->input->post('dc_data_sub_type') == 'f') {
            // Get short dept
            $rs_short_dept  = $this->get_short_dept($short_dept);
            $date_requests = con_date($this->input->post("dc_data_date"));
            $date_request = str_replace("/", "-", $date_requests);


            $f_query = $this->db->query("SELECT dc_data_doccode from dc_datamain where dc_data_doccode like '%$rs_short_dept-F%' ");
            $num_f = $f_query->num_rows();
            if ($num_f == 0) {
                $ffull_code = $rs_short_dept . "-F-001-00-" . $date_request;
                return $ffull_code;
            } else {

                $f_query_get = $this->db->query("SELECT dc_data_doccode, SUBSTR(dc_data_doccode,6,3)AS cutdc_data_sub_type from dc_datamain where dc_data_doccode like '%$rs_short_dept-F%' ORDER BY dc_data_doccode DESC LIMIT 1");
                foreach ($f_query_get->result_array() as $f_querys) {
                    $rs_f_code = $f_querys['cutdc_data_sub_type'];
                }
                $rs_f_code++;

                if ($rs_f_code < 10) {
                    $rs_f_codes = "00" . $rs_f_code;
                } else if ($rs_f_code >= 10 && $rs_f_code < 100) {
                    $rs_f_codes = "0" . $rs_f_code;
                } else {
                    $rs_f_codes = $rs_f_code;
                }
                $rs_f_fullcode = $rs_short_dept . "-F-" . $rs_f_codes . "-00-" . $date_request;


                $reson_doc = $this->input->post("dc_data_reson");
                if ($reson_doc != "r-04" && $reson_doc != "r-02") {
                    return $rs_f_fullcode;
                } else {
                    $dc_data_edit = $this->input->post("dc_data_edit");
                    if ($dc_data_edit < 10) {
                        $dc_data_edits = "0" . $dc_data_edit;
                    } else {
                        $dc_data_edits = $dc_data_edit;
                    }

                    $rs_f_fullcode = $rs_short_dept . "-F-" . $rs_f_codes . "-$dc_data_edits-" . $date_request;
                    return $rs_f_fullcode;
                }
            }
        } else if ($this->input->post('dc_data_sub_type') == 'x') {
            // Get short dept
            $rs_short_dept  = $this->get_short_dept($short_dept);
            $date_requests = con_date($this->input->post("dc_data_date"));
            $date_request = str_replace("/", "-", $date_requests);


            $x_query = $this->db->query("SELECT dc_data_doccode from dc_datamain where dc_data_doccode like '%$rs_short_dept-X%' ");
            $num_x = $x_query->num_rows();
            if ($num_x == 0) {
                $xfull_code = $rs_short_dept . "-X-001-00-" . $date_request;
                return $xfull_code;
            } else {

                $x_query_get = $this->db->query("SELECT dc_data_doccode, SUBSTR(dc_data_doccode,6,3)AS cutdc_data_sub_type from dc_datamain where dc_data_doccode like '%$rs_short_dept-X%' ORDER BY dc_data_doccode DESC LIMIT 1");
                foreach ($x_query_get->result_array() as $x_querys) {
                    $rs_x_code = $x_querys['cutdc_data_sub_type'];
                }
                $rs_x_code++;

                if ($rs_x_code < 10) {
                    $rs_x_codes = "00" . $rs_x_code;
                } else if ($rs_x_code >= 10 && $rs_x_code < 100) {
                    $rs_x_codes = "0" . $rs_x_code;
                } else {
                    $rs_x_codes = $rs_x_code;
                }
                $rs_x_fullcode = $rs_short_dept . "-X-" . $rs_x_codes . "-00-" . $date_request;


                $reson_doc = $this->input->post("dc_data_reson");
                if ($reson_doc != "r-04" && $reson_doc != "r-02") {
                    return $rs_x_fullcode;
                } else {
                    $dc_data_edit = $this->input->post("dc_data_edit");
                    if ($dc_data_edit < 10) {
                        $dc_data_edits = "0" . $dc_data_edit;
                    } else {
                        $dc_data_edits = $dc_data_edit;
                    }

                    $rs_x_fullcode = $rs_short_dept . "-X-" . $rs_x_codes . "-$dc_data_edits-" . $date_request;
                    return $rs_x_fullcode;
                }
            }
        } else if ($this->input->post('dc_data_sub_type') == 'm') {
            // Get short dept
            $rs_short_dept  = $this->get_short_dept($short_dept);

            $m_query = $this->db->query("SELECT dc_data_doccode from dc_datamain where dc_data_doccode like '%$rs_short_dept-M%' ");
            $num_m = $m_query->num_rows();
            if ($num_m == 0) {
                $mfull_code = $rs_short_dept . "-M-001";
                return $mfull_code;
            } else {
                $m_query_get = $this->db->query("SELECT dc_data_doccode, SUBSTR(dc_data_doccode,6)AS cutdc_data_sub_type from dc_datamain where dc_data_doccode like '%$rs_short_dept-M%' ORDER BY dc_data_doccode DESC LIMIT 1");
                foreach ($m_query_get->result_array() as $m_querys) {
                    $rs_m_code = $m_querys['cutdc_data_sub_type'];
                }
                $rs_m_code++;

                if ($rs_m_code < 10) {
                    $rs_m_codes = "00" . $rs_m_code;
                } else if ($rs_m_code >= 10 && $rs_m_code < 100) {
                    $rs_m_codes = "0" . $rs_m_code;
                } else {
                    $rs_m_codes = $rs_m_code;
                }
                $rs_m_fullcode = $rs_short_dept . "-M-" . $rs_m_codes;
                return $rs_m_fullcode;
            }
        } else if ($this->input->post('dc_data_sub_type') == 'p') {
            // Get short dept
            $rs_short_dept  = $this->get_short_dept($short_dept);

            $p_query = $this->db->query("SELECT dc_data_doccode from dc_datamain where dc_data_doccode like '%$rs_short_dept-P%' ");
            $num_p = $p_query->num_rows();
            if ($num_p == 0) {
                $pfull_code = $rs_short_dept . "-P-001";
                return $pfull_code;
            } else {
                $p_query_get = $this->db->query("SELECT dc_data_doccode, SUBSTR(dc_data_doccode,6)AS cutdc_data_sub_type from dc_datamain where dc_data_doccode like '%$rs_short_dept-P%' ORDER BY dc_data_doccode DESC LIMIT 1");
                foreach ($p_query_get->result_array() as $p_querys) {
                    $rs_p_code = $p_querys['cutdc_data_sub_type'];
                }
                $rs_p_code++;

                if ($rs_p_code < 10) {
                    $rs_p_codes = "00" . $rs_p_code;
                } else if ($rs_p_code >= 10 && $rs_p_code < 100) {
                    $rs_p_codes = "0" . $rs_p_code;
                } else {
                    $rs_p_codes = $rs_p_code;
                }
                $rs_p_fullcode = $rs_short_dept . "-P-" . $rs_p_codes;
                return $rs_p_fullcode;
            }
        } else if ($this->input->post('dc_data_sub_type') == 'w') {
            // Get short dept
            $rs_short_dept  = $this->get_short_dept($short_dept);

            $w_query = $this->db->query("SELECT dc_data_doccode from dc_datamain where dc_data_doccode like '%$rs_short_dept-W%' ");
            $num_w = $w_query->num_rows();
            if ($num_w == 0) {
                $wfull_code = $rs_short_dept . "-W-001";
                return $wfull_code;
            } else {
                $w_query_get = $this->db->query("SELECT dc_data_doccode, SUBSTR(dc_data_doccode,6)AS cutdc_data_sub_type from dc_datamain where dc_data_doccode like '%$rs_short_dept-W%' ORDER BY dc_data_doccode DESC LIMIT 1");
                foreach ($w_query_get->result_array() as $w_querys) {
                    $rs_w_code = $w_querys['cutdc_data_sub_type'];
                }
                $rs_w_code++;

                if ($rs_w_code < 10) {
                    $rs_w_codes = "00" . $rs_w_code;
                } else if ($rs_w_code >= 10 && $rs_w_code < 100) {
                    $rs_w_codes = "0" . $rs_w_code;
                } else {
                    $rs_w_codes = $rs_w_code;
                }
                $rs_w_fullcode = $rs_short_dept . "-W-" . $rs_w_codes;
                return $rs_w_fullcode;
            }
        } else if ($this->input->post('dc_data_sub_type') == 'l') {
            $lawcode = $this->input->post('get_law');
            if ($lawcode != "") {
                // Get short dept
                $rs_short_dept  = $this->get_short_dept($short_dept);


                // Check data on database
                $law_query = $this->db->query("SELECT dc_data_doccode from dc_datamain where dc_data_doccode like '%$rs_short_dept-L-$lawcode%' ");
                $law_numrow = $law_query->num_rows();

                if ($law_numrow == 0) {
                    $lawfull_code = $rs_short_dept . "-L-" . $lawcode . "-001";
                    return $lawfull_code;
                } else {
                    $law_query_get = $this->db->query("SELECT dc_data_doccode , SUBSTR(dc_data_doccode,11) AS cut_dc_data_sub_type_law FROM dc_datamain WHERE dc_data_doccode LIKE '%$rs_short_dept-L-$lawcode%' ORDER BY dc_data_doccode DESC LIMIT 1");
                    foreach ($law_query_get->result_array() as $rslaw) {
                        $rslaws = $rslaw['cut_dc_data_sub_type_law'];
                    }
                    $rslaws++;

                    if ($rslaws < 10) {
                        $law_num = "00" . $rslaws;
                    } else if ($rslaws >= 10 && $rslaws < 100) {
                        $law_num = "0" . $rslaws;
                    } else {
                        $law_num = $rslaws;
                    }
                    $lawfull_code = $rs_short_dept . "-L-" . $lawcode . "-" . $law_num;
                    return $lawfull_code;
                }
            }
        } else if ($this->input->post('dc_data_sub_type') == 'sds') //Choose Document type SDS
        {
            $sdscode = $this->input->post('get_sds');
            if ($sdscode != "") {
                $query = $this->db->query("SELECT dc_data_doccode FROM dc_datamain WHERE dc_data_doccode like '%$sdscode%' ");
                $numrows = $query->num_rows();
                if ($numrows == 0) {
                    $sds_code = $sdscode . "-001";
                    return $sds_code;
                } else {
                    $query2 = $this->db->query("SELECT SUBSTR(dc_data_doccode,8) AS SDS ,dc_data_doccode FROM dc_datamain WHERE dc_data_doccode like '%$sdscode%' ORDER BY SDS DESC LIMIT 1 ");
                    foreach ($query2->result_array() as $rs) {
                        $rununmber = $rs['SDS'];
                    }
                    $rununmber++;
                    if ($rununmber < 10) {
                        $num = "00" . $rununmber;
                    } else if ($rununmber >= 10 && $rununmber < 100) {
                        $num = "0" . $rununmber;
                    } else {
                        $num = $rununmber;
                    }
                    $sds_code =  $sdscode . "-" . $num;
                    return $sds_code;
                }
            }
        } //Choose Document type SDS
    }
    // Get Document Code



    public function convertName($Fname, $Lname)
    {
        $cutLname = substr($Lname, 0, 1);
        $sumname = $Fname . "_" . $cutLname;
        return $sumname;
    }


    public function get_doc_file($doccode)
    {
        $check_dataSubType = $this->db->query("SELECT
        dc_datamain.dc_data_sub_type,
        dc_datamain.dc_data_doccode
        FROM
        dc_datamain WHERE dc_data_doccode= '$doccode' ");
        $result_dataSubType = $check_dataSubType->row();

        // $result_dataSubType->dc_data_sub_type;

        if ($result_dataSubType->dc_data_sub_type == "m") {
            $fileurl = base_url('asset/document_files/integration_manual/');
        } else if ($result_dataSubType->dc_data_sub_type == "p") {
            $fileurl = base_url('asset/document_files/procedure/');
        } else if ($result_dataSubType->dc_data_sub_type == "w") {
            $fileurl = base_url('asset/document_files/work_instruction/');
        } else if ($result_dataSubType->dc_data_sub_type == "f") {
            $fileurl = base_url('asset/document_files/form/');
        } else if ($result_dataSubType->dc_data_sub_type == "s") {
            $fileurl = base_url('asset/document_files/support_document/');
        } else if ($result_dataSubType->dc_data_sub_type == "x") {
            $fileurl = base_url('asset/document_files/external_document/');
        } else if ($result_dataSubType->dc_data_sub_type == "l") {
            $fileurl = base_url('asset/document_files/law/');
        } else if ($result_dataSubType->dc_data_sub_type == "sds") {
            $fileurl = base_url('asset/document_files/sds/');
        }

        return $fileurl;
    }


    public function get_docready()
    {
        return $this->db->query("SELECT
        library_main.lib_main_id,
        library_main.lib_main_doccode,
        library_main.lib_main_file,
        library_main.lib_main_status,
        library_status.lib_status_id,
        library_status.lib_status_code,
        library_status.lib_status_name
        FROM
        library_main
        INNER JOIN library_status ON library_status.lib_status_code = library_main.lib_main_status
        WHERE lib_main_status='lib01' || lib_main_status='lib02' ");
    }

    public function get_docalready()
    {
        return $this->db->query("SELECT
        library_main.lib_main_id,
        library_main.lib_main_doccode,
        library_main.lib_main_file,
        library_main.lib_main_status,
        library_status.lib_status_id,
        library_status.lib_status_code,
        library_status.lib_status_name
        FROM
        library_main
        INNER JOIN library_status ON library_status.lib_status_code = library_main.lib_main_status
        WHERE lib_main_status='lib02' ");
    }


    public function get_master_file()
    {
        return $this->db->query("SELECT lib_master_doccode , lib_master_file_location FROM library_master_file");
    }


    public function get_copy_file()
    {
        return $this->db->query("SELECT lib_copy_doccode , lib_copy_file_location FROM library_copy_file");
    }


    public function get_view_doc($gl_doc_code)
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
        gl_document.gl_doc_status,
        gl_document.gl_doc_hashtag,
        gl_folder.gl_folder_name
        FROM
        gl_document
        INNER JOIN gl_folder ON gl_folder.gl_folder_number = gl_document.gl_doc_folder_number WHERE gl_doc_code='$gl_doc_code' ");
    }






}

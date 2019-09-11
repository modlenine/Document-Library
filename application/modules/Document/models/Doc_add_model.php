<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Doc_add_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model("doc_get_model");
        require("PHPMailer_5.2.0/class.phpmailer.php");
    }



    public function save_sec1()
    {
        $get_darcode = $this->doc_get_model->get_dar_code();
        $get_doc_code = $this->doc_get_model->get_doc_code();
        $dc_data_sub_type = $this->input->post('dc_data_sub_type');

        if (isset($_POST['btnUser_submit'])) { //Check button submit
            if ($dc_data_sub_type == "sds") {
                $conDoccode = cut_doccode3($get_doc_code);
            } else if ($dc_data_sub_type == "l") {
                $conDoccode = cut_doccode2($get_doc_code);
            } else {
                $conDoccode = cut_doccode1($get_doc_code);
            }

            $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
            $file_name = $_FILES['dc_data_file']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_date = substr_replace(".", $get_doc_code . ".pdf", 0);
            $file_size = $_FILES['dc_data_file']['size'];
            $file_tmp = $_FILES['dc_data_file']['tmp_name'];
            $file_type = $_FILES['dc_data_file']['type'];

            move_uploaded_file($file_tmp, "asset/document_files/" . $file_name_date);
            $filelocation = "asset/document_files/";


            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";




            $armain = array(
                "dc_data_doccode" => $conDoccode,
                "dc_data_doccode_display" => $get_doc_code,
                "dc_data_darcode" => $get_darcode,
                "dc_data_sub_type" => $this->input->post("dc_data_sub_type"),
                "dc_data_sub_type_law" => $this->input->post("get_law"),
                "dc_data_sub_type_sds" => $this->input->post("get_sds"),
                "dc_data_date" => $this->input->post("dc_data_date"),
                "dc_data_user" => $this->input->post("dc_data_user"),
                "dc_data_dept" => $this->input->post("dc_data_dept"),
                "dc_data_docname" => $this->input->post("dc_data_docname"),
                "dc_data_edit" => $this->input->post("dc_data_edit"),
                "dc_data_date_start" => $this->input->post("dc_data_date_start"),
                "dc_data_store" => $this->input->post("dc_data_store"),
                "dc_data_store_type" => $this->input->post("dc_data_store_type"),
                "dc_data_reson" => $this->input->post("dc_data_reson"),
                "dc_data_reson_detail" => $this->input->post("dc_data_reson_detail"),
                "dc_data_file" => $file_name_date,
                "dc_data_file_location" => $filelocation,
                "dc_data_status" => "Open"
            );


            // Loop insert related department
            $related_dept_code = $this->input->post("related_dept_code");
            foreach ($related_dept_code as $related_dept_codes) {
                $arrelated = array(
                    "related_dept_doccode" => $conDoccode,
                    "related_dept_darcode" => $get_darcode,
                    "related_dept_code" => $related_dept_codes
                );
                $this->db->insert("dc_related_dept_use", $arrelated);
            }
            // Loop insert related department

            // Loop insert System Category
            $sys_cat = $this->input->post("dc_data_type");
            foreach ($sys_cat as $sys_cats) {
                $arsys_cat = array(
                    "dc_type_use_doccode" => $conDoccode,
                    "dc_type_use_darcode" => $get_darcode,
                    "dc_type_use_code" => $sys_cats
                );
                $this->db->insert("dc_type_use", $arsys_cat);
            }
            // Loop insert System Category


        } //Check button submit

        $result = $this->db->insert("dc_datamain", $armain);
        if (!$result) {
            echo "<script>";
            echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
            echo "window.history.back(-1)";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('บันทึกข้อมูลสำเร็จ')";
            echo "</script>";
            // header("refresh:10; url=".base_url()."document");

        }

        $calldata_email = $this->doc_get_model->get_fulldata($get_darcode);
        $calldata_emails = $calldata_email->row();

            //************************************ZONE***SEND****EMAIL*************************************//
        
            $subject = "New ใบคำร้องเกี่ยวกับเอกสาร ( DAR )";

            $body = "<h3 style='font-size:26px;'>พบใบคำร้องเกี่ยวกับเอกสาร ( DAR ) ใหม่ !</h3>";
            $body .= "<strong style='font-size:20px;'>เลขที่ใบ DAR :</strong>&nbsp;".$calldata_emails->dc_data_darcode."&nbsp;&nbsp;&nbsp;";
            $body .= "<strong style='font-size:20px;'>ระบบที่เกี่ยวข้อง :</strong>&nbsp;";

            $ra_typeuse = $this->doc_get_model->get_doctype_use($get_darcode);
foreach($ra_typeuse->result_array() as $rst){
            $body .= $rst['dc_type_name']."&nbsp;,&nbsp;";
}

            $body .= "<br>";

            $body .= "<span style='font-size:20px;'><strong>ประเภทเอกสาร :</strong></span>&nbsp;".$calldata_emails->dc_sub_type_name."<br>";

            $body .= "<span style='font-size:20px;'><strong>วันที่ร้องขอ :</strong></span>&nbsp;".con_date($calldata_emails->dc_data_date)."&nbsp;&nbsp;&nbsp;<span style='font-size:20px;'><strong>ผู้ร้องขอ :</strong></span>&nbsp;".$calldata_emails->dc_data_user."<br>";

            $body .= "<span style='font-size:20px;'><strong>แผนก :</strong></span>&nbsp;".$calldata_emails->dc_dept_main_name."&nbsp;&nbsp;&nbsp;<span style='font-size:20px;'><strong>ชื่อเอกสาร :</strong></span>&nbsp;".$calldata_emails->dc_data_docname."<br>";

            $body .= "<span style='font-size:20px;'><strong>รหัสเอกสาร :</strong></span>&nbsp;".$calldata_emails->dc_data_doccode_display."&nbsp;&nbsp;&nbsp;<span style='font-size:20px;'><strong>ครั้งที่แก้ไข :</strong></span>&nbsp;".$calldata_emails->dc_data_edit."<br>";
            
            $body .= "<span style='font-size:20px;'><strong>วันที่เริ่มใช้ :</strong></span>&nbsp;".con_date($calldata_emails->dc_data_date_start)."&nbsp;&nbsp;&nbsp;<span style='font-size:20px;'><strong>ระยะเวลาในการจัดเก็บ :</strong></span>&nbsp;".$calldata_emails->dc_data_store."&nbsp;".$calldata_emails->dc_data_store_type."<br>";

            $body .= "<span style='font-size:20px;'><strong>เหตุผลในการร้องขอ :</strong></span>&nbsp;".$calldata_emails->dc_reason_name."<br>";

            $body .= "<span style='font-size:20px;'><strong>รายละเอียด เหตุผลในการร้องขอ :</strong></span>&nbsp;".$calldata_emails->dc_data_reson_detail."<br>";

            $body .= "<span style='font-size:20px;'><strong>หน่วยงานที่เกี่ยวข้อง :</strong></span>&nbsp;";
$ra_related_dept = $this->doc_get_model->get_related_use($get_darcode);
foreach($ra_related_dept->result_array() as $rrd){
            $body .= $rrd['related_dept_name']."&nbsp;,&nbsp;";
}
            $body .= "<br><br>";

            $body .= "<span style='font-size:20px;'><strong>ไฟล์เอกสาร :</strong></span>&nbsp;"."<a href='".base_url().$calldata_emails->dc_data_file_location.$calldata_emails->dc_data_file."'>".$calldata_emails->dc_data_file."</a><br>";

            $body .= "<strong>Link Program :</strong>&nbsp;"."<a href='".base_url('document/viewfull/').$calldata_emails->dc_data_darcode."'>ตรวจสอบเอกสารได้ที่นี่</a>";
            $body .= "</html>\n";

            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
            $mail->SMTPDebug = 1;                                      // set mailer to use SMTP
            $mail->Host = "mail.saleecolour.com";  // specify main and backup server
            //        $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // พอร์ท
            //        $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;     // turn on SMTP authentication
            $mail->Username = "document_system@saleecolour.com";  // SMTP username
            //websystem@saleecolour.com
            //        $mail->Username = "chainarong039@gmail.com";
            $mail->Password = "document*1234"; // SMTP password
            //Ae8686#
            //        $mail->Password = "ShctBkk1";

            $mail->From = "document_system@saleecolour.com";
            $mail->FromName = "Document System";

            $mail->AddAddress("chainarong_k@saleecolour.com");
            // $mail->AddCC("");
            // $mail->AddCC("");

            // $mail->AddAddress("chainarong039@gmail.com");                  // name is optional
            $mail->WordWrap = 50;                                 // set word wrap to 50 characters
            // $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
            // $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
            $mail->IsHTML(true);                                  // set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->send();
            //************************************ZONE***SEND****EMAIL*************************************//
    }





    public function save_sec2($darcode)
    {
        if ($this->input->post("dc_data_result_reson_status") == 1) {
            $status = "Manager Approved";
        } else {
            $getfile = $this->db->query("SELECT dc_data_file , dc_data_file_location FROM dc_datamain WHERE dc_data_darcode='$darcode' ");
            $rsgetfile = $getfile->row();
            @unlink($rsgetfile->dc_data_file_location . $rsgetfile->dc_data_file);
            $this->db->query("UPDATE dc_datamain SET dc_data_doccode='', dc_data_file='' , dc_data_file_location='' , dc_data_old_dar='' WHERE dc_data_darcode='$darcode' ");

            $status = "Manager Not Approve";
        }

        $ar_save_sec2 = array(
            "dc_data_result_reson_status" => $this->input->post('dc_data_result_reson_status'),
            "dc_data_result_reson_detail" => $this->input->post('dc_data_result_reson_detail'),
            "dc_data_approve_mgr" => $this->input->post('dc_data_approve_mgr'),
            "dc_data_date_approve_mgr" => date("Y-m-d"),
            "dc_data_status" => $status
        );

        $this->db->where("dc_data_darcode", $darcode);
        $result_sec2 = $this->db->update("dc_datamain", $ar_save_sec2);
    }


    public function save_sec3($darcode)
    {
        $get_doc_code = $this->doc_get_model->get_doc_code();
        if ($this->input->post("dc_data_result_reson_status2") == 1) {
            $status = "Qmr Approved";
        } else {
            $getfile = $this->db->query("SELECT dc_data_file , dc_data_file_location FROM dc_datamain WHERE dc_data_darcode='$darcode' ");
            $rsgetfile = $getfile->row();
            @unlink($rsgetfile->dc_data_file_location . $rsgetfile->dc_data_file);
            $this->db->query("UPDATE dc_datamain SET dc_data_doccode='', dc_data_file='' , dc_data_file_location='', dc_data_old_dar='' WHERE dc_data_darcode='$darcode' ");

            $status = "Qmr Not Approve";
        }


        $ar_save_sec3 = array(
            "dc_data_result_reson_status2" => $this->input->post('dc_data_result_reson_status2'),
            "dc_data_result_reson_detail2" => $this->input->post('dc_data_result_reson_detail2'),
            "dc_data_approve_qmr" => $this->input->post('dc_data_approve_qmr'),
            "dc_data_date_approve_qmr" => date("Y-m-d"),
            "dc_data_status" => $status
        );

        $this->db->where("dc_data_darcode", $darcode);
        $result_sec3 = $this->db->update("dc_datamain", $ar_save_sec3);
    }


    public function save_sec4($darcode)
    {
        // Get document code
        $get_doccode = $this->db->query("SELECT dc_data_doccode , dc_data_file FROM dc_datamain WHERE dc_data_darcode='$darcode' ");
        $get_doccodes = $get_doccode->row();
        $get_doc_code = substr($get_doccodes->dc_data_file, 0, -4);

        // For Master file

        $file_name = $_FILES['document_master']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_master = substr_replace(".", $get_doc_code . "-master" . ".pdf", 0);
        $file_size = $_FILES['document_master']['size'];
        $file_tmp = $_FILES['document_master']['tmp_name'];
        $file_type = $_FILES['document_master']['type'];

        move_uploaded_file($file_tmp, "asset/master/" . $file_name_master);
        $filelocation_master = "asset/master/";


        print_r($file_name);
        echo "<br>" . "Copy/Upload Complete" . "<br>";



        $file_name = $_FILES['document_copy']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_copy = substr_replace(".", $get_doc_code . "-copy" . ".pdf", 0);
        $file_size = $_FILES['document_copy']['size'];
        $file_tmp = $_FILES['document_copy']['tmp_name'];
        $file_type = $_FILES['document_copy']['type'];

        move_uploaded_file($file_tmp, "asset/copy/" . $file_name_copy);
        $filelocation_copy = "asset/copy/";


        print_r($file_name);
        echo "<br>" . "Copy/Upload Complete" . "<br>";

        $status = "Complete";

        $ar_save_sec4 = array(

            "dc_data_method" => $this->input->post('dc_data_method'),
            "dc_data_operation" => $this->input->post('dc_data_operation'),
            "dc_data_date_operation" => date("Y-m-d"),
            "dc_data_status" => $status
        );

        $this->db->where("dc_data_darcode", $darcode);
        $result_sec4 = $this->db->update("dc_datamain", $ar_save_sec4);

        $checkolddar = $this->db->query("SELECT dc_data_old_dar FROM dc_datamain WHERE dc_data_darcode = '$darcode' ");
        $checknumrow = $checkolddar->num_rows();
        if ($checknumrow > 0) {
            $getolddar = $checkolddar->row();
            $inactive = array(
                "lib_main_status" => "inactive",
                "lib_main_modify_status" => ""
            );
            $this->db->where("lib_main_darcode", $getolddar->dc_data_old_dar);
            $this->db->update("library_main", $inactive);
        }

        $ar_lib_save = array(
            "lib_main_doccode" => $get_doccodes->dc_data_doccode,
            "lib_main_darcode" => $darcode,
            "lib_main_doccode_master" => $file_name_master,
            "lib_main_doccode_copy" => $file_name_copy,
            "lib_main_file_location_master" => $filelocation_master,
            "lib_main_file_location_copy" => $filelocation_copy,
            "lib_main_status" => "active"
        );
        $this->db->insert("library_main", $ar_lib_save);


        $li_get_hashtag = $this->input->post("li_hashtag");
        foreach($li_get_hashtag as $lgd){
            $ar_li_hashtag = array(
                "li_hashtag_doc_code" => $get_doccodes->dc_data_doccode,
                "li_hashtag_name" => $lgd
            );
            $this->db->insert("library_hashtag",$ar_li_hashtag);
        }


    }



    public function save_sec4deptedit($darcode)
    {

        $status = "Complete";

        $ar_save_sec4 = array(

            "dc_data_method" => $this->input->post('dc_data_method'),
            "dc_data_operation" => $this->input->post('dc_data_operation'),
            "dc_data_date_operation" => date("Y-m-d"),
            "dc_data_status" => $status
        );

        $this->db->where("dc_data_darcode", $darcode);
        $result_sec4 = $this->db->update("dc_datamain", $ar_save_sec4);

        //delete old related
        $olddarcheck = $this->input->post("dc_data_old_dar");
        $this->db->where("related_dept_darcode", $olddarcheck);
        $this->db->delete("dc_related_dept_use");
    }





    public function up_status1($doccode)
    {
        $ar = array(
            "lib_main_status" => "lib02"
        );
        $this->db->where('lib_main_doccode', $doccode);
        $this->db->update('library_main', $ar);
        redirect('document/thkpage/');
    }

    public function up_status2($doccode)
    {
        $ar = array(
            "lib_main_status" => "lib03"
        );
        $this->db->where('lib_main_doccode', $doccode);
        $this->db->update('library_main', $ar);
        redirect('document/thkpage/');
    }



    public function save_sec1_edit($doccode)
    {
        $get_darcode = $this->doc_get_model->get_dar_code();
        $dc_data_edit = $this->input->post('dc_data_edit');
        $dc_data_doccode = $this->input->post('dc_data_doccode');
        $dc_data_sub_type = $this->input->post('dc_data_sub_type');
        $darcode_h = $this->input->post("darcode_h");


        if ($dc_data_edit < 10) {
            $rev = "-rev0";
        } else {
            $rev = "-rev";
        }

        if (isset($_POST['btnUser_submit'])) {

            if ($dc_data_sub_type == "s" || $dc_data_sub_type == "f" || $dc_data_sub_type == "x") {
                $cut1 = substr($dc_data_doccode, 0, 9);
                $cut2 = substr($dc_data_doccode, 9, 2);
                $cut3 = substr($dc_data_doccode, 11);
                if ($dc_data_edit < 10) {
                    $cut2 = 0;
                    $dc_data_doccode = $cut1 . $cut2 . $dc_data_edit . $cut3;
                } else {
                    $dc_data_doccode = $cut1 . $dc_data_edit . $cut3;
                }

                $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
                $file_name = $_FILES['dc_data_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = substr_replace(".", $dc_data_doccode . ".pdf", 0);
                $file_size = $_FILES['dc_data_file']['size'];
                $file_tmp = $_FILES['dc_data_file']['tmp_name'];
                $file_type = $_FILES['dc_data_file']['type'];

                move_uploaded_file($file_tmp, "asset/document_files/" . $file_name_date);
                $filelocation = "asset/document_files/";


                print_r($file_name);
                echo "<br>" . "Copy/Upload Complete" . "<br>";
            } else {
                $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
                $file_name = $_FILES['dc_data_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = substr_replace(".", $dc_data_doccode . $rev . $dc_data_edit . ".pdf", 0);
                $file_size = $_FILES['dc_data_file']['size'];
                $file_tmp = $_FILES['dc_data_file']['tmp_name'];
                $file_type = $_FILES['dc_data_file']['type'];

                move_uploaded_file($file_tmp, "asset/document_files/" . $file_name_date);
                $filelocation = "asset/document_files/";


                print_r($file_name);
                echo "<br>" . "Copy/Upload Complete" . "<br>";
            }


            if ($dc_data_sub_type == "sds") {
                $conDoccode = cut_doccode3($dc_data_doccode);
            } else if ($dc_data_sub_type == "l") {
                $conDoccode = cut_doccode2($dc_data_doccode);
            } else {
                $conDoccode = cut_doccode1($dc_data_doccode);
            }




            $armain = array(
                "dc_data_doccode" => $conDoccode,
                "dc_data_doccode_display" => $dc_data_doccode,
                "dc_data_darcode" => $get_darcode,
                "dc_data_sub_type" => $this->input->post("dc_data_sub_type"),
                "dc_data_sub_type_law" => $this->input->post("get_law"),
                "dc_data_sub_type_sds" => $this->input->post("get_sds"),
                "dc_data_date" => $this->input->post("dc_data_date"),
                "dc_data_user" => $this->input->post("dc_data_user"),
                "dc_data_dept" => $this->input->post("dc_data_dept"),
                "dc_data_docname" => $this->input->post("dc_data_docname"),
                "dc_data_edit" => $dc_data_edit,
                "dc_data_date_start" => $this->input->post("dc_data_date_start"),
                "dc_data_store" => $this->input->post("dc_data_store"),
                "dc_data_store_type" => $this->input->post("dc_data_store_type"),
                "dc_data_reson" => $this->input->post("dc_data_reson"),
                "dc_data_reson_detail" => $this->input->post("dc_data_reson_detail"),
                "dc_data_file" => $file_name_date,
                "dc_data_file_location" => $filelocation,
                "dc_data_status" => "Open",
                "dc_data_old_dar" => $darcode_h
            );


            // Delete old Related department
            $this->db->where("related_dept_doccode", $conDoccode);
            $this->db->delete("dc_related_dept_use");
            // Delete old Related department


            // Loop insert related department
            $related_dept_code = $this->input->post("related_dept_code");
            foreach ($related_dept_code as $related_dept_codes) {
                $arrelated = array(
                    "related_dept_doccode" => $conDoccode,
                    "related_dept_darcode" => $get_darcode,
                    "related_dept_code" => $related_dept_codes
                );
                $this->db->insert("dc_related_dept_use", $arrelated);
            }
            // Loop insert related department


            // Delete old Category 
            $this->db->where("dc_type_use_doccode", $conDoccode);
            $this->db->delete("dc_type_use");
            // Delete old Category 


            // Loop insert System Category
            $sys_cat = $this->input->post("dc_data_type");
            foreach ($sys_cat as $sys_cats) {
                $arsys_cat = array(
                    "dc_type_use_doccode" => $conDoccode,
                    "dc_type_use_darcode" => $get_darcode,
                    "dc_type_use_code" => $sys_cats
                );
                $this->db->insert("dc_type_use", $arsys_cat);
            }
            // Loop insert System Category

            
//Change status on library main table

$ar_update_library = array(
    "lib_main_modify_status" => "pending"
);
$this->db->where("lib_main_darcode",$darcode_h);
$this->db->update("library_main",$ar_update_library);

// Change status on library main table


            $result = $this->db->insert("dc_datamain", $armain);
            if (!$result) {
                echo "<script>";
                echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
                echo "window.history.back(-1)";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('บันทึกข้อมูลสำเร็จ')";
                echo "</script>";
                // header("refresh:10; url=".base_url()."document");

            }
        }
    }



    public function save_edit_dept($doccode)
    {

        $get_darcode = $this->doc_get_model->get_dar_code();
        $armain = array(
            "dc_data_doccode" => $this->input->post("dc_data_doccode"),
            "dc_data_doccode_display" => $this->input->post("dc_data_doccode_display"),
            "dc_data_darcode" => $get_darcode,
            "dc_data_sub_type" => $this->input->post("dc_data_sub_type"),
            "dc_data_sub_type_law" => $this->input->post("get_law"),
            "dc_data_sub_type_sds" => $this->input->post("get_sds"),
            "dc_data_date" => $this->input->post("dc_data_date"),
            "dc_data_user" => $this->input->post("dc_data_user"),
            "dc_data_dept" => $this->input->post("dc_data_depts"),
            "dc_data_docname" => $this->input->post("dc_data_docname"),
            "dc_data_edit" => "-1",
            "dc_data_date_start" => $this->input->post("dc_data_date_start"),
            "dc_data_store" => $this->input->post("dc_data_store"),
            "dc_data_store_type" => $this->input->post("dc_data_store_type"),
            "dc_data_reson" => $this->input->post("dc_data_reson"),
            "dc_data_reson_detail" => $this->input->post("dc_data_reson_detail"),
            "dc_data_file" => $this->input->post("dc_data_file"),
            "dc_data_file_location" => $this->input->post("dc_data_file_location"),
            "dc_data_status" => "open",
            "dc_data_old_dar" => $this->input->post("dc_data_old_dar")
        );


        // Delete old Related department
        // $this->db->where("related_dept_doccode", $doccode);
        // $this->db->delete("dc_related_dept_use");
        // Delete old Related department


        // Loop insert related department
        $related_dept_code = $this->input->post("related_dept_code");
        foreach ($related_dept_code as $related_dept_codes) {
            $arrelated = array(
                "related_dept_doccode" => $this->input->post("dc_data_doccode"),
                "related_dept_darcode" => $get_darcode,
                "related_dept_code" => $related_dept_codes
            );
            $this->db->insert("dc_related_dept_use", $arrelated);
        }
        // Loop insert related department



        $result = $this->db->insert("dc_datamain", $armain);
        if (!$result) {
            echo "<script>";
            echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
            echo "window.history.back(-1)";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('บันทึกข้อมูลสำเร็จ')";
            echo "</script>";
            header("refresh:1; url=" . base_url() . "document/list_dar");
        }
    }


    public function save_cancel($doccode)
    {
        $dc_data_darcode = $this->input->post("dc_data_darcode");
        $get_darcode = $this->doc_get_model->get_dar_code();
        $armain = array(
            "dc_data_doccode" => $this->input->post("dc_data_doccode"),
            "dc_data_doccode_display" => $this->input->post("dc_data_doccode_display"),
            "dc_data_darcode" => $get_darcode,
            "dc_data_sub_type" => $this->input->post("dc_data_sub_type"),
            "dc_data_sub_type_law" => $this->input->post("get_law"),
            "dc_data_sub_type_sds" => $this->input->post("get_sds"),
            "dc_data_date" => $this->input->post("dc_data_date"),
            "dc_data_user" => $this->input->post("dc_data_user"),
            "dc_data_dept" => $this->input->post("dc_data_depts"),
            "dc_data_docname" => $this->input->post("dc_data_docname"),
            "dc_data_edit" => "-1",
            "dc_data_date_start" => $this->input->post("dc_data_date_start"),
            "dc_data_store" => $this->input->post("dc_data_store"),
            "dc_data_store_type" => $this->input->post("dc_data_store_type"),
            "dc_data_reson" => $this->input->post("dc_data_reson"),
            "dc_data_reson_detail" => $this->input->post("dc_data_reson_detail"),
            "dc_data_file" => $this->input->post("dc_data_file"),
            "dc_data_file_location" => $this->input->post("dc_data_file_location"),
            "dc_data_status" => "open",
            "dc_data_old_dar" => $dc_data_darcode
        );

        $result = $this->db->insert("dc_datamain", $armain);
        if (!$result) {
            echo "<script>";
            echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
            echo "window.history.back(-1)";
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('บันทึกข้อมูลสำเร็จ')";
            echo "</script>";
            header("refresh:1; url=" . base_url() . "document/list_dar");
        }
    }



    public function save_sec4cancel($darcode)
    {
        $get_dc_data_doccode = $this->input->post("get_dc_data_doccode");
        $get_dc_data_old_dar = $this->input->post("get_dc_data_old_dar");
        $get_dc_data_file = $this->input->post("get_dc_data_file");



        $file_name = $_FILES['document_master']['name'];
        $file_name_cut = str_replace(" ", "", $file_name);
        $file_name_master = substr_replace(".", $get_dc_data_file . "-master-cancel" . ".pdf", 0);
        $file_size = $_FILES['document_master']['size'];
        $file_tmp = $_FILES['document_master']['tmp_name'];
        $file_type = $_FILES['document_master']['type'];

        move_uploaded_file($file_tmp, "asset/master/" . $file_name_master);
        $filelocation_master = "asset/master/";


        print_r($file_name);
        echo "<br>" . "Copy/Upload Complete" . "<br>";


        $status = "Complete";

        $ar_save_sec4 = array(

            "dc_data_method" => $this->input->post('dc_data_method'),
            "dc_data_operation" => $this->input->post('dc_data_operation'),
            "dc_data_date_operation" => date("Y-m-d"),
            "dc_data_status" => $status
        );

        $this->db->where("dc_data_darcode", $darcode);
        $result_sec4 = $this->db->update("dc_datamain", $ar_save_sec4);




        $ar_lib = array(
            "lib_main_doccode_master" => $file_name_master,
            "lib_main_status" => "inactive"
        );
        $this->db->where("lib_main_darcode", $get_dc_data_old_dar);
        $this->db->update("library_main", $ar_lib);
    }




    public function save_sec1change($doccode)
    {
        $get_darcode = $this->doc_get_model->get_dar_code();
        $dc_data_edit = $this->input->post('dc_data_edit');
        $dc_data_doccode = $this->input->post('dc_data_doccode');
        $dc_data_sub_type = $this->input->post('dc_data_sub_type');
        $darcode_h = $this->input->post("darcode_h");


        if ($dc_data_edit < 10) {
            $rev = "-rev0";
        } else {
            $rev = "-rev";
        }

        if (isset($_POST['btnUser_submit'])) {

            if ($dc_data_sub_type == "s" || $dc_data_sub_type == "f" || $dc_data_sub_type == "x") {
                $cut1 = substr($dc_data_doccode, 0, 9);
                $cut2 = substr($dc_data_doccode, 9, 2);
                $cut3 = substr($dc_data_doccode, 11);
                if ($dc_data_edit < 10) {
                    $cut2 = 0;
                    $dc_data_doccode = $cut1 . $cut2 . $dc_data_edit . $cut3;
                } else {
                    $dc_data_doccode = $cut1 . $dc_data_edit . $cut3;
                }

                $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
                $file_name = $_FILES['dc_data_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = substr_replace(".", $dc_data_doccode . ".pdf", 0);
                $file_size = $_FILES['dc_data_file']['size'];
                $file_tmp = $_FILES['dc_data_file']['tmp_name'];
                $file_type = $_FILES['dc_data_file']['type'];

                move_uploaded_file($file_tmp, "asset/document_files/" . $file_name_date);
                $filelocation = "asset/document_files/";


                print_r($file_name);
                echo "<br>" . "Copy/Upload Complete" . "<br>";
            } else {
                $date = date("d-m-Y-H-i-s"); //ดึงวันที่และเวลามาก่อน
                $file_name = $_FILES['dc_data_file']['name'];
                $file_name_cut = str_replace(" ", "", $file_name);
                $file_name_date = substr_replace(".", $dc_data_doccode . $rev . $dc_data_edit . ".pdf", 0);
                $file_size = $_FILES['dc_data_file']['size'];
                $file_tmp = $_FILES['dc_data_file']['tmp_name'];
                $file_type = $_FILES['dc_data_file']['type'];

                move_uploaded_file($file_tmp, "asset/document_files/" . $file_name_date);
                $filelocation = "asset/document_files/";


                print_r($file_name);
                echo "<br>" . "Copy/Upload Complete" . "<br>";
            }


            if ($dc_data_sub_type == "sds") {
                $conDoccode = cut_doccode3($dc_data_doccode);
            } else if ($dc_data_sub_type == "l") {
                $conDoccode = cut_doccode2($dc_data_doccode);
            } else {
                $conDoccode = cut_doccode1($dc_data_doccode);
            }




            $armain = array(
                "dc_data_doccode" => $conDoccode,
                "dc_data_doccode_display" => $dc_data_doccode,
                "dc_data_darcode" => $get_darcode,
                "dc_data_sub_type" => $this->input->post("dc_data_sub_type"),
                "dc_data_sub_type_law" => $this->input->post("get_law"),
                "dc_data_sub_type_sds" => $this->input->post("get_sds"),
                "dc_data_date" => $this->input->post("dc_data_date"),
                "dc_data_user" => $this->input->post("dc_data_user"),
                "dc_data_dept" => $this->input->post("dc_data_dept"),
                "dc_data_docname" => $this->input->post("dc_data_docname"),
                "dc_data_edit" => $dc_data_edit,
                "dc_data_date_start" => $this->input->post("dc_data_date_start"),
                "dc_data_store" => $this->input->post("dc_data_store"),
                "dc_data_store_type" => $this->input->post("dc_data_store_type"),
                "dc_data_reson" => $this->input->post("dc_data_reson"),
                "dc_data_reson_detail" => $this->input->post("dc_data_reson_detail"),
                "dc_data_file" => $file_name_date,
                "dc_data_file_location" => $filelocation,
                "dc_data_status" => "Open",
                "dc_data_old_dar" => $darcode_h
            );


            // Delete old Related department
            $this->db->where("related_dept_doccode", $conDoccode);
            $this->db->delete("dc_related_dept_use");
            // Delete old Related department


            // Loop insert related department
            $related_dept_code = $this->input->post("related_dept_code");
            foreach ($related_dept_code as $related_dept_codes) {
                $arrelated = array(
                    "related_dept_doccode" => $conDoccode,
                    "related_dept_darcode" => $get_darcode,
                    "related_dept_code" => $related_dept_codes
                );
                $this->db->insert("dc_related_dept_use", $arrelated);
            }
            // Loop insert related department


            // Delete old Category 
            $this->db->where("dc_type_use_doccode", $conDoccode);
            $this->db->delete("dc_type_use");
            // Delete old Category 


            // Loop insert System Category
            $sys_cat = $this->input->post("dc_data_type");
            foreach ($sys_cat as $sys_cats) {
                $arsys_cat = array(
                    "dc_type_use_doccode" => $conDoccode,
                    "dc_type_use_darcode" => $get_darcode,
                    "dc_type_use_code" => $sys_cats
                );
                $this->db->insert("dc_type_use", $arsys_cat);
            }
            // Loop insert System Category



            //Change status on library main table

            $ar_update_library = array(
                "lib_main_modify_status" => "pending"
            );
            $this->db->where("lib_main_darcode",$darcode_h);
            $this->db->update("library_main",$ar_update_library);

            // Change status on library main table

            $result = $this->db->insert("dc_datamain", $armain);
            if (!$result) {
                echo "<script>";
                echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
                echo "window.history.back(-1)";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('บันทึกข้อมูลสำเร็จ')";
                echo "</script>";
                // header("refresh:10; url=".base_url()."document");

            }
        }
    }


    public function save_gl_doc()
    {
        $get_doccode = get_gl_doccode();

            $file_name = $_FILES['gl_doc_file']['name'];
            $file_name_cut = str_replace(" ", "", $file_name);
            $file_name_cuts = substr_replace(".", $get_doccode . ".pdf", 0);
            $file_size = $_FILES['gl_doc_file']['size'];
            $file_tmp = $_FILES['gl_doc_file']['tmp_name'];
            $file_type = $_FILES['gl_doc_file']['type'];

            move_uploaded_file($file_tmp, "asset/general_document/" . $file_name_cuts);
            $filelocation = "asset/general_document/";


            print_r($file_name);
            echo "<br>" . "Copy/Upload Complete" . "<br>";

        if (isset($_POST['btnAdd_gldoc'])) {
            


            $add_doc = array(
                "gl_doc_date_request" => $this->input->post("gl_doc_date_request"),
                "gl_doc_username" => $this->input->post("gl_doc_username"),
                "gl_doc_ecode" => $this->input->post("gl_doc_ecode"),
                "gl_doc_deptcode" => $this->input->post("gl_doc_deptcode"),
                "gl_doc_deptname" => $this->input->post("gl_doc_deptname"),
                "gl_doc_name" => $this->input->post("gl_doc_name"),
                "gl_doc_code" => $get_doccode,
                "gl_doc_folder_number" => $this->input->post("gl_doc_folder_number"),
                "gl_doc_detail" => $this->input->post("gl_doc_detail"),
                "gl_doc_file" => $file_name_cuts,
                "gl_doc_file_location" => $filelocation,
                "gl_doc_approve_status" => $this->input->post("gl_doc_status"),
                "gl_doc_reson_detail" => $this->input->post("gl_doc_reson_detail"),
                "gl_doc_approve_by" => $this->input->post("gl_doc_approve"),
                "gl_doc_status" => "Open"
            );

            $result = $this->db->insert("gl_document", $add_doc);
            if (!$result) {
                echo "<script>";
                echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
                echo "window.history.back(-1)";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('บันทึกข้อมูลสำเร็จ')";
                echo "</script>";
                header("refresh:0; url=".base_url()."document/list_generel");
            }
        }

    }


    public function save_gl_doc2($gl_doc_code)
    {
        if(isset($_POST['btn_save2'])){
            if($this->input->post("gl_doc_status") == 1){
                $gl_doc_status = 'Approved';
            }else{
                $gl_doc_status = 'Not Approve';
            }


            $ar_approve = array(
                "gl_doc_approve_status" => $this->input->post("gl_doc_status"),
                "gl_doc_reson_detail" => $this->input->post("gl_doc_reson_detail"),
                "gl_doc_approve_by" => $this->input->post("gl_doc_approve_by"),
                "gl_doc_status" => $gl_doc_status
            );

            $result = $this->db->where("gl_doc_code",$gl_doc_code);
            $result = $this->db->update("gl_document",$ar_approve);



            $hashtags = $this->input->post("gl_doc_hashtag");
            foreach($hashtags as $hashtags_btn){
                $ar_hashtag = array(
                    "gl_ht_doc_code" => $gl_doc_code,
                    "gl_ht_name" => $hashtags_btn
                );

                $this->db->insert("gl_hashtag",$ar_hashtag);
            }



            if (!$result) {
                echo "<script>";
                echo "alert('บันทึกข้อมูลไม่สำเร็จ')";
                echo "window.history.back(-1)";
                echo "</script>";
            } else {
                echo "<script>";
                echo "alert('บันทึกข้อมูลสำเร็จ')";
                echo "</script>";
                header("refresh:0; url=".base_url()."document/list_generel");
            }
        }
        

        

    }











}

/* End of file ModelName.php */

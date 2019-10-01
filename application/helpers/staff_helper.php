<?php
class staff_fn{
    public $ci;
    function __construct()
    {
        $this->ci=& get_instance();
    }
    public function getci()
    {
        return $this->ci;
    }
}



function getIsoDoc()
{
    $obj = new staff_fn();
    return $obj->getci()->db->query("SELECT
    library_main.lib_main_id,
    library_main.lib_main_doccode,
    library_main.lib_main_doccode_master,
    library_main.lib_main_doccode_copy,
    library_main.lib_main_file_location_master,
    library_main.lib_main_file_location_copy,
    library_main.lib_main_pin_status,
    dc_related_dept_use.related_dept_code,
    dc_related_dept.related_dept_name,
    dc_datamain.dc_data_sub_type,
    dc_datamain.dc_data_sub_type_law,
    dc_datamain.dc_data_sub_type_sds,
    dc_sub_type.dc_sub_type_name,
    dc_datamain.dc_data_docname,
    dc_datamain.dc_data_doccode,
    dc_datamain.dc_data_darcode,
    dc_datamain.dc_data_doccode_display,
    dc_datamain.dc_data_edit,
    library_main.lib_main_status,
    library_hashtag.li_hashtag_name,
    library_hashtag.li_hashtag_doc_code,
    dc_datamain.dc_data_dept,
    dc_dept_main.dc_dept_main_name,
    dc_datamain.dc_data_date
    FROM
    library_main
    INNER JOIN dc_related_dept_use ON dc_related_dept_use.related_dept_doccode = library_main.lib_main_doccode
    INNER JOIN dc_related_dept ON dc_related_dept.related_code = dc_related_dept_use.related_dept_code
    INNER JOIN dc_datamain ON dc_datamain.dc_data_darcode = library_main.lib_main_darcode
    INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
    INNER JOIN library_hashtag ON library_hashtag.li_hashtag_doc_code = library_main.lib_main_doccode
    INNER JOIN dc_dept_main ON dc_dept_main.dc_dept_code = dc_datamain.dc_data_dept
    WHERE
    library_main.lib_main_status = 'active' AND library_main.lib_main_pin_status != 'pin' 
    GROUP BY
    library_main.lib_main_doccode ORDER BY lib_main_id ASC ");
}

function getIsoDocPin()
{
    $obj = new staff_fn();
    return $obj->getci()->db->query("SELECT
    library_main.lib_main_id,
    library_main.lib_main_doccode,
    library_main.lib_main_doccode_master,
    library_main.lib_main_doccode_copy,
    library_main.lib_main_file_location_master,
    library_main.lib_main_file_location_copy,
    library_main.lib_main_pin_status,
    library_main.lib_main_pin_order,
    dc_related_dept_use.related_dept_code,
    dc_related_dept.related_dept_name,
    dc_datamain.dc_data_sub_type,
    dc_datamain.dc_data_sub_type_law,
    dc_datamain.dc_data_sub_type_sds,
    dc_sub_type.dc_sub_type_name,
    dc_datamain.dc_data_docname,
    dc_datamain.dc_data_doccode,
    dc_datamain.dc_data_darcode,
    dc_datamain.dc_data_doccode_display,
    dc_datamain.dc_data_edit,
    library_main.lib_main_status,
    library_hashtag.li_hashtag_name,
    library_hashtag.li_hashtag_doc_code,
    dc_datamain.dc_data_dept,
    dc_dept_main.dc_dept_main_name,
    dc_datamain.dc_data_date
    FROM
    library_main
    INNER JOIN dc_related_dept_use ON dc_related_dept_use.related_dept_doccode = library_main.lib_main_doccode
    INNER JOIN dc_related_dept ON dc_related_dept.related_code = dc_related_dept_use.related_dept_code
    INNER JOIN dc_datamain ON dc_datamain.dc_data_darcode = library_main.lib_main_darcode
    INNER JOIN dc_sub_type ON dc_sub_type.dc_sub_type_code = dc_datamain.dc_data_sub_type
    INNER JOIN library_hashtag ON library_hashtag.li_hashtag_doc_code = library_main.lib_main_doccode
    INNER JOIN dc_dept_main ON dc_dept_main.dc_dept_code = dc_datamain.dc_data_dept
    WHERE
    library_main.lib_main_status = 'active' && library_main.lib_main_pin_status='pin'
    GROUP BY
    library_main.lib_main_doccode ORDER BY lib_main_pin_order DESC ");
}


function countPin()
{
    $obj = new staff_fn();
    $query = $obj->getci()->db->query("SELECT lib_main_pin_status FROM library_main WHERE lib_main_pin_status='pin' ");
    return $query->num_rows();
}



function pinIsoDoc($lib_main_id)
{
    $obj = new staff_fn();
    //check order pin
    $checkorderpin = $obj->getci()->db->query("SELECT lib_main_pin_order FROM library_main ORDER BY lib_main_pin_order DESC LIMIT 1 ");
    foreach($checkorderpin->result_array() as $rs){
        if($rs['lib_main_pin_order'] == 0){
            $orderpin = 1;
        }else if($rs['lib_main_pin_order'] > 0){
            $orderpin = $rs['lib_main_pin_order'];
            $orderpin++;
        }
    }
    
    $ar = array(
        "lib_main_pin_status" => "pin",
        "lib_main_pin_order" => $orderpin
    );

    $result = $obj->getci()->db->where("lib_main_id",$lib_main_id);
    $result = $obj->getci()->db->update("library_main",$ar);
    if(!$result)
    {
        echo "<script>";
        echo "alert('ปักหมุดไม่สำเร็จ')";
        echo "</script>";
        exit();
        
    }else{
        echo "<script>";
        echo "alert('ปักหมุดเรียบร้อยแล้ว')";
        echo "</sctipt>";
    }
}


function unpinIsoDoc($lib_main_id)
{
    $obj = new staff_fn();
    $ar = array(
        "lib_main_pin_status" => 0 ,
        "lib_main_pin_order" => 0
    );

    $result = $obj->getci()->db->where("lib_main_id",$lib_main_id);
    $result = $obj->getci()->db->update("library_main",$ar);
    if(!$result)
    {
        echo "<script>";
        echo "alert('ปักหมุดไม่สำเร็จ')";
        echo "</script>";
        exit();
        
    }else{
        echo "<script>";
        echo "alert('ปักหมุดเรียบร้อยแล้ว')";
        echo "</sctipt>";
    }
}




?>
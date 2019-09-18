


$(function () {


    /***********************************Text area 40 char*****************************************/
    $('#characterLeft').text('40 characters left');
    $('#li_hashtag').keydown(function () {
        var max = 40;
        var len = $(this).val().length;
        if (len >= max) {
            $('#characterLeft').text('You have reached the limit');
            $('#characterLeft').addClass('red');
            $('#dar_addmore').addClass('disabled');
        } else {
            var ch = max - len;
            $('#characterLeft').text(ch + ' characters left');
            $('#dar_addmore').removeClass('disabled');
            $('#characterLeft').removeClass('red');
        }
    });
    /***********************************Text area 40 char*****************************************/

    // Code Check Radio Button loop from database
    $('#related_dept_other').hide();
    $('#get_law').hide();
    $('#get_sds').hide();

    $("input[type=radio][name=dc_data_sub_type]").click(function () {
        if ($(this).prop("checked")) {

            if ($(this).val() == "l") {
                $('#get_law').show();
            } else {
                $('#get_law').hide();
            }

            if ($(this).val() == "sds") {
                $('#get_sds').show();
            } else {
                $('#get_sds').hide();
            }


            // if($(this).val() == "re17")//check Related dept
            // {
            //     $('#related_dept_other').show();
            // }else{
            //     $('#related_dept_other').hide();
            // }



        }
    });



    // // Code Check Radio Button loop from database
    // if($('#checksds').val() == "sds")
    // {
    //     $('#get_sds').show();
    // }

    // if($('#checksds').val() == "l")
    // {
    //     $('#get_law').show();
    // }




    // Check MGR Aprove
    if ($('#dc_data_result_reson_detail').val() != '') {
        $('#dc_data_result_reson_detail').prop('disabled', true);
        $('#btnSave_sec2').hide();
    }
    // Check MGR Aprove


    //Check Qmr Approve
    if ($('#dc_data_result_reson_detail2').val() != '') {
        $('#dc_data_result_reson_detail2').prop('disabled', true);
        $('#btnSave_sec3').hide();
    }
    //Check Qmr Approve

    if ($('#dc_data_method').val() != '') {
        $('#dc_data_method').prop('disabled', true);
        $('#btnOpsave').hide();
    }



    // $('#add_dar').click(function (){
    //     $.ajax({
    //         type:"post",
    //         url:"http://192.190.10.27/dc2/document/add_dar",
    //         cache:false,
    //         data:'data',
    //         success: function(data){
    //             $('#show_list').html(data);
    //             // alert(data);
    //             // console.log(data);
    //         }
    //     });
    // });


    // $('#list_dar').click(function (){
    //     $.ajax({
    //         type:"post",
    //         url:"http://192.190.10.27/dc2/document/list_dar",
    //         cache:false,
    //         data:'data',
    //         success: function(data){
    //             $('#show_list').html(data);
    //             // alert(data);
    //             // console.log(data);
    //             // $('#view_dar').DataTable();
    //         }

    //     });

    // });

    // $('#choose_method').change(function (){
    //     var choose_method = $('#choose_method').val();
    //     if(choose_method == "r-01")
    //     {
    //         $.ajax({
    //             type:"post",
    //             url:"http://192.190.10.27/dc2/document/add",
    //             cache:false,
    //             data:'data',
    //             success: function(data){
    //                 $('#show_add').html(data);
    //                 // alert(data);
    //                 // console.log(data);
    //                 // $('#view_dar').DataTable();
    //             }

    //         });
    //     }
    // });


    // Date pickup use
    $('.datepicker').pickadate({
        monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
        weekdaysShort: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        today: 'วันนี้',
        clear: 'ล้าง',
        formatSubmit: 'yyyy/mm/dd',
        hiddenName: true,
        editable: true,
        min: true,
        disable: [
            1, 7
        ]
    });

    $('.datepicker_search').pickadate({
        monthsFull: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
        weekdaysShort: ['อา', 'จ', 'อ', 'พ', 'พฤ', 'ศ', 'ส'],
        today: 'วันนี้',
        clear: 'ล้าง',
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true,
        editable: true,
        min: false
    });




    //  ++++++++++++++++++++++++++++++++ Modal Section +++++++++++++++++++++++++++++++++++++
    $('.edit_dept_modal').click(function () {
        var data_dept_id = $(this).attr('data-dept-id');
        var data_dept_code = $(this).attr('data-dept-code');
        var data_dept_name = $(this).attr('data-dept-name');


        $('#edit_gl_dept_code').val(data_dept_code);
        $('#edit_gl_dept_name').val(data_dept_name);
        $('#edit_gl_dept_id').val(data_dept_id);
        $('#edit_dept_modal').modal('show');
    });



    $('.edit_permis_modal').click(function () {
        var data_edit_permis_username = $(this).attr('data_edit_permis_username');
        var data_edit_permis_deptname = $(this).attr('data_edit_permis_deptname');
        var data_edit_permis_groupname = $(this).attr('data_edit_permis_groupname');
        var data_edit_permis_groupid = $(this).attr('data_edit_permis_groupid');
        var data_edit_permis_userid = $(this).attr('data_edit_permis_userid');

        $('#get_user_permis').val(data_edit_permis_username);
        $('#get_gl_dept_name').val(data_edit_permis_deptname);
        $('#get_group_permis').val(data_edit_permis_groupname);
        $('#get_gl_user_id').val(data_edit_permis_userid);
        $('#edit_permis_modal').modal('show');
    });



    $('.edit_user_modal').click(function () {
        var data_edituser_userid = $(this).attr('data_edituser_userid');
        var data_edituser_fname = $(this).attr('data_edituser_fname');
        var data_edituser_lname = $(this).attr('data_edituser_lname');
        var data_edituser_deptname = $(this).attr('data_edituser_deptname');
        var data_edituser_deptcode = $(this).attr('data_edituser_deptcode');
        var data_edituser_ecode = $(this).attr('data_edituser_ecode');
        var data_edituser_memberemail = $(this).attr('data_edituser_memberemail');

        $('#get_userid_edit').val(data_edituser_userid);
        $('#get_fname_edit').val(data_edituser_fname);
        $('#get_lname_edit').val(data_edituser_lname);
        $('#get_deptname_edit').val(data_edituser_deptname);
        $('#get_deptcode_edit').val(data_edituser_deptcode);
        $('#get_ecode_edit').val(data_edituser_ecode);
        $('#get_email_edit').val(data_edituser_memberemail);

        $('#edit_user_modal').modal('show');

    });


    $('.reason_detail').click(function () {
        var data_reason_detail = $(this).attr('data_reason_detail');

        $('#data_reason_detail_show').val(data_reason_detail);

        $('#reason_detail').modal('show');
    })



    //  ++++++++++++++++++++++++++++++++ Modal Section +++++++++++++++++++++++++++++++++++++









    // Permission Genaral document

    $('.read').prop("readonly", true);

    var result_gl_doc_status = $('#result_gl_doc_status').val();

    if (result_gl_doc_status != '') {
        if (result_gl_doc_status == 1) {
            $('#rs_approve').prop("checked", true);
        } else {
            $('#rs_notapprove').prop("checked", true);
        }
        $('#btn_save2').hide();
    }



    $('.add_more').click(function (e) {
        e.preventDefault();
        $(this).before("<input name='gl_doc_hashtag[]' id='gl_doc_hashtag' type='text' class='form-control mt-2' placeholder='ระบุ แฮชแท็กของไฟล์เอกสาร เช่น #เอกสารทั่วไป #ประกาศบริษัท' required maxlength='40'/>");
    });


    $('.dar_addmore').click(function (e) {
        e.preventDefault();
        $(this).before("<input name='li_hashtag[]' id='li_hashtag' type='text' class='form-control mt-2' placeholder='กรุณาระบุ Hashtag เช่น #คู่มือการใช้งาน' required maxlength='40'/><label id='characterLeft'></label><br>");
    });



    if ($('#check_group').val() == "user" || $('#check_status_gldoc').val() == "Approved") {
        $('a#up_file_gl').prop({ 'href': '#', 'target': '_self' });
        $('input[type=radio][name=gl_doc_status],#gl_doc_reson_detail,#gl_doc_approve_by,#btn_save2').prop('disabled', true);
    }

    // Check section for document control
    if ($('#check_group').val() != "document control" && $('#check_group').val() != "superuser") {
        $('input[type=radio][name=gl_doc_status],#gl_doc_reson_detail,#gl_doc_approve_by,#btn_save2').prop('disabled', true);
    }
    


    // Permission Genaral document









    // Permission Group
    if ($('#check_group').val() == "it" || $('#check_group').val() == "admin" || $('#check_group').val() == "document control") {
        $('li#admin_section').css("display", "inline");
    }



    if ($('#check_group').val() == "user" && $('#check_data_status').val() == "Open" || $('#check_group').val() == "user" && $('#check_data_status').val() == "Manager Approved" || $('#check_group').val() == "user" && $('#check_data_status').val() == "Complete" || $('#check_group').val() == "user" && $('#check_data_status').val() == "Manager Not Approve" || $('#check_group').val() == "user" && $('#check_data_status').val() == "Qmr Approved" || $('#check_group').val() == "user" && $('#check_data_status').val() == "Qmr Not Approve") {
        //ถ้าสิทธิ์เท่ากับ User จะทำการ Disable ฟิลส่วนของ Manager และ Document Controller

        $('a#up_file').prop({ 'href': '#', 'target': '_self' });
        $('a#dc_data_file').prop({ 'href': '#', 'target': '_self' });
        $('input[type=radio],#gl_doc_reson_detail,#gl_doc_hashtag,#btnAddMore,#gl_doc_approve_by,#btn_save2').prop('disabled', true);
        $('#dc_data_result_reson_detail,#dc_data_approve_mgr,#btnSave_sec2,#dc_data_result_reson_detail2,#dc_data_approve_qmr,#btnSave_sec3,#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave,#dar_addmore').prop('disabled', true);

        // Check Manager Section
    } else if ($('#check_group').val() == "manager" && $('#check_data_status').val() == "Open") {
        $('a#up_file').prop({ 'href': '#', 'target': '_self' });
        // $('a#dc_data_file').prop({'href':'#','target':'_self'});

        $('input[name=dc_data_result_reson_status2],#gl_doc_reson_detail,#gl_doc_hashtag,#btnAddMore,#gl_doc_approve_by,#btn_save2').prop('disabled', true);
        $('#dc_data_result_reson_detail2,#dc_data_approve_qmr,#btnSave_sec3,#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave,#dar_addmore').prop('disabled', true);

    } else if ($('#check_group').val() == "manager" && $('#check_data_status').val() == "Manager Approved" || $('#check_group').val() == "manager" && $('#check_data_status').val() == "Qmr Approved" || $('#check_group').val() == "manager" && $('#check_data_status').val() == "Manager Not Approve" || $('#check_group').val() == "manager" && $('#check_data_status').val() == "Qmr Not Approve") {

        $('a#up_file').prop({ 'href': '#', 'target': '_self' });
        $('a#dc_data_file').prop({ 'href': '#', 'target': '_self' });

        $('input[name=dc_data_result_reson_status2],#gl_doc_reson_detail,#gl_doc_hashtag,#btnAddMore,#gl_doc_approve_by,#btn_save2').prop('disabled', true);
        $('#dc_data_result_reson_detail2,#dc_data_approve_qmr,#btnSave_sec3,#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave,#dar_addmore').prop('disabled', true);
        // Check Manager Section



        // Check QMR Section
    } else if ($('#check_group').val() == "qmr" && $('#check_data_status').val() == "Open" || $('#check_group').val() == "qmr" && $('#check_data_status').val() == "Complete" || $('#check_group').val() == "qmr" && $('#check_data_status').val() == "Manager Not Approve" || $('#check_group').val() == "qmr" && $('#check_data_status').val() == "Qmr Approved" || $('#check_group').val() == "qmr" && $('#check_data_status').val() == "Qmr Not Approve") {
        $('a#up_file').prop({ 'href': '#', 'target': '_self' });
        $('a#dc_data_file').prop({ 'href': '#', 'target': '_self' });
        $('input[type=radio],#gl_doc_reson_detail,#gl_doc_hashtag,#btnAddMore,#gl_doc_approve_by,#btn_save2').prop('disabled', true);
        $('#dc_data_result_reson_detail,#dc_data_approve_mgr,#btnSave_sec2,#dc_data_result_reson_detail2,#dc_data_approve_qmr,#btnSave_sec3,#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave,#dar_addmore').prop('disabled', true);

    } else if ($('#check_group').val() == "qmr" && $('#check_data_status').val() == "Manager Approved") {
        // $('a#dc_data_file').removeProp();
        $('#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave,#dar_addmore').prop('disabled', true);
    }
    // Check QMR Section



    // Check document control section
    if ($('#check_group').val() == "document control" && $('#check_data_status').val() != "Qmr Approved") {
        $('a#up_file').prop({ 'href': '#', 'target': '_self' });
        $('a#dc_data_file').removeProp({ 'href': '#', 'target': '_self' });
        // $('input[type=radio],#gl_doc_reson_detail,#gl_doc_hashtag,#btnAddMore,#gl_doc_approve_by,#btn_save2').prop('disabled',true);
        $('#dc_data_result_reson_detail,#dc_data_approve_mgr,#btnSave_sec2,#dc_data_result_reson_detail2,#dc_data_approve_qmr,#btnSave_sec3,#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave').prop('disabled', true);
    } else if ($('#check_group').val() == "document control" && $('#check_data_status').val() == "Qmr Approved") {
        $('a#up_file').prop({ 'href': '#', 'target': '_self' });

        // $('input[type=radio],#gl_doc_reson_detail,#gl_doc_hashtag,#btnAddMore,#gl_doc_approve_by,#btn_save2').prop('disabled',true);
        $('#dc_data_result_reson_detail,#dc_data_approve_mgr,#btnSave_sec2,#dc_data_result_reson_detail2,#dc_data_approve_qmr,#btnSave_sec3').prop('disabled', true);

    } else if ($('#check_group').val() == "superuser" && $('#check_data_status').val() != "Qmr Approved") {

        $('#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave').prop('disabled', true);

    } else if ($('#check_group').val() == "manager" && $('#check_data_status').val() != "Qmr Approved") {
        $('#document_master,#document_copy,#dc_data_method,#dc_data_operation,#btnOpsave').prop('disabled', true);
    }
    // Check document control section





    // Check Permission สำหรับเอกสาร ISO
    if ($('#get_check_deptcode').val() != $('#check_new_deptcode').val()) {
        $('.check_option').prop('disabled', true);
    }





    // Search document Section
    $('#form_search_by_hashtag').hide();
    $('#form_search_by_date').hide();
    $('#form_search_by_docname').hide();
    $('#form_search_by_doccode').hide();
    $('#form_search_by_darcode').hide();

    $('#doc_search_method').change(function () {
        var doc_search_method = $('#doc_search_method').val();

        if (doc_search_method == "search_by_hashtag") {
            $('#form_search_by_hashtag').show();
        } else {
            $('#form_search_by_hashtag').hide();
        }

        if (doc_search_method == "search_by_date") {
            $('#form_search_by_date').show();
        } else {
            $('#form_search_by_date').hide();
        }

        if (doc_search_method == "search_by_docname") {
            $('#form_search_by_docname').show();
        } else {
            $('#form_search_by_docname').hide();
        }

        if (doc_search_method == "search_by_doccode") {
            $('#form_search_by_doccode').show();
        } else {
            $('#form_search_by_doccode').hide();
        }

        if (doc_search_method == "search_by_darcode") {
            $('#form_search_by_darcode').show();
        } else {
            $('#form_search_by_darcode').hide();
        }


    });
    // Search document Section



    if ($('#check_tag').val() == 1) {
        $('#hashtag').css("display", "block");
        $('#result').css("display", "none");
    } else {
        $('#result').css("display", "block");
    }







    // Check lib pending status
    if ($('#check_lib_status').val() == "pending") {
        $('.check_option').prop('disabled', true);
    }
    // Check lib pending status






    // search zone



    // search zone



    // Check status for control every thing : Check status for control every thing

    if ($('#check_data_status').val() == 'Open') {
        // check status for hide section qmr approve and dcc approve
        $('#qmr_approve').css("display", "none");
        $('#dcc_approve').css("display", "none");

        if ($('#check_group').val() != 'manager' && $('#check_group').val() != 'superuser') {
            $('#manager_approve').css("display", "none");
        }
        // check status for hide section qmr approve and dcc approve

    } else if ($('#check_data_status').val() == 'Manager Approved') {
        // Check status for hide section dcc approve
        $('#dcc_approve').css("display", "none");

        if ($('#check_group').val() != 'qmr' && $('#check_group').val() != 'superuser') {
            $('#qmr_approve').css("display", "none");
        }
        // Check status for hide section dcc approve
    } else if ($('#check_data_status').val() == 'Qmr Approved') {

        if ($('#check_group').val() != 'document control' && $('#check_group').val() != 'superuser') {
            $('#dcc_approve').css("display", "none");
        }

    } else if ($('#check_data_status').val() == 'Qmr Not Approve') {

        $('#dcc_approve').css("display", "none");

    } else if ($('#check_data_status').val() == 'Manager Not Approve') {
        $('#qmr_approve').css("display", "none");
        $('#dcc_approve').css("display", "none");
    }

    // Check status for control every thing : Check status for control every thing











});
// Ready function














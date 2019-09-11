<!-- Modal แก้ไขแผนก-->
<div class="modal fade" id="edit_dept_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขแผนก</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Header -->

            <!-- Body -->
            <div class="modal-body">
                <form action="<?= base_url('staff/dept_update') ?>" name="" id="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">รหัสแผนก</label>
                            <input type="text" name="edit_gl_dept_code" id="edit_gl_dept_code" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">ชื่อแผนก</label>
                            <input type="text" name="edit_gl_dept_name" id="edit_gl_dept_name" class="form-control">
                        </div>
                        <input type="text" name="edit_gl_dept_id" id="edit_gl_dept_id" hidden>
                    </div>

            </div>
            <!-- Body -->

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="บันทึก" name="btnSaveEdit" class="btn btn-primary">
            </div>
            <!-- Footer -->
            </form>

        </div>
    </div>
</div>
<!-- Modal แก้ไขแผนก-->





<!-- แก้ไขสิทธิ์กลุ่มผู้ใช้งาน -->
<div class="modal fade" id="edit_permis_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขกลุ่มผู้ใช้งาน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Header -->

            <!-- Body -->
            <div class="modal-body">
                <form action="<?= base_url('staff/save_edit_group') ?>" name="" id="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">ชื่อผู้ใช้</label>
                            <input readonly type="text" name="get_user_permis" id="get_user_permis" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">ชื่อแผนก</label>
                            <input readonly type="text" name="get_gl_dept_name" id="get_gl_dept_name" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">กลุ่มผู้ใช้งาน</label>
                            <input readonly type="text" name="get_group_permis" id="get_group_permis" class="form-control">
                            <select name="edit_group_permis" id="edit_group_permis" class="form-control mt-2">
                                <option value="">เลือกกลุ่มที่ต้องการ</option>
                                <?php
                                $getgroupall = get_group_all();
                                foreach ($getgroupall->result_array() as $gta) {
                                    echo "<option value='" . $gta['dc_gp_permis_code'] . "'>" . $gta['dc_gp_permis_name'] . "</option>";
                                } ?>
                            </select>
                            <input hidden type="text" name="get_gl_user_id" id="get_gl_user_id">
                        </div>

                    </div>
            </div>
            <!-- Body -->

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="บันทึก" name="btnSaveEdit_group" class="btn btn-primary">
            </div>
            <!-- Footer -->
            </form>

        </div>
    </div>
</div>
<!-- แก้ไขสิทธิ์กลุ่มผู้ใช้งาน -->



<!-- แก้ไขข้อมูลผู้ใช้ -->
<div class="modal fade" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขข้อมูลผู้ใช้</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Header -->

            <!-- Body -->
            <div class="modal-body">
                <form action="<?= base_url('staff/save_edit_user') ?>" name="" id="" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">ชื่อผู้ใช้(Eng)</label>
                            <input  type="text" name="get_fname_edit" id="get_fname_edit" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">นามสกุล(Eng)</label>
                            <input  type="text" name="get_lname_edit" id="get_lname_edit" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                            <label for="">รหัสพนักงาน(Eng)</label>
                            <input  type="text" name="get_ecode_edit" id="get_ecode_edit" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">อีเมล์</label>
                            <input  type="text" name="get_email_edit" id="get_email_edit" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                    <div class="form-group col-md-6">
                            <label for="">ชื่อแผนก(Eng)</label>
                            <input  type="text" name="get_deptname_edit" id="get_deptname_edit" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">รหัสแผนก</label>
                            <input  type="text" name="get_deptcode_edit" id="get_deptcode_edit" class="form-control">
                        </div>
                        <input type="text" name="get_userid_edit" id="get_userid_edit">
                    </div>
            </div>
            <!-- Body -->

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" value="บันทึก" name="btnSaveUser_edit" class="btn btn-primary">
            </div>
            <!-- Footer -->
            </form>

        </div>
    </div>
</div>
<!-- แก้ไขข้อมูลผู้ใช้ -->




<!-- Reason Detail modal -->
<div class="modal fade" id="reason_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">


            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">รายละเอียดการร้องขอ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Header -->

            <!-- Body -->
            <div class="modal-body">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">รายละเอียดการร้องขอ</label>
                            <textarea readonly class="form-control" name="data_reason_detail_show" id="data_reason_detail_show" cols="30" rows="5"></textarea>
                        </div>
                    </div>
            </div>
            <!-- Body -->


        </div>
    </div>
</div>
<!-- Reason Detail modal -->
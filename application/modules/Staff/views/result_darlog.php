<table id="dar_log_sheet" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:50px;">No.</th>
                            <th style="width:150px;">Date</th>
                            <th style="width:200px;">DAR No.</th>
                            <th>Document No.</th>
                            <th>Rev.</th>
                            <th>Document Name</th>
                            <th>Remark</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($get_list->result_array() as $rslist) {


                            ?>



                            <!-- Change color status -->
                            <?php
                            if ($rslist['dc_data_status'] == "Manager Approved" || $rslist['dc_data_status'] == "Qmr Approved" || $rslist['dc_data_status'] == "Complete") {
                                $tdcolor = '  style="color:green"  ';
                            } else if ($rslist['dc_data_status'] == "Manager Not Approve" || $rslist['dc_data_status'] == "Qmr Not Approve") {
                                $tdcolor = '  style="color:red"  ';
                            } else if ($rslist['dc_data_status'] == "Open") {
                                $tdcolor = '  style="color:#33CCFF"  ';
                            } else {
                                $tdcolor = '';
                            }

                           
                            if($rslist['dc_data_status'] == "Creating DAR"){
                                $linkpage = "add_dar2/";
                            }else{
                                $linkpage = "viewfull/";
                            }
                                
                            ?>


                            <tr>
                                <td></td>
                                <td><?= con_date($rslist['dc_data_date'] )?></td>
                                <td><?= $rslist['dc_data_darcode']; ?></td>
                                <td><?= $rslist['dc_data_doccode']; ?></td>
                                <td><?= $rslist['dc_data_edit']; ?></td>
                                <td><?= $rslist['dc_data_docname']; ?></td>
                                <td><?= $rslist['dc_reason_name']; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
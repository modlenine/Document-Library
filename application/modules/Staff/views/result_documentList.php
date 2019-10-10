<table id="docList" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:50px;">No.</th>
                            <th style="width:150px;">Document No.</th>
                            <th>Document Type.</th>
                            <th style="width:200px;">Document Name.</th>
                            <th>Rev.</th>
                            <th>Register Date.</th>
                            <th>Effective Date.</th>
                            <th>DAR No.</th>
                            <th>Disposition</th>
                            <th>Department Distribution</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($get_list->result_array() as $rslist) {
                            $i = 1;

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


                                if ($rslist['dc_data_status'] == "Creating DAR") {
                                    $linkpage = "add_dar2/";
                                } else {
                                    $linkpage = "viewfull/";
                                }

                                ?>


                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $rslist['dc_data_doccode_display']; ?></td>
                                <td><?= $rslist['dc_sub_type_name']; ?></td>
                                <td><?= $rslist['dc_data_docname']; ?></td>
                                <td><?= $rslist['dc_data_edit']; ?></td>
                                <td><?= con_date($rslist['dc_data_date']) ?></td>
                                <td><?= con_date($rslist['dc_data_date_start']) ?></td>
                                <td><?= $rslist['dc_data_darcode']; ?></td>
                                <td><?= $rslist['dc_data_store'] . "&nbsp;" . $rslist['dc_data_store_type']; ?></td>
                                <td>
                                    <?php

                                        foreach (get_related_use($rslist['dc_data_darcode'])->result_array() as $get_ru) {
                                            echo $get_ru['related_dept_name'] . "&nbsp;,&nbsp;";
                                        } ?>
                                </td>

                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
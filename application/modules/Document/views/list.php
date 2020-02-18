<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= label("ld_title", $this); ?></title>

</head>

<body>

    <div class="app-main__outer">
        <!-- Content Zone -->
        <div class="app-main__inner">
            <!-- Content Zone -->

            <div class="container-fulid border p-4 bg-white">

                <h1 style="text-align:center;"><?= label("h1text", $this); ?></h1>

                <table id="view_dar" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:50px;"><?=label('id',$this);?></th>
                            <th style="width:150px;">เลขที่ใบ DAR</th>
                            <th style="width:200px;">รหัสเอกสาร</th>
                            <th><?=label('td_doctype',$this);?></th>
                            <th><?=label('td_daterequest',$this);?></th>
                            <th><?=label('td_userrequest',$this);?></th>
                            <th><?=label('td_reson',$this);?></th>
                            <th style="width:100px;"><?=label('td_status',$this);?></th>
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
                                <td><a href="<?= base_url();?>document/<?=$linkpage?><?= $rslist['dc_data_darcode']; ?>"><i class="fas fa-book-open"></i>&nbsp;&nbsp;<?= $rslist['dc_data_darcode']; ?></a></td>
                                <td><?= $rslist['dc_data_doccode']; ?></td>
                                <td><?= $rslist['dc_sub_type_name']; ?></td>
                                <td><?= con_date($rslist['dc_data_date'] )?></td>
                                <td><i class="fas fa-user"></i>&nbsp;&nbsp;<?= $rslist['dc_data_user']; ?></td>
                                <td><?= $rslist['dc_reason_name']; ?></td>
                                <td <?= $tdcolor ?>><?= $rslist['dc_data_status'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

       </div><!-- Content Zone -->
    </div><!-- Content Zone -->

</body>
<script type="text/javascript">

    $(document).ready(function() {

        var t = $('#view_dar').DataTable({
            "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
            "order": [
                [0, 'desc']
            ]
        });

        t.on('order.dt search.dt', function() {
            t.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();



    });
</script>


</html>
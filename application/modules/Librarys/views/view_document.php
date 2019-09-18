<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Document</title>
</head>

<body>

    <div class="app-main__outer">
        <!-- Content Zone -->
        <div class="app-main__inner mb-5">
            <!-- Content Zone -->
            <div class="container-fulid border p-4 bg-white">
                <!-- Main Section -->
                <table id="view_doc" class="table table-striped table-bordered dt-responsive" style="width:100%">
                    <thead>
                        <tr>

                            <th>#</th>
                            <th>รหัสเอกสาร</th>
                            <th>เลขที่ใบ DAR</th>
                            <th>ชื่อเอกสาร</th>
                            <th>วันที่ร้องขอ</th>
                            <th>ชื่อไฟล์</th>
                            
                        </tr>
                    </thead>

                    <tbody>

                        <?php $i = 1;
                        foreach ($get_file1->result_array() as $get_file1s) { ?>
                            <tr>

                                <th scope="row"><?= $i ?></th>
                                <td><a href="<?= base_url('librarys/viewFull_document/') ?><?=$get_file1s['dc_data_sub_type'];?>/<?=$get_file1s['related_dept_code'];?>/<?=$get_file1s['dc_data_doccode'];?>"><b><?= $get_file1s['dc_data_doccode_display'] ?></b>&nbsp;&nbsp;<i class="fas fa-binoculars text-success" style="font-size:16px;"></i></a></td>
                                <td><?= $get_file1s['dc_data_darcode'] ?></td>
                                <td><?= $get_file1s['dc_data_docname'] ?></td>
                                <td><?= con_date($get_file1s['dc_data_date']) ?></td>
                                <td><?= $get_file1s['lib_main_doccode_copy'] ?></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>


</body>
<script type="text/javascript">
    $(document).ready(function() {

        var t = $('#view_doc').DataTable({
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/variable-pie.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>

</head>

<body>

    <div class="app-main__outer">
        <!-- Content Zone -->
        <div class="app-main__inner mb-5">
            <!-- Content Zone -->
            <div class="container border p-4 bg-white">
                <!-- Main Section -->
                <!-- <div class="row">
    <div class="col-md-6">
     <?= get_graph1() ?>
    </div>

    <div class="col-md-6">
    <?= get_graph2() ?>
    </div>
</div> -->

                <div class="row">
                    <div class="col-md-6">
                        <a href="<?=base_url('librarys/view_by_dept')?>"><button class="btn btn-primary btn-block" style="font-size:20px;padding:15px;">ค้นหาเอกสาร ISO</button></a>
                    </div>
                    <div class="col-md-6">
                        <a href="<?=base_url('librarys/document_center')?>"><button class="btn btn-primary btn-block" style="font-size:20px;padding:15px;">ค้นหาเอกสารทั่วไป</button></a>
                    </div>
                </div><br><br>
                <hr>


                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <h1>ประกาศ</h1>
                                This is some text within a card body.
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>

</body>

</html>
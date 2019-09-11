<?php

require_once('rotation.php');

// initiate FPDI
$pdf = new PDF_Rotate();
$text = "";
$file = "../".$_POST['copy_docfile'];

// get the page count
$pageCount = $pdf->setSourceFile($file);
// iterate through all pages
for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    // import a page
    $templateId = $pdf->importPage($pageNo);
    // get the size of the imported page
    $size = $pdf->getTemplateSize($templateId);

    // create a page (landscape or portrait depending on the imported page size)
    if ($size['w'] > $size['h']) {
        $pdf->AddPage('L', array($size['w'], $size['h']));
    } else {
        $pdf->AddPage('P', array($size['w'], $size['h']));
    }

    // use the imported page
    $pdf->useTemplate($templateId);
    $pdf->Image('http://203.107.156.180/intsys/it_system/asset/image/CopyWaterMark.png', 60, 100, 100, 0, 'PNG');
    $pdf->SetFont('Helvetica','B',50);
    $pdf->SetTextColor(207, 207, 207);
    $pdf->SetXY(170, 200);
    $pdf->RotatedText(60, 200,$text, 45);
    // $pdf->Write(8, 'A complete document imported with FPDI');
}

$cutFileLocation = substr($_POST['copy_docfile'],21);
// Output the new PDF
$pdf->Output("../asset/copy/".$cutFileLocation,'F');

$filedoccode = $_POST['copy_doccode'];
$filelocations = "asset/copy/".$cutFileLocation;

$connect = mysqli_connect("localhost" , "root" , "1234" , "dc");
mysqli_set_charset($connect, "utf8");
$sql = "INSERT INTO library_copy_file (lib_copy_doccode , lib_copy_file_location) VALUES ('$filedoccode','$filelocations')";
mysqli_query($connect,$sql);

echo "จัดเก็บไฟล์สำเร็จ";
header('Location: http://192.190.10.27/dc2/document/up_status2/'.$_POST['copy_doccode']);


 ?>

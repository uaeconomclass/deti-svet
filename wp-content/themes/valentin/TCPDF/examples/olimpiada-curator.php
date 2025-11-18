<?php
include '/home/y/yourpon6/deljfinenok.rf/public_html/wp-config.php';
require_once('/home/y/yourpon6/deljfinenok.rf/public_html/wp-content/themes/valentin/TCPDF/tcpdf.php');

// ---------------------------------------------
// Данные
$zayavka_id = $_GET["zid"];
/*$fields = get_field_objects($zayavka_id);
foreach ($fields as $field) {
    ${$field['name']} = $field['value'];
}
*/
$fields =get_post_meta($zayavka_id);
foreach ($fields as $key => $value) {
    if (strpos($key, '_') === 0) continue;
    ${$key} = $value[0];
}

$diplom_number = get_the_title($zayavka_id);

// ---------------------------------------------
// Класс PDF с динамическим фоном
class MYPDF extends TCPDF {
    public $design;

    public function Header() {
        $this->SetAutoPageBreak(false, 0);
        $design = $this->design ?: 1; // фон №1 по умолчанию
        $img_file = K_PATH_IMAGES . 'olimpiada/big/olimpiadas' . $design . '.jpg';
        if (file_exists($img_file)) {
            $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        }
        $this->setPageMark();
    }
}

// ---------------------------------------------
// Создание PDF
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->design = $design;

$pdf->SetMargins(26, 85, 26);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$pdf->SetFont('freeserif', '', 15);

// ---------------------------------------------
// Контент
$html = "
<br><br>
№ $diplom_number<br>
Награждается<br>
<b><span id='curator2'>$curator</span></b><br>
<span id='curators_position2'>$curators_position</span><br>
<span id='ou2'>$ou</span><br>
<span id='oblast2'>$oblast</span><br>
<span id='place2'>$place</span><br><br>
за подготовку победителя<br>
во Всероссийской онлайн-олимпиаде для школьников<br>
“<b><span id='nazvanie_konkursa2'>$nazvanie_konkursa</span></b>”<br>
Победитель олимпиады:<br>
<b><span id='name2'>$name</span></b><br>
<span id='klass2'>$klass</span><br>
<span id='age2'>$age</span><br>
<span id='data2'>$data</span><br>
";

$pdf->writeHTML($html, true, false, true, false, 'C');

// ---------------------------------------------
$pdf->Output('diplom.pdf', 'I');

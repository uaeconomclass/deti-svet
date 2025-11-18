<?php
include '/home/y/yourpon6/deljfinenok.rf/public_html/wp-config.php';
require_once('/home/y/yourpon6/deljfinenok.rf/public_html/wp-content/themes/valentin/TCPDF/tcpdf.php');

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

// --------------------------------------------------
// Класс PDF с динамическим фоном
class MYPDF extends TCPDF {
    public $design;
    public function Header() {
        $this->SetAutoPageBreak(false, 0);
        $design = $this->design ?: 1; // если не задано — фон №1
        $img_file = K_PATH_IMAGES.'olympiadadeti/big/olympiadadeti'.$design.'.jpg';
        if (file_exists($img_file)) {
            $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        }
        $this->setPageMark();
    }
}
// --------------------------------------------------

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->design = $design;

$pdf->SetMargins(26, 80, 26);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$pdf->SetFont('freeserif', '', 16);

// ---------------- Контент ----------------
$curator_html = '';
if (!empty($curator)) {
    if (!empty($curators_position)) {
        $curator_html = "<span id='curators_position2'>$curators_position:</span><br> <b><span id='curator2'>$curator</span></b><br>";
    } else {
        $curator_html = "Куратор: <b><span id='curator2'>$curator</span></b><br>";
    }
}

$competition_level_html = !empty($competition_level) ? $competition_level : 'Во Всероссийской';

$html = "
<br><br>
№ $diplom_number<br>
Награждается<br>
<b><span id='name2'>$name</span></b><br>
<span id='age2'>$age</span><br>
<span id='ou2'>$ou</span><br>
<span id='oblast2'>$oblast</span><br>
<span id='place2'>$place</span><br><br>
<span id='mesto2'><b>$mestoLabel</b></span><br><br>
$competition_level_html онлайн-олимпиаде<br>
для детей<br>
с Международным участием<br>
“<b><span id='nazvanie_konkursa2'>$nazvanie_konkursa</span></b>”<br>
на сайте https://дельфиненок.рф<br>
$curator_html
<span id='data2'>$data</span><br>
";

$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('diplom.pdf', 'I');

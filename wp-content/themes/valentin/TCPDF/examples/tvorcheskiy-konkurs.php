<?php
include '/home/y/yourpon6/yourpon6.beget.tech-59/public_html/wp-config.php';
require_once('/home/y/yourpon6/yourpon6.beget.tech-59/public_html/wp-content/themes/valentin/TCPDF/tcpdf.php');

// Отключаем вывод предупреждений, чтобы PDF не ломался
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ob_clean();

$zayavka_id = $_GET["zid"] ?? 0;
if (!$zayavka_id) exit('Нет ID диплома.');

// Получаем все метаполя
$fields = get_post_meta($zayavka_id);
foreach ($fields as $key => $value) {
    if (strpos($key, '_') === 0) continue;
    ${$key} = $value[0];
}

// Безопасное значение для номинации
$nominaciya = !empty($nominaciya) ? $nominaciya : '';
$diplom_number = get_the_title($zayavka_id);

// --------------------------------------------------
// Класс PDF с динамическим фоном
class MYPDF extends TCPDF {
    public $design;
    public function Header() {
        $this->SetAutoPageBreak(false, 0);
        $design = $this->design ?: 1;
        $img_file = K_PATH_IMAGES . 'diplomtk/diplomtk' . $design . '.jpg';
        if (file_exists($img_file)) {
            $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        }
        $this->setPageMark();
    }
}
// --------------------------------------------------

$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->design = $design ?? 1;

$pdf->SetMargins(26, 80, 26);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$pdf->SetFont('freeserif', '', 16);

// Контент
$curator_html = '';
if (!empty($curator)) {
    if (!empty($curators_position)) {
        $curator_html = "<span id='curators_position2'>$curators_position:</span><br><b>$curator</b><br>";
    } else {
        $curator_html = "<b>$curator</b><br>";
    }
}

$competition_level_html = !empty($competition_level) ? $competition_level : 'Во Всероссийском';

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
$competition_level_html творческом конкурсе<br>
с международным участием<br> 
“<b><span id='nazvanie_konkursa2'>$nazvanie_konkursa</span></b>”<br>
Номинация: “<b><span id='nominaciya2'>$nominaciya</span></b>”<br>
Название работы: “<b><span id='nkr2'>$nkr</span></b>”<br>
$curator_html
<span id='data2'>$data</span><br>
";

$pdf->writeHTML($html, true, false, true, false, 'C');
// ---------------- QR-код ----------------
// Створюємо URL для QR-коду з поточною адресою
$qr_url = "https://quickchart.io/qr?chs=300x300&text=" . urlencode($uploaded_file_url);

$qr_width  = 30;
$qr_height = 30;
$qr_x = 21; // 10 мм от правого края
$qr_y = 228; 


$pdf->Image($qr_url, $qr_x, $qr_y, $qr_width, $qr_height, 'PNG');

// Очистим буфер перед выводом PDF
ob_end_clean();

// Ключевые заголовки
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="diplom.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

$pdf->Output('diplom.pdf', 'I');

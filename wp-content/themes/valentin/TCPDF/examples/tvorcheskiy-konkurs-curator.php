<?php
include '/home/y/yourpon6/yourpon6.beget.tech-59/public_html/wp-config.php';
require_once('/home/y/yourpon6/yourpon6.beget.tech-59/public_html/wp-content/themes/valentin/TCPDF/tcpdf.php');

// ---------------------------------------------
// Безопасные настройки — чтобы PDF не ломался от предупреждений
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ob_clean();

// ---------------------------------------------
// Получаем данные диплома
$zayavka_id = $_GET["zid"] ?? 0;
if (!$zayavka_id) exit('❌ Нет ID диплома.');

$fields = get_post_meta($zayavka_id);
foreach ($fields as $key => $value) {
	if (strpos($key, '_') === 0) continue;
	${$key} = $value[0];
}

$diplom_number = get_the_title($zayavka_id);
$nominaciya = !empty($nominaciya) ? $nominaciya : '';
$nazvanie_konkursa = !empty($nazvanie_konkursa) ? $nazvanie_konkursa : '';
$name = !empty($name) ? $name : '';
$age = !empty($age) ? $age : '';
$data = !empty($data) ? $data : '';
$curator = !empty($curator) ? $curator : '';
$curators_position = !empty($curators_position) ? $curators_position : '';
$ou = !empty($ou) ? $ou : '';
$oblast = !empty($oblast) ? $oblast : '';
$place = !empty($place) ? $place : '';
$design = !empty($design) ? $design : 1;

// ---------------------------------------------
// Класс PDF с динамическим фоном
class MYPDF extends TCPDF {
	public $design;

	public function Header() {
		$this->SetAutoPageBreak(false, 0);
		$design = $this->design ?: 1; // фон №1 по умолчанию
		$img_file = K_PATH_IMAGES . 'diplomtk/diplomtks' . $design . '.jpg';
		if (file_exists($img_file)) {
			$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		}
		$this->setPageMark();
	}
}

// ---------------------------------------------
// Создаём PDF
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->design = $design;

$pdf->SetMargins(26, 80, 26);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$pdf->SetFont('freeserif', '', 15);

// ---------------------------------------------
// Контент PDF
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
во Всероссийском творческом конкурсе<br>
с международным участием<br>
“<b><span id='nazvanie_konkursa2'>$nazvanie_konkursa</span></b>”<br>
Номинация: “<b><span id='nominaciya2'>$nominaciya</span></b>”<br>
Название работы: “<b><span id='nkr2'>$nkr</span></b>”<br>
Победитель конкурса:<br>
<b><span id='name2'>$name</span></b><br>
<span id='age2'>$age</span><br>
<span id='data2'>$data</span><br>
";

// ---------------------------------------------
// Генерация
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

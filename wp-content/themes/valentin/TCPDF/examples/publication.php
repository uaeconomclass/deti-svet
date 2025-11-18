<?php
// PDF диплома ПУБЛИКАЦИИ

include '/home/y/yourpon6/yourpon6.beget.tech-59/public_html/wp-config.php';
require_once('/home/y/yourpon6/yourpon6.beget.tech-59/public_html/wp-content/themes/valentin/TCPDF/tcpdf.php');

// Чтобы PDF не ломался от warning’ов
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
ob_clean();

// Получаем ID заявки
$zayavka_id = $_GET["zid"] ?? 0;
if (!$zayavka_id) exit('Нет ID диплома.');

// Получаем заполненные поля заявки (как в педконкурсе)
$fields = get_post_meta($zayavka_id);
foreach ($fields as $key => $value) {
	if ($key[0] === '_') continue;
	${$key} = $value[0];
}

// Поддержка альтернативной номинации
if (!empty($asdnominaciya)) {
	$nominaciya = $asdnominaciya;
}

// Номер диплома = заголовок поста
$diplom_number = get_the_title($zayavka_id);

// URL загруженного файла (если есть)
$uploaded_file_url = $uploaded_file_url ?? '';

// --------------------------------------------------
// Класс TCPDF с динамическим фоном ПУБЛИКАЦИИ
class MYPDF extends TCPDF {
	public $design;
	public function Header() {

		$this->SetAutoPageBreak(false, 0);

		$design = $this->design ?: 1;

		// фон публикации
		$img_file = K_PATH_IMAGES . 'publication/publication' . $design . '.jpg';

		if (file_exists($img_file)) {
			$this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
		}

		$this->setPageMark();
	}
}
// --------------------------------------------------

// PDF
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->design = $design ?? 1;

$pdf->SetMargins(26, 80, 26);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
$pdf->AddPage();
$pdf->SetFont('freeserif', '', 16);

// -------------------- HTML ДИПЛОМА ПУБЛИКАЦИИ --------------------
$html = "
<br><br>
№ $diplom_number<br>
Настоящим подтверждается, что<br>

<b>$name</b><br>
$dolgnost<br>
$ou<br>
$oblast<br>
$place<br><br><br><br>

опубликовал(а) авторскую работу<br>
на сайте https://deti-svet.ru<br>
Номинация: “<b>$nominaciya</b>”<br>
Название работы: “<b>$nkr</b>”<br>

$data<br>
";

$pdf->writeHTML($html, true, false, true, false, 'C');

// -------------------- QR-КОД (как у педконкурса) --------------------
if (!empty($uploaded_file_url)) {

	$qr_url = "https://quickchart.io/qr?chs=300x300&text=" . urlencode($uploaded_file_url);

	$pdf->Image(
		$qr_url,
		21,    // X — точно как в образце
		228,   // Y — точно как в образце
		30,    // width
		30,    // height
		'PNG'
	);
}

// Очистим буфер перед выводом PDF
ob_end_clean();

// Ключевые заголовки
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="diplom.pdf"');
header('Cache-Control: private, max-age=0, must-revalidate');
header('Pragma: public');

$pdf->Output('diplom.pdf', 'I');

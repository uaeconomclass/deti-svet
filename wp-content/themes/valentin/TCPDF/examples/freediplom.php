<?php
include '/home/y/yourpon6/deljfinenok.rf/public_html/wp-config.php';
require_once('/home/y/yourpon6/deljfinenok.rf/public_html/wp-content/themes/valentin/TCPDF/tcpdf.php');

// ---------------------------------------------
// Создание новой заявки (CPT free__request)
$id = wp_insert_post([
    'post_title'  => 'Бесплатная заявка',
    'post_type'   => 'free__request',
    'post_status' => 'publish',
]);

if ($id) {
    wp_update_post([
        'ID'         => $id,
        'post_title' => 'Бесплатная заявка ' . $id,
    ]);

    foreach ($_GET as $key => $value) {
        $value = str_replace('\"', '&quot;', $value);
        ${$key} = $value;
        //update_field($key, $value, $id);
		update_post_meta($id, $key, $value);
    }
}

// ---------------------------------------------
// Класс PDF с фоном
class MYPDF extends TCPDF {
    public $design;

    public function Header() {
        $this->SetAutoPageBreak(false, 0);
        $design = $this->design ?: '';
        $img_file = K_PATH_IMAGES . 'diplom-free/big/diplom-free' . $design . '.jpg';
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

$pdf->SetMargins(26, 80, 26);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
$pdf->AddPage();

$pdf->SetFont('freeserif', '', 16);

// ---------------------------------------------
// Контент
$html = "
<br><br>
Настоящее свидетельство<br>
подтверждает, что<br><br>
<b><span id='name2'>$name</span></b><br>
<span id='dolgnost2'>$dolgnost</span><br>
<span id='ou2'>$ou</span><br>
<span id='oblast2'>$oblast</span><br>
<span id='place2'>$place</span><br>
Пользователь зарегистрирован на сайте<br>
<b>Дельфиненок.рф</b><br>
и прошел обучение по работе<br>
с онлайн-сервисом сайта<br>
<span id='data2'>$data</span><br>
";

$pdf->writeHTML($html, true, false, true, false, 'C');

// ---------------------------------------------
// Вывод PDF
$pdf->Output('diplom.pdf', 'I');

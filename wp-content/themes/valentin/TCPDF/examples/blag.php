<?php
include '/home/y/yourpon6/deljfinenok.rf/public_html/wp-config.php';
require_once('/home/y/yourpon6/deljfinenok.rf/public_html/wp-content/themes/valentin/TCPDF/tcpdf.php');

// --------------------------------------------------
// Клас PDF із динамічним фоном
class MYPDF extends TCPDF {
    public $design;
    public function Header() {
        $this->SetAutoPageBreak(false, 0);
        $design = $this->design ?: 1;
        $img_file = K_PATH_IMAGES . 'blag/big/blag' . $design . '.jpg';
        if (file_exists($img_file)) {
            $this->Image($img_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        }
        $this->setPageMark();
    }
}
// --------------------------------------------------

// Отримуємо поля заявки
$zayavka_id = $_GET['zid'];

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

$nominaciya = $asdnominaciya ?: $nominaciya;

$diplom_number = get_the_title($zayavka_id);

// --------------------------------------------------
// Створення PDF
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->design = $design ?? 1;

$pdf->SetMargins(26, 80, 26);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
$pdf->AddPage();
$pdf->SetFont('freeserif', '', 16);

// --------------------------------------------------

$competition_level_html = !empty($competition_level) ? $competition_level : 'профессиональную подготовку участников во Всероссийских творческих конкурсах.';

// Контент
$html = "
<br><br>
№ $diplom_number<br>
Награждается<br>
<b><span id='name2'>$name</span></b><br>
<span id='dolgnost2'>$dolgnost</span><br>
<span id='ou2'>$ou</span><br>
<span id='oblast2'>$oblast</span><br>
<span id='place2'>$place</span><br><br>

Сайт интернет - портала “Дельфиненок.рф”<br>
выражает благодарность за <br>
$competition_level_html<br>
Желаем дальнейших профессиональных успехов <br>
и творческого вдохновения.<br><br>
<span id='data2'>$data</span><br>
";

$pdf->writeHTML($html, true, false, true, false, 'C');
$pdf->Output('diplom.pdf', 'I');
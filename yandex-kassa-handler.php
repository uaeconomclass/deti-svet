<?php
include '/home/y/yourpon6/yourpon6.beget.tech-59/public_html/wp-config.php';

define('SITE_URL', 'https://deti-svet.ru');
define('THEME_PATH', SITE_URL . '/wp-content/themes/valentin/TCPDF/examples/');
define('FROM_EMAIL', 'noreply@deti-svet.ru');
define('BCC_EMAIL', 'delfinenok2019@yandex.ru');

$input = json_decode(file_get_contents("php://input"));
$payed_title = $input->object->description ?? '';
if (!$payed_title) exit('No description provided');

// 🔹 Находим пост
$post = get_page_by_title($payed_title, OBJECT, get_post_types());
if (!$post) exit('Post not found');

$post_id = $post->ID;

// 🔹 Обновляем стандартное метаполе "payed"
update_post_meta($post_id, 'payed', 'success');

// 🔹 Получаем тип поста и email
$post_type = get_post_type($post_id);
$email = get_post_meta($post_id, 'email', true);

// 🔹 Общий текст для всех писем
$qr_text = "
<br/><br/>Система QR-кодов теперь внедрена на всех проводимых конкурсах сайта 
<a href='https://deti-svet.ru/'>deti-svet.ru</a>.<br/>
Каждая загруженная вами работа имеет индивидуальный QR-код, размещённый на дипломе.<br/>
При сканировании кода смартфоном вы получите мгновенный доступ к своей работе.<br/><br/>
Пожалуйста, не отвечайте на это письмо. Наша почта для связи: 
<a href='mailto:delfinenok2019@yandex.ru'>yourportfolio@mail.ru</a><br/>
С уважением, команда сайта deti-svet.ru.рф<br/>
";

// 🔹 Карта пост-типов к их шаблонам PDF и названиям
$map = [
    '75let'          => ['title' => 'Оплата конкурса День Победы',       'file' => '75let.php'],
    'olimpiada_kids' => ['title' => 'Оплата олимпиады для детей',        'file' => 'olimpiada_kids.php'],
    'olimpiada'      => ['title' => 'Оплата олимпиады',                  'file' => 'olimpiada.php'],
    'onlinetest'     => ['title' => 'Оплата тестирования',               'file' => 'onlinetest.php'],
    'pedagogich-konkurs'    => ['title' => 'Оплата конкурса для педагогов',       'file' => 'pedagogich-konkurs.php'],
    'tvorcheskiy-konkurs'   => ['title' => 'Оплата творческого конкурса',       'file' => 'tvorcheskiy-konkurs.php'],
    'publication'    => ['title' => 'Оплата свидетельства о публикации', 'file' => 'publication.php'],
    'blag'    		=> 	['title' => 'Благодарность', 					 'file' => 'blag.php'],
];

// 🔹 Определяем тему и путь к файлу
$subject = $map[$post_type]['title'] ?? 'Оплата на сайте deti-svet.ru.рф';
$file = $map[$post_type]['file'] ?? "$post_type.php";
$link = THEME_PATH . $file . "?zid=$post_id";

// 🔹 Проверяем наличие поля куратора
$curator_link = '';
$curator_certificate = get_post_meta($post_id, 'curator_certificate', true);

if ($curator_certificate === 'on' && !empty($file)) {
    // Получаем имя без расширения, например "tvorcheskiy-konkurs"
    $base_name = pathinfo($file, PATHINFO_FILENAME);

    // Добавляем суффикс "-curator.php"
    $curator_file = $base_name . '-curator.php';
    $curator_path = $_SERVER['DOCUMENT_ROOT'] . '/wp-content/themes/valentin/TCPDF/examples/' . $curator_file;

    // Проверяем, существует ли шаблон куратора
    if (file_exists($curator_path)) {
        $curator_link = "<a href='" . THEME_PATH . $curator_file . "?zid={$post_id}'>
        Открыть страницу скачивания диплома куратора</a><br/><br/>";
    }
}



// 🔹 Формируем письмо
$message = "
Вы совершили оплату на сайте https://deti-svet.ru/<br/>
<a href='$link'>Открыть страницу скачивания диплома</a><br/><br/>
$curator_link
$qr_text
";

$headers = [
    "From: deti-svet.ru <" . FROM_EMAIL . ">",
    "Bcc: deti-svet.ru <" . BCC_EMAIL . ">",
    "Content-Type: text/html; charset=UTF-8",
];

// 🔹 Отправляем письмо
wp_mail($email, $subject, $message, $headers);
?>
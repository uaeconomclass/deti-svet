<?php // === Шорткод публикации: [publication design="1"] ===
function shortcode_publication($atts = []) {
	ob_start();

	// Атрибуты
	$atts = shortcode_atts([
		'design' => 1,
	], $atts);

	// Константы
	define('DESIGN_COUNT', 3);
	define('DESIGN_FOLDER', '/wp-content/themes/valentin/images/publication/');
	define('DESIGN_PREFIX', 'publication');
	define('PAYFORM_PRICE', 100.00);
	define('DEFAULT_DESIGN', (int)$atts['design']);

	// Загрузка файла
	$uploaded = false;
	$fileName = '';

	$uploadDir = trailingslashit(__DIR__) . 'uploads/';
	$finalDir  = trailingslashit(__DIR__) . 'final/';
	if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
	if (!is_dir($finalDir)) mkdir($finalDir, 0755, true);

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['myfile'])) {
		$originalName = basename($_FILES['myfile']['name']);
		$fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
		$maxSize = 20 * 1024 * 1024;
		$allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'ppt', 'pptx', 'zip', 'rar', 'mp4', 'mov', 'avi', 'mp3'];

		if ($_FILES['myfile']['size'] > $maxSize) {
			echo "<p style='color:red;'>❌ Файл слишком большой. Макс. 20 МБ.</p>";
		} elseif (!in_array($fileExt, $allowedExtensions)) {
			echo "<p style='color:red;'>❌ Недопустимый формат файла.</p>";
		} elseif ($_FILES['myfile']['error'] !== UPLOAD_ERR_OK) {
			echo "<p style='color:red;'>❌ Ошибка загрузки.</p>";
		} else {
			$uniquePrefix = uniqid('tmp_', true);
			$tempFileName = $uniquePrefix . '_' . $originalName;
			$tempPath = $uploadDir . $tempFileName;

			if (move_uploaded_file($_FILES['myfile']['tmp_name'], $tempPath)) {
				$uploaded = true;
				$fileName = $tempFileName;
				echo "<p style='color:green;'>✅ Файл загружен: " . htmlspecialchars($originalName) . "</p>";
			} else {
				echo "<p style='color:red;'>❌ Ошибка сохранения файла.</p>";
			}
		}
	}

	// Поля публикации
	$fields = [
		'name' => ['ФИО участника', true],
		'dolgnost' => ['Должность', true],
		'ou' => ['Наименование учреждения', true],
		'oblast' => ['Название области', true],
		'place' => ['Населённый пункт', true],
		'nominaciya' => ['Введите свою номинацию', true],
		'nkr' => ['Название публикации', true],
		'data' => ['Дата оформления', true],
		'email' => ['Ваш электронный адрес', true]
	];

	// COOKIE значения
	$values = [];
	foreach ($fields as $key => $_) {
		$values[$key] = $_COOKIE[$key] ?? '';
	}

	?>

<div class="wrapper"><div class="inwrapper"><div class="diplom-01">

<?php if (!$uploaded): ?>

<form method="POST" enctype="multipart/form-data" class="upload-form">
	<h3>Шаг 1. Загрузите файл публикации</h3>
	<input type="file" name="myfile" required>
	<button type="submit">Загрузить</button>
</form>

<?php else: ?>

<form class="dform" method="POST">
	<h3>Шаг 2. Заполните данные</h3>

	<?php foreach ($fields as $key => $item): ?>
		<?php list($placeholder, $required) = $item; ?>
		<div class="width-input">
			<label for="<?= $key ?>"><?= $placeholder ?></label>
			<input type="text"
			       id="<?= $key ?>"
			       name="<?= $key ?>"
			       placeholder="<?= $placeholder ?>"
			       value="<?= htmlspecialchars($values[$key]) ?>"
			       <?= $required ? 'required' : '' ?>>
		</div>
	<?php endforeach; ?>

	<input type="hidden" name="session_id" value="<?= session_id() ?>">
	<input type="hidden" name="uploaded_file" value="<?= htmlspecialchars($fileName) ?>">

</form>
<?php endif; ?>
</div>

<!-- === Превью диплома публикации === -->
<div class="diplom-100 publikaciya"
     style="background-image:url('<?= DESIGN_FOLDER . DESIGN_PREFIX . DEFAULT_DESIGN ?>.jpg')">

	№ 000 - 00000<br>
	Настоящим подтверждается, что<br>

	<b><span id="name2"><?= $values['name'] ?: 'Фамилия Имя Отчество' ?></span></b><br>
	<span id="dolgnost2"><?= $values['dolgnost'] ?: 'Должность' ?></span><br>
	<span id="ou2"><?= $values['ou'] ?: 'Учреждение' ?></span><br>
	<span id="oblast2"><?= $values['oblast'] ?: 'Область' ?></span><br>
	<span id="place2"><?= $values['place'] ?: 'Город' ?></span><br><br><br><br>

	опубликовал(а) авторскую работу<br>
	на сайте интернет-портала<br>
	https://deti-svet.ru<br>

	Номинация: “<b><span id="nominaciya2"><?= $values['nominaciya'] ?: 'Свободная номинация' ?></span></b>”<br>
	Название работы: “<b><span id="nkr2"><?= $values['nkr'] ?: 'Открытый урок' ?></span></b>”<br>

	<span id="data2"><?= $values['data'] ?: date('d.m.Y') ?></span>
</div>

<div class="payer">
	Стоимость свидетельства: <span id="mesto3"><?= PAYFORM_PRICE ?></span> руб.
	<div class="span-text">После успешной оплаты вы получите письмо со ссылкой на диплом.</div>
</div>

<?php if (is_user_logged_in()): ?>
	<a class="create-zaya redbutton" href="">Оплатить</a>
<?php else: ?>
	<div class="login-required" style="margin-top:20px; text-align:center;">
		<p><strong>Чтобы заказать свидетельство — войдите:</strong></p>
		<?= do_shortcode('[ultimatemember form_id="188"]'); ?>
	</div>
<?php endif; ?>

<?php get_sidebar('payform'); ?>

</div></div>

<script>
jQuery(function($) {
	const basePrice = <?= PAYFORM_PRICE ?>;

	const map = {
		'#name':'#name2', '#dolgnost':'#dolgnost2', '#ou':'#ou2', '#oblast':'#oblast2',
		'#place':'#place2', '#nominaciya':'#nominaciya2', '#nkr':'#nkr2', '#data':'#data2', '#email': ''
	};

	$.each(map, function(inp, out) {
		$(inp).on('input change', function() {
			let v = $(this).val();
			$(out).text(v);
			$.cookie($(this).attr('name'), v);
		});
	});

	$('.diplomtk, .publikaciya').css('background-image', 'url(<?= DESIGN_FOLDER . DESIGN_PREFIX ?><?= DEFAULT_DESIGN ?>.jpg)');
});
</script>

<script>window.postType='publication';</script>
<script src="<?= get_stylesheet_directory_uri(); ?>/js/create-zaya.js"></script>
<script src="<?= get_stylesheet_directory_uri(); ?>/js/validate.js"></script>

<?php
	return ob_get_clean();
}
add_shortcode('publication', 'shortcode_publication');

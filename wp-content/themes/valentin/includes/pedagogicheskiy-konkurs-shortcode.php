<?php
// === Шорткод диплома: [pedagogicheskiy_konkurs design="7"] ===
function shortcode_pedagogicheskiy_konkurs($atts = []) {
	ob_start();

	// --- Атрибуты ---
	$atts = shortcode_atts([
		'design' => 1,
	], $atts);

	// === Константы ===
	define('DESIGN_COUNT', 4);
	define('DESIGN_FOLDER', '/wp-content/themes/valentin/images/diplompk/');
	define('DESIGN_PREFIX', 'diplompk');
	define('PAYFORM_PRICE', 100.00); // фиксированная цена
	define('DEFAULT_DESIGN', (int)$atts['design']);

	// ============= ЗАГРУЗКА ФАЙЛА =============
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
			echo "<p style='color:red;'>❌ Файл слишком большой! Максимум — 20 МБ.</p>";
		} elseif (!in_array($fileExt, $allowedExtensions)) {
			echo "<p style='color:red;'>❌ Недопустимое расширение: " . implode(', ', $allowedExtensions) . "</p>";
		} elseif ($_FILES['myfile']['error'] !== UPLOAD_ERR_OK) {
			echo "<p style='color:red;'>❌ Ошибка загрузки (код: {$_FILES['myfile']['error']}).</p>";
		} else {
			$uniquePrefix = uniqid('tmp_', true);
			$tempFileName = $uniquePrefix . '_' . $originalName;
			$tempPath = $uploadDir . $tempFileName;

			if (move_uploaded_file($_FILES['myfile']['tmp_name'], $tempPath)) {
				$uploaded = true;
				$fileName = $tempFileName;
				echo "<p style='color:green;'>✅ Файл загружен: " . htmlspecialchars($originalName) . "</p>";
			} else {
				echo "<p style='color:red;'>❌ Не удалось сохранить файл.</p>";
			}
		}
	}

	// ===== ПЕДАГОГИЧЕСКИЕ ПОЛЯ =====
	$fields = [
		'name' => ['ФИО участника', true],
		'dolgnost' => ['Должность', true],
		'ou' => ['Наименование учреждения', true],
		'oblast' => ['Название области', true],
		'place' => ['Населённый пункт', true],
		'nazvanie_konkursa' => ['Название конкурса', true],
		'nominaciya' => ['Номинация', true],
		'nkr' => ['Название работы', true],
		'data' => ['Дата оформления', true],
		'email' => ['Ваш электронный адрес', true]
	];

	// === COOKIE ===
	$values = [];
	foreach ($fields as $key => $_) {
		$values[$key] = isset($_COOKIE[$key]) ? htmlspecialchars(stripslashes($_COOKIE[$key]), ENT_QUOTES, 'UTF-8') : '';
	}
	$saved_level = $_COOKIE['competition_level'] ?? 'Во Всероссийском';

	?>

<div class="wrapper"><div class="inwrapper"><div class="diplom-01">

<?php if (!$uploaded): ?>

<!-- === Шаг 1: Загрузка файла === -->
<form method="POST" enctype="multipart/form-data" class="upload-form">
	<h3>Шаг 1. Загрузите файл с вашей работой</h3>

	<input type="file" name="myfile" required accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.zip,.rar,.mp4,.mov,.avi,.mp3">
	<button type="submit">Загрузить</button>
</form>

<?php else: ?>

<!-- === Шаг 2: Данные пед. конкурса === -->
<form class="dform" method="POST">

	<h3>Шаг 2. Введите данные</h3>

	<?php foreach ($fields as $key => [$placeholder, $required]) : ?>
		<div class="width-input">
			<label for="<?= $key ?>"><?= $placeholder ?></label>
			<input type="text"
				   id="<?= $key ?>"
				   name="<?= $key ?>"
				   placeholder="<?= $placeholder ?>"
				   value="<?= $values[$key] ?: ($key === 'data' ? date('d.m.Y') : '') ?>"
				   <?= $required ? 'required' : '' ?>>
		</div>
	<?php endforeach; ?>

	<!-- Результат -->
	<div class="width-input">
		<label for="mesto">Выберите результат</label>
		<select name="mesto" id="mesto">
			<option value="100">I место</option>
			<option value="100">II место</option>
			<option value="100">III место</option>
			<option value="100">Участник</option>
		</select>
	</div>

	<!-- Уровень конкурса -->
	<?php
	$competition_levels = ['Во Всероссийском','В республиканском','В областном','В городском','В муниципальном'];
	?>
	<div class="width-input">
		<label for="competition_level">Уровень конкурса</label>
		<select name="competition_level" id="competition_level">
			<?php foreach ($competition_levels as $lvl): ?>
				<option value="<?= $lvl ?>" <?= $lvl === $saved_level ? 'selected' : '' ?>>
					<?= $lvl ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>

	<!-- Дизайн -->
	<div class="width-input" style="display:none;">
		<label for="design">Выберите дизайн</label>
		<select id="design" name="design">
			<?php for ($i = 1; $i <= DESIGN_COUNT; $i++): ?>
				<option value="<?= $i ?>" <?= $i === DEFAULT_DESIGN ? 'selected' : '' ?>>
					Дизайн <?= $i ?>
				</option>
			<?php endfor; ?>
		</select>
	</div>

	<input type="hidden" name="session_id" value="<?= session_id() ?>">
	<input type="hidden" name="mestoLabel" id="mestoLabel" value="I место">
	<input type="hidden" name="sum" id="sum" value="<?= PAYFORM_PRICE ?>">
	<input type="hidden" name="uploaded_file" value="<?= htmlspecialchars($fileName) ?>">

</form>
<?php endif; ?>
</div>

<!-- === Превью диплома === -->
<div class="diplom-100 diplomtk"
     style="background-image:url('<?= DESIGN_FOLDER . DESIGN_PREFIX . DEFAULT_DESIGN ?>.jpg')">

	№ 000 - 00000<br>
	Награждается<br>
	<b><span id="name2"><?= $values['name'] ?: 'Фамилия Имя Отчество' ?></span></b><br>
	<span id="dolgnost2"><?= $values['dolgnost'] ?: 'Должность' ?></span><br>
	<span id="ou2"><?= $values['ou'] ?: 'Учреждение' ?></span><br>
	<span id="oblast2"><?= $values['oblast'] ?: 'Область' ?></span><br>
	<span id="place2"><?= $values['place'] ?: 'Город' ?></span><br><br><br>

	<span id="mesto2"><b>I место</b></span><br><br><br>

	<span id="competition_level2"><?= $saved_level ?></span> педагогическом конкурсе<br>
	с Международным участием<br>
	в условиях реализации ФГОС<br>
	“<b><span id="nazvanie_konkursa2"><?= $values['nazvanie_konkursa'] ?: 'Инновационная педагогика' ?></span></b>”<br>
	Номинация: “<b><span id="nominaciya2"><?= $values['nominaciya'] ?: 'Свободная номинация' ?></span></b>”<br>
	Название работы: “<b><span id="nkr2"><?= $values['nkr'] ?: 'Открытый урок' ?></span></b>”<br>

	<span id="data2"><?= $values['data'] ?: date('d.m.Y') ?></span>
</div>

<div class="payer">
	Стоимость диплома: <span id="mesto3"><?= PAYFORM_PRICE ?></span> руб.
	<div class="span-text">После успешной оплаты вы получите письмо со ссылкой на диплом.</div>
</div>

<?php if (is_user_logged_in()): ?>
	<a class="create-zaya redbutton" href="">Оплатить</a><br>
<?php else: ?>
	<div class="login-required" style="margin-top:20px; text-align:center;">
		<p><strong>Чтобы заказать диплом — войдите в систему:</strong></p>
		<?= do_shortcode('[ultimatemember form_id="188"]'); ?>
	</div>
<?php endif; ?>

<?php get_sidebar('payform'); ?>

</div></div>

<script>
jQuery(function($) {

	const basePrice = <?= PAYFORM_PRICE ?>;
	const defaultDesign = <?= DEFAULT_DESIGN ?>;

	function updatePrice() {
		$('#mesto3').text(basePrice);
		$('input[name="sum"]').val(basePrice);
	}

	const map = {
		'#name': '#name2', '#dolgnost': '#dolgnost2', '#ou': '#ou2', '#oblast': '#oblast2',
		'#place': '#place2', '#nazvanie_konkursa': '#nazvanie_konkursa2',
		'#nominaciya': '#nominaciya2', '#nkr': '#nkr2', '#data': '#data2','#email': ''
	};

	$.each(map, function(inp, out) {
		$(inp).on('input change', function() {
			let v = $(this).val();
			$(out).text(v);
			$.cookie($(this).attr('name'), v, {path:'/', expires:30});
		});
	});

	$('#competition_level').change(function() {
		let v = $(this).val();
		$('#competition_level2').text(v);
		$.cookie('competition_level', v);
	});

	$('#design').change(function() {
		let v = $(this).val();
		$('.diplomtk').css('background-image', 'url(<?= DESIGN_FOLDER . DESIGN_PREFIX ?>' + v + '.jpg)');
	});

	$('#mesto').change(function() {
		let txt = $(this).find('option:selected').text();
		$('#mesto2').text(txt);
		$('#mestoLabel').val(txt);
	});

	$('.diplomtk').css('background-image', 'url(<?= DESIGN_FOLDER . DESIGN_PREFIX ?>' + defaultDesign + '.jpg)');
	updatePrice();
});
</script>

<script>
  window.postType = 'pedagogich-konkurs';
</script>

<script src="<?= get_stylesheet_directory_uri(); ?>/js/create-zaya.js"></script>
<script src="<?= get_stylesheet_directory_uri(); ?>/js/validate.js"></script>

<?php
	return ob_get_clean();
}
add_shortcode('pedagogicheskiy_konkurs', 'shortcode_pedagogicheskiy_konkurs');

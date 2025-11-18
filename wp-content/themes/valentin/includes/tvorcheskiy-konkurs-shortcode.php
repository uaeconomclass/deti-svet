<?php
// === Шорткод диплома: [tvorcheskiy_konkurs design="7"] ===
function shortcode_tvorcheskiy_konkurs($atts = []) {
	ob_start();

	// --- Атрибуты ---
	$atts = shortcode_atts([
		'design' => 1, // по умолчанию дизайн 1
	], $atts);

	// === Константы ===
	define('DESIGN_COUNT', 4);
	define('DESIGN_FOLDER', '/wp-content/themes/valentin/images/diplomtk/');
	define('DESIGN_PREFIX', 'diplomtk');
	define('PAYFORM_PRICE', 100.00);
	define('CURATOR_EXTRA_PRICE', 50.00);
	define('DEFAULT_DESIGN', (int)$atts['design']);


// === Проверка загрузки файла ===
$uploaded = false;
$fileName = '';

$uploadDir = trailingslashit(__DIR__) . 'uploads/';
$finalDir  = trailingslashit(__DIR__) . 'final/';

// создаём папки, если нет
if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
if (!is_dir($finalDir)) mkdir($finalDir, 0755, true);

$allowedExtensions = [
    'jpg', 'jpeg', 'png', 'webp', 'heic', 'heif', 'svg',
    'pdf', 'doc', 'docx', 'ppt', 'pptx', 'zip', 'rar',

    // Аудио / Видео
    'mp3', 'mp4', 'mov', 'm4v', 'avi', 'mkv', 'webm', '3gp', 'hevc'
];
	$acceptAttr = '.' . implode(',.', $allowedExtensions);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['myfile'])) {

    $originalName = basename($_FILES['myfile']['name']);
    $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    // --- Настройки ограничений ---
    $maxSize = 20 * 1024 * 1024; // 20 МБ

    // --- Проверки ---
    if ($_FILES['myfile']['size'] > $maxSize) {
        echo "<p style='color:red;'>❌ Файл слишком большой! Максимум — 20 МБ.</p>";
    } elseif (!in_array($fileExt, $allowedExtensions)) {
        echo "<p style='color:red;'>❌ Недопустимое расширение! Разрешено: " . implode(', ', $allowedExtensions) . ".</p>";
    } elseif ($_FILES['myfile']['error'] !== UPLOAD_ERR_OK) {
        echo "<p style='color:red;'>❌ Ошибка при загрузке (код: {$_FILES['myfile']['error']}).</p>";
    } else {

        // --- Создаём уникальное имя временного файла ---
        $uniquePrefix = uniqid('tmp_', true);
        $tempFileName = $uniquePrefix . '_' . $originalName;
        $tempPath = $uploadDir . $tempFileName;

        // --- Перемещаем во временную папку ---
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], $tempPath)) {
            $uploaded = true;
            $fileName = $tempFileName;
            echo "<p style='color:green;'>✅ Файл успешно загружен: " . htmlspecialchars($originalName) . "</p>";
            echo "<p>Файл сохранён во временную папку. После заполнения данных он будет перемещён в финальную.</p>";
        } else {
            echo "<p style='color:red;'>❌ Не удалось сохранить файл.</p>";
        }
    }
}


	// === Поля (метаданные) ===
	$fields = [
		'name' => ['ФИ ребенка (или ФИО педагога)', true],
		'age' => ['Возраст ребенка (или должность педагога)', false],
		'ou' => ['Наименование ОУ', true],
		'oblast' => ['Укажите область', true],
		'place' => ['Укажите населенный пункт', true],
		'nazvanie_konkursa' => ['Название конкурса', false],
		'nominaciya' => ['Номинация', true],
		'nkr' => ['Название работы', true],
		'data' => ['Дата оформления диплома', true],
		'email' => ['Ваш электронный адрес', true],
		'curator' => ['ФИО куратора', false],
		'curators_position' => ['Должность куратора', false]
	];

	// === Данные из cookie ===
	$values = [];
	foreach ($fields as $key => $_) {
		$values[$key] = isset($_COOKIE[$key]) ? htmlspecialchars(stripslashes($_COOKIE[$key]), ENT_QUOTES, 'UTF-8') : '';
	}
	$saved_level = $_COOKIE['competition_level'] ?? 'Во Всероссийском';
	?>

	<div class="wrapper">
	  <div class="inwrapper">
<div class="diplom-01">	 		
		<?php if (!$uploaded): ?>
		  <!-- === Шаг 1: загрузка файла === -->
		  <form method="POST" enctype="multipart/form-data" class="upload-form">
			<h3>Шаг 1. Загрузите файл с вашей работой</h3>
			<?php
			?>
			<input type="file" name="myfile" required accept="<?= $acceptAttr ?>">
			<?php /* <input type="file" name="myfile" required accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.zip,.rar" > */ ?>
			<button type="submit">Загрузить</button>
		  </form>
		<?php else: ?> 
		<form class="dform" method="POST" >
		  <h3>Шаг 2.  Введите данные</h3>
			  <!-- Универсальные поля -->
			  <?php foreach ($fields as $key => [$placeholder, $required]) : ?>
				<?php if (!in_array($key, ['curator', 'curators_position'])) : ?>
				  <div class="width-input">
					<label for="<?= $key ?>"><?= $placeholder ?></label>
					<?php /* <input type="<?= $key === 'email' ? 'email' : 'text' ?>" */ ?>
						<input type="text"
						   id="<?= $key ?>"
						   name="<?= $key ?>"
						   placeholder="<?= $placeholder ?>"
						   value="<?= $values[$key] ?: ($key === 'data' ? date('d.m.Y') : '') ?>"
						   <?= $required ? 'required' : '' ?>>
				  </div>
				<?php endif; ?>
			  <?php endforeach; ?>

			  <!-- Выбор места -->
			  <div class="width-input">
				<label for="mesto">Выберите результат</label>
				<select name="mesto" id="mesto">
				  <option value="25">I место</option>
				  <option value="25">II место</option>
				  <option value="25">III место</option>
				  <option value="25">Участник</option>
				</select>
			  </div>

			  <!-- Уровень конкурса -->
			  <?php
			  $competition_levels = ['Во Всероссийском', 'В республиканском', 'В областном', 'В городском', 'В муниципальном'];
			  ?>
			  <div class="width-input">
				<label for="competition_level">Выберите уровень конкурса</label>
				<select name="competition_level" id="competition_level" required>
				  <?php foreach ($competition_levels as $lvl) : ?>
					<option value="<?= $lvl ?>" <?= $lvl === $saved_level ? 'selected' : '' ?>><?= $lvl ?></option>
				  <?php endforeach; ?>
				</select>
			  </div>

			  <!-- ✅ Дизайн -->
			  <div class="width-input" style="display:none;">
				<label for="design">Выберите дизайн</label>
				<select id="design" name="design">
				  <?php for ($i = 1; $i <= DESIGN_COUNT; $i++) : ?>
					<option value="<?= $i ?>" <?= $i === DEFAULT_DESIGN ? 'selected' : '' ?>>
					  дизайн <?= $i ?>
					</option>
				  <?php endfor; ?>
				</select>
			  </div>

			  <!-- Куратор -->
			  <div class="width-input" style="width:98%!important;">
				<label>Хочу внести данные о кураторе в этот диплом</label>
				<label><input type="radio" name="add_cur" value="yes"> Да</label>
				<label><input type="radio" name="add_cur" value="no" checked> Нет</label>
			  </div>

			  <span id="curators">
				<?php foreach (['curator', 'curators_position'] as $curKey) : ?>
				  <div class="width-input">
					<label for="<?= $curKey ?>"><?= $fields[$curKey][0] ?></label>
					<input type="text" id="<?= $curKey ?>" name="<?= $curKey ?>"
						   placeholder="<?= $fields[$curKey][0] ?>"
						   value="<?= $values[$curKey] ?>">
				  </div>
				<?php endforeach; ?>
			  </span>

			  <div class="width-input" id="curator_certificate_wrap" style="display:none;width:100%!important;">
				<label><input type="checkbox" id="curator_certificate" name="curator_certificate"> Оформить отдельный сертификат куратора (+<?= CURATOR_EXTRA_PRICE ?>₽)</label>
			  </div>

			  <input type="hidden" name="session_id" value="<?= session_id() ?>">
			  <input type="hidden" name="mestoLabel" id="mestoLabel" value="I место">
			  <input type="hidden" name="sum" id="sum" value="<?= PAYFORM_PRICE ?>">
			  <input type="hidden" name="uploaded_file" value="<?= $uploaded && $fileName ? htmlspecialchars($fileName) : '' ?>">
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			  
			
		  
	  
		</form>
		<?php endif; ?>
</div>

		
		
		
		  <!-- Превью диплома -->
		  <div class="diplom-100 diplomtk" style="background-image:url('<?= DESIGN_FOLDER . DESIGN_PREFIX . DEFAULT_DESIGN ?>.jpg')">
			№ 000 - 00000<br>
			Награждается<br>
			<b><span id="name2"><?= $values['name'] ?: 'Фамилия Имя Отчество' ?></span></b><br>
			<span id="age2"><?= $values['age'] ?: 'Возраст' ?></span><br>
			<span id="ou2"><?= $values['ou'] ?: 'Наименование образовательного учреждения' ?></span><br>
			<span id="oblast2"><?= $values['oblast'] ?: 'Область' ?></span><br>
			<span id="place2"><?= $values['place'] ?: 'Населенный пункт' ?></span><br><br>
			<span id="mesto2"><b>I место</b></span><br><br>
			<span id="competition_level2"><?= $saved_level ?></span> творческом конкурсе<br>
			с международным участием<br>
			“<b><span id="nazvanie_konkursa2"><?= $values['nazvanie_konkursa'] ?: 'Волшебная пора' ?></span></b>”<br>
			Номинация: “<b><span id="nominaciya2"><?= $values['nominaciya'] ?: 'Рисунок' ?></span></b>”<br>
			Название работы: “<b><span id="nkr2"><?= $values['nkr'] ?: 'Осень' ?></span></b>”<br>
			<span id="curator3"><?= $values['curator'] ? 'Куратор: ' : '' ?></span><b><span id="curator2"><?= $values['curator'] ?></span></b><br>
			<b><span id="curators_position2"><?= $values['curators_position'] ?></span></b><br>
			<span id="data2"><?= $values['data'] ?: date('d.m.Y') ?></span><br>
		  </div>



		  
		  <div class="payer">
			Стоимость диплома: <span id="mesto3"><?= PAYFORM_PRICE ?></span> руб.
			<div class="span-text">После успешной оплаты Вы получите письмо со ссылкой на диплом</div>
		  </div>

<?php if (is_user_logged_in()) : ?>
  <a class="create-zaya redbutton" href="">Оплатить</a><br>
<?php else : ?>
  <div class="login-required" style="margin-top:20px; text-align:center;">
    <p><strong>Чтобы заказать диплом, пожалуйста, войдите в систему:</strong></p>
    <?php echo do_shortcode('[ultimatemember form_id="188"]'); ?>
  </div>
<?php endif; ?>
		  
		<?php get_sidebar('payform'); ?>	



	  </div>
	</div>

	<script>
	jQuery(function($) {
	  const basePrice = <?= PAYFORM_PRICE ?>;
	  const curatorExtra = <?= CURATOR_EXTRA_PRICE ?>;
	  const defaultDesign = <?= DEFAULT_DESIGN ?>;

	  function updatePrice() {
		let price = basePrice;
		if ($('#curator_certificate').is(':checked')) {
		  price += curatorExtra;
		}
		$('#mesto3').text(price);
		$('input[name="sum"]').val(price);
	  }

	  const map = {
		'#name': '#name2', '#age': '#age2', '#ou': '#ou2', '#oblast': '#oblast2',
		'#place': '#place2', '#nazvanie_konkursa': '#nazvanie_konkursa2',
		'#nominaciya': '#nominaciya2', '#nkr': '#nkr2', '#data': '#data2',
		'#curator': '#curator2', '#curators_position': '#curators_position2','#email': ''
	  };

	  $.each(map, function(inp, out) {
		$(inp).on('input change', function() {
		  const v = $(this).val();
		  $(out).text(v);
		  $.cookie($(this).attr('name'), v, { path: '/', expires: 30 });
		  if (inp === '#curator') $('#curator3').text(v ? 'Куратор: ' : '');
		});
	  });

	  $('#competition_level').change(function() {
		const val = $(this).val();
		$('#competition_level2').text(val);
		$.cookie('competition_level', val);
	  });

	  $('#design').change(function() {
		const v = $(this).val();
		$('.diplomtk').css('background-image', 'url(<?= DESIGN_FOLDER . DESIGN_PREFIX ?>' + v + '.jpg)');
	  });

	  $('#curator, #curators_position').closest('.width-input').hide();
	  $('#curator_certificate_wrap').hide();

	  $('input[name="add_cur"]').change(function() {
		const val = $(this).val();
		if (val === 'yes') {
		  $('#curator, #curators_position').closest('.width-input').slideDown(200);
		  $('#curator_certificate_wrap').slideDown(200);
		} else {
		  $('#curator, #curators_position').closest('.width-input').slideUp(200).find('input').val('').trigger('input');
		  $('#curator_certificate_wrap').slideUp(200);
		  $('#curator_certificate').prop('checked', false);
		}
		updatePrice();
	  });

	  $('#curator_certificate').change(updatePrice);
	  $('#mesto').change(function() {
		const text = $(this).find('option:selected').text();
		$('#mesto2').text(text);
		$('#mestoLabel').val(text);
		$.cookie('mestoLabel', text);
	  });

	  $('.diplomtk').css('background-image', 'url(<?= DESIGN_FOLDER . DESIGN_PREFIX ?>' + defaultDesign + '.jpg)');
	  updatePrice();
	});
	</script>

	<script>
	  window.postType = 'tvorcheskiy-konkurs';
	</script>

	<script src="<?= get_stylesheet_directory_uri(); ?>/js/create-zaya.js"></script>
	<script src="<?= get_stylesheet_directory_uri(); ?>/js/validate.js"></script>

	<?php
	return ob_get_clean();
}
add_shortcode('tvorcheskiy_konkurs', 'shortcode_tvorcheskiy_konkurs');

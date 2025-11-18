<?php /* Template Name: Single */ 


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
acf_form_head();
get_header(); ?>

	<div id="primary" <?php astra_primary_class(); ?>>
	
	
	<style>
	/* Стили для экранов 768px и выше */
	@media (min-width: 768px) {
	  .wrapper-cool {
		padding: 50px;
		background: #005365;
	  }
	}

	/* Стили для экранов 767px и ниже */
	@media (max-width: 767px) {
	  .wrapper-cool {
		padding: 25px;
		background: #005365;
	  }
	}
	
	.acf-file-uploader .file-icon{
		background: #005365;
	}	
	
	.acf-file-uploader .file-icon{
		background: #005365;
	}
	
	.acf-file-uploader .file-wrap{
		background: #005365;
	}
	
	</style>
	
	
	
	
<section class="wrapper-cool">	
		<div style="">
<?php /*
// Получаем все метаполя текущего поста
$meta = get_post_meta(get_the_ID());

// Проверяем, есть ли метаполя
if (!empty($meta)) {
    echo '<div class="meta-fields">';
    foreach ($meta as $key => $value) {
        // $value — это массив, поэтому берём первый элемент
        echo '<p><strong>' . esc_html($key) . ':</strong> ' . esc_html($value[0]) . '</p>';
    }
    echo '</div>';
} else {
    echo '<p>Нет метаполей для этой записи.</p>';
}
*/ ?>

<h2>Публикация</h2><br>
<?php
$id = get_the_ID();

$fields = [
    'name'          => 'ФИО',
    'dolgnost'      => 'Должность',
    'ou'            => 'Организация',
    'oblast'        => 'Область / регион',
    'place'         => 'Населенный пункт',
    'nkr'           => 'Название работы',
    'asdnominaciya' => 'Номинация',
    'data'          => 'Дата участия',
    'mestoLabel'    => 'Результат',
];

echo '<table class="meta-table">';
foreach ($fields as $key => $label) {
    $value = get_post_meta($id, $key, true);
    if (!empty($value)) {
        echo '<tr><th>' . esc_html($label) . ':</th><td>' . esc_html($value) . '</td></tr>';
    }
}
echo '</table>';
?>
<?php
$file = get_field('work_file'); // ACF поле типу File

if ($file) {
    echo '<div class="file-preview">';
    echo '<p><h2><a style="text-decoration:underline;" href="' . esc_url($file) . '" target="_blank">Файл публикации</a></h2></p>';
    echo '</div>';
}
?>



<?php 
if ( is_user_logged_in() ) {

  $args = array(
    'post_id'      => get_the_ID(), // сохраняем в текущий пост
    'post_title'   => false,
    'submit_value' => 'Сохранить файл',
    'fields'       => array('work_file'), // только нужное поле
    'uploader'     => 'wp', // стандартный загрузчик WordPress
  );

  acf_form($args);

} 
?>
</div>



		</div>
</section>		
	
	</div><!-- #primary -->



<?php get_footer(); ?>

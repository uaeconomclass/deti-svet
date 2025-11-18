<?php
/* Template Name: Diplom */

if (!defined('ABSPATH')) exit;

get_header();

define('SITE_URL', 'https://deti-svet.ru');
define('THEME_PATH', SITE_URL . '/wp-content/themes/valentin/TCPDF/examples/');
define('SITE_MAIN', 'https://deti-svet.ru');
?>

<div id="primary" <?php astra_primary_class(); ?>>
	<?php astra_primary_content_top(); ?>
	<?php astra_content_page_loop(); ?>
	<?php astra_primary_content_bottom(); ?>

	<div class="wrapper">
		<div class="inwrapper">

			<?php
			$current_user_id = get_current_user_id();

			if ($current_user_id) {

				$templates = [
					'olimpiada_kids'      => ['file' => 'olimpiada_kids', 'label' => 'Диплом', 'has_cur' => true],
					'olimpiada'           => ['file' => 'olimpiada',      'label' => 'Диплом', 'has_cur' => true],
					'onlinetest'          => ['file' => 'onlinetest',     'label' => 'Диплом'],
					'blag'                => ['file' => 'blag',           'label' => 'Благодарность'],
					'publication'         => ['file' => 'publication',    'label' => 'Свидетельство о публикации', 'attach' => true],
					'pedagogich-konkurs'  => ['file' => 'pedagogich-konkurs', 'label' => 'Диплом', 'attach' => true],
					'tvorcheskiy-konkurs' => ['file' => 'tvorcheskiy-konkurs', 'label' => 'Диплом участника', 'has_cur' => true, 'attach' => true],
				];

				$post_types = array_keys($templates);

				$query = new WP_Query([
					'author'         => $current_user_id,
					'post_type'      => $post_types,
					'post_status'    => 'publish',
					'posts_per_page' => -1,
					'orderby'        => 'date',
					'order'          => 'DESC',
				]);

				if ($query->have_posts()) :

					echo '<table class="user-diplomas" style="width:100%; border-collapse:collapse; border:1px solid #ddd;">';
					echo '<tr style="background:#f2f2f2; text-align:left;">
							<th style="padding:8px;">ID</th>
							<th style="padding:8px;">Скачать</th>
							<th style="padding:8px;">Тип</th>
							<th style="padding:8px;">Имя участника</th>
							<th style="padding:8px;">Статус оплаты</th>
						  </tr>';

					while ($query->have_posts()) : $query->the_post();

						$id     = get_the_ID();
						$type   = get_post_type($id);
						$title  = esc_html(get_the_title());

						$name = function_exists('get_field') && get_field('name', $id)
							? esc_html(get_field('name', $id))
							: esc_html(get_post_meta($id, 'name', true));

						$payed  = get_post_meta($id, 'payed', true);
						$status = $payed === 'success'
							? '<span style="color:green;">🟢 Оплачено</span>'
							: '<span style="color:red;">🔴 Не оплачено</span>';

						$file  = $templates[$type]['file'] ?? $type;
						$label = $templates[$type]['label'] ?? 'Диплом';
						$link  = THEME_PATH . $file . '.php?zid=' . $id;

						$link_html = ($payed === 'success')
							? "<a href='{$link}' target='_blank'>Открыть</a>"
							: "<span style='color:#999;'>Ожидает оплату 💰</span>";

						echo "<tr style='border-bottom:1px solid #eee;'>
								<td style='padding:8px;'>{$title}</td>
								<td style='padding:8px;'>{$link_html}</td>
								<td style='padding:8px;'>{$label}</td>
								<td style='padding:8px;'>{$name}</td>
								<td style='padding:8px;'>{$status}</td>
							  </tr>";

						/* ====== КУРАТОР ====== */
						if (get_post_meta($id, 'curator_certificate', true) === 'on') {

							$curator = function_exists('get_field') && get_field('curator', $id)
								? esc_html(get_field('curator', $id))
								: esc_html(get_post_meta($id, 'curator', true));

							$cur_file = $file . '-curator.php';
							$cur_link = THEME_PATH . $cur_file . '?zid=' . $id;

							$cur_link_html = ($payed === 'success')
								? "<a href='{$cur_link}' target='_blank'>Открыть</a>"
								: "<span style='color:#999;'>Ожидает оплату 💰</span>";

							echo "<tr style='background:#fafafa; border-bottom:1px solid #eee;'>
									<td style='padding:8px;'></td>
									<td style='padding:8px;'>{$cur_link_html}</td>
									<td style='padding:8px;'>Диплом куратора</td>
									<td style='padding:8px;'>{$curator}</td>
									<td style='padding:8px;'>{$status}</td>
								  </tr>";
						}

					endwhile;

					echo '</table>';

					wp_reset_postdata();

				else :
					echo '<p>У вас пока нет созданных дипломов.</p>';
				endif;

			} else {
				echo '<p>Пожалуйста, авторизуйтесь, чтобы увидеть свои дипломы.</p>';
				echo do_shortcode('[ultimatemember form_id="188"]');
			}
			?>

			<hr>

			<div id="random-wish">
			  <strong>Пожелание от сайта:</strong> <span id="wish-text"></span>
			</div>

			<script>
			  const wishes = [
			    "Сегодня тебе повезёт!",
			    "Ты на правильном пути.",
			    "Удача уже рядом.",
			    "Ты — главный герой своей истории.",
			    "Ты можешь всё.",
			    "Ты достоин самого лучшего.",
			    "Будь собой — и этого достаточно.",
			    "Всё получится — не сомневайся.",
			    "Скоро будет повод праздновать!"
			  ];
			  document.getElementById("wish-text").innerText = wishes[Math.floor(Math.random() * wishes.length)];
			</script>

		</div>
	</div>
</div>

<?php get_footer(); ?>

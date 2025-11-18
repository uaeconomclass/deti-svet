<?php
/**
 * Valentin Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Valentin
 * @since 1.0.0
 */
 
add_filter('um_after_login_redirect', function($url, $user_id, $form){

    // Получаем объект пользователя
    $user = get_userdata($user_id);

    // Если был реферер (страница, где находился)
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $referer = esc_url_raw($_SERVER['HTTP_REFERER']);

        // Если админ — тоже оставляем на месте (отключаем стандартный редирект в админку)
        if (in_array('administrator', (array) $user->roles)) {
            return $referer;
        }

        // Для всех остальных тоже редиректим обратно
        return $referer;
    }

    // Фолбек — стандартный URL
    return $url;

}, 10, 3);


require_once get_stylesheet_directory() . '/includes/tvorcheskiy-konkurs-shortcode.php';
require_once get_stylesheet_directory() . '/includes/pedagogicheskiy-konkurs-shortcode.php';
require_once get_stylesheet_directory() . '/includes/publication-shortcode.php';
 
// Добавь в functions.php или свой плагин
function custom_login_or_greeting_shortcode() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $name = trim($current_user->first_name . ' ' . $current_user->last_name);
        if ( empty($name) ) {
            $name = $current_user->user_login;
        }        
		return '';
        return '<p>Привет, <strong>' . esc_html($name) . '</strong>!</p>';

    } else {
        $form = wp_login_form( array(
            'echo'           => false,
            'redirect'       => home_url(),
            'label_username' => 'Логин',
            'label_password' => 'Пароль',
            'label_remember' => 'Запомнить меня',
            'label_log_in'   => 'Войти',
            'remember'       => false
        ));
        return '<p>Для начала работы войдите на сайт:</p>' . $form;
    }
}
add_shortcode('login_or_greeting', 'custom_login_or_greeting_shortcode');



/**
 * Define Constants
 */
define( 'CHILD_THEME_VALENTIN_VERSION', '1.0.0' );

function add_custom_admin_menu() {
    add_menu_page(
        'Списки емейлов', // Назва сторінки
        'Списки емейлов', // Текст посилання у меню
        'manage_options', // Рівень доступу
        'custom-page', // Слаг
        'custom_page_function', // Функція, яка викликається при натисканні
        'dashicons-email', // Іконка (Dashicon клас)
        10 //позиція меню
    );
}
add_action('admin_menu', 'add_custom_admin_menu');

function custom_page_function() {
    ?>
    <div class="wrap">
        <h2>Списки емейлов</h2>
        <p><a href="https://xn--d1acalldpbj9c1e.xn--p1ai/wp-content/themes/valentin/emaillist.php" target="_blank">Открыть страницу со списком 1 в новом окне</a></p>
		        <p><a href="https://xn--d1acalldpbj9c1e.xn--p1ai/wp-content/themes/valentin/emaillist2.php" target="_blank">Открыть страницу со списком 2 в новом окне</a></p>
    </div>
    <?php
}

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'valentin-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_VALENTIN_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

function besplatnoe_svidetelstvo_func( $atts ){
	//return site_url(); // никаких echo, только return
	
	?>
	

<div class="wrapper">	
<div class="inwrapper">	

 <form class="dform" method="get" action="https://xn--d1acalldpbj9c1e.xn--p1ai/wp-content/themes/valentin/TCPDF/examples/freediplom.php">   
    	<div class="diplom">

        	<div class="diplom-01">
				<div class="start">

<div class="width-input">
	
				<label for="" >&nbsp; </label>
                <input type="text" placeholder="ФИО участника" name="name" id="name" title="ФИО участника" <?php if(isset($_COOKIE['name'])) { echo 'value="'.$_COOKIE['name'].'"'; } ?> required>
</div>
<div class="width-input">
<label for="" >&nbsp; </label>
                <input type="text" placeholder="Должность" name="dolgnost" id="dolgnost" <?php if(isset($_COOKIE['dolgnost'])) { echo 'value="'.$_COOKIE['dolgnost'].'"'; } ?> required>
</div>
<div class="width-input">
<label for="" >&nbsp; </label>
                <input type="text" placeholder="Наименование ОУ" name="ou" id="ou" <?php if(isset($_COOKIE['ou'])) { echo 'value="'.$_COOKIE['ou'].'"'; } ?> required>
</div>	


<div class="width-input">
				<label for="" >&nbsp; </label>
                <input type="text" placeholder="Область" name="oblast" id="oblast" <?php if(isset($_COOKIE['oblast'])) { echo 'value="'.$_COOKIE['oblast'].'"'; } ?> required>
</div>	

<div class="width-input">
				<label for="" >&nbsp; </label>
                <input type="text" placeholder="Населенный пункт" name="place" id="place" <?php if(isset($_COOKIE['place'])) { echo 'value="'.$_COOKIE['place'].'"'; } ?> required>
</div>	



<div class="width-input">
				<label for="" >&nbsp; </label>
                <input type="text" placeholder="Укажите дату оформления диплома" name="data" id="data" value="<?php echo date("d.m.Y"); ?> " <?php if(isset($_COOKIE['data'])) { echo 'value="'.$_COOKIE['data'].'"'; } ?> required>
</div>	
	
<div class="width-input">
				<label for="" >&nbsp; </label>
                <input type="text" placeholder="Ваш электронный адрес" name="email" id="email" <?php if(isset($_COOKIE['email'])) { echo 'value="'.$_COOKIE['email'].'"'; } ?> required>
</div>
			
                </div>
            </div>
			
            <div class="diplom-100 diplom-150 ">
            	<br/>
				Настоящее свидетельство<br/>
подтверждает, что<br>
                <b><span id='name2'><?php if(isset($_COOKIE['name'])) { echo $_COOKIE['name']; } else { echo 'Фамилия Имя Отчество'; }   ?></span></b><br>
                <span id='dolgnost2'><?php if(isset($_COOKIE['dolgnost'])) { echo $_COOKIE['dolgnost']; } else { echo 'Должность'; }   ?></span><br>
                <span id='ou2'><?php if(isset($_COOKIE['ou'])) { echo $_COOKIE['ou']; } else { echo 'Наименование образовательного учреждения'; }   ?></span><br>
				<span id='oblast2'><?php if(isset($_COOKIE['oblast'])) { echo $_COOKIE['oblast']; } else { echo 'Область'; }   ?></span><br>
                <span id='place2'><?php if(isset($_COOKIE['place'])) { echo $_COOKIE['place']; } else { echo 'Населенный пункт'; }   ?></span><br><br>
                <br/>
				Пользователь зарегистрирован на сайте<br/>
Дельфиненок.рф<br/>
и прошел обучение по работе<br/>
с онлайн-сервисом сайта<br>
<br/> 
                <span id='data2'><?php echo date("d.m.Y"); ?></span><br>
            </div>
			<div class="clear"></div>

        </div>
		
<input type="submit" class="redbutton" value="Скачать" >
		
</form>	 

		
<script>	
jQuery( document ).ready(function() {
	
	
jQuery('#name').on('input', function() { 
    jQuery('#name2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('name', jQuery(this).val());
	
});	
		
jQuery('#dolgnost').on('input', function() { 
    jQuery('#dolgnost2').text(jQuery(this).val());// get the current value of the input field
	jQuery.cookie('dolgnost', jQuery(this).val());
	
});	
			
jQuery('#ou').on('input', function() { 
    jQuery('#ou2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('ou', jQuery(this).val());
	
});		
		
jQuery('#oblast').on('input', function() { 
    jQuery('#oblast2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('oblast', jQuery(this).val());
	
});	
			
jQuery('#place').on('input', function() { 
    jQuery('#place2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('place', jQuery(this).val());
	
});	
			
jQuery('#data').on('input', function() { 
    jQuery('#data2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('data', jQuery(this).val());
	
});	

	
				
jQuery('#email').on('input', function() { 
	jQuery.cookie('email', jQuery(this).val());
	
});		
	
	
});
	
</script>		
			
<script>	
jQuery( document ).ready(function() {



		// validate signup form on keyup and submit
		jQuery(".dform").validate({
			rules: {
				email: {
					email: true
				}
			},
			messages: {
				name: "Заполните поле",
				nazvanie_konkursa: "Заполните поле",	
				email: "Введите корректную почту",				
				place: "Заполните поле",				
				nkr: "Заполните поле",				
				dolgnost: "Заполните поле",				
				ou: "Заполните поле",				
				nominaciya: "Заполните поле",				
				data: "Заполните поле",				

			}
		});

	
	
});
	
</script>		
	
	
</div>	
</div>		

	
	
<?php	
	
}
 
add_shortcode( 'besplatnoe-svidetelstvo', 'besplatnoe_svidetelstvo_func' );


function true_misha_func(){
	
	echo do_shortcode('[WATU '.$_GET['param'].']');
	
}
 
add_shortcode( 'misha', 'true_misha_func' );
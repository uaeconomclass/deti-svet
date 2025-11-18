<?php /* Template Name: Diplom */ 


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>


		<?php astra_primary_content_top(); ?>

		<?php astra_content_page_loop(); ?>

		<?php astra_primary_content_bottom(); ?>
		


	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<!----------------------------------->

	
<div class="wrapper">	
<div class="inwrapper">	

 <form class="dform" method="get" action="#">   
    	<div class="diplom">

<!--/********SLIDER************/-->
<?php
define('DESIGN_COUNT', 7);
define('DESIGN_FOLDER', '/wp-content/themes/valentin/images/onlinetest/');
define('DESIGN_PREFIX', 'onlinetest');
include get_stylesheet_directory() . '/includes/diploma_slider.php';
?>		
<!--/********************/-->

        	<div class="diplom-01">
				<div class="start">

<div class="width-input">
  <label for="name">&nbsp;</label>
  <input 
    type="text" 
    placeholder="ФИО участника" 
    name="name" 
    id="name" 
    title="ФИО участника" 
    value="<?php echo isset($_COOKIE['name']) ? htmlspecialchars($_COOKIE['name'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">
  <label for="dolgnost">&nbsp;</label>
  <input 
    type="text" 
    placeholder="Должность" 
    name="dolgnost" 
    id="dolgnost" 
    value="<?php echo isset($_COOKIE['dolgnost']) ? htmlspecialchars($_COOKIE['dolgnost'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">
  <label for="ou">&nbsp;</label>
  <input 
    type="text" 
    placeholder="Наименование ОУ" 
    name="ou" 
    id="ou" 
    value="<?php echo isset($_COOKIE['ou']) ? htmlspecialchars($_COOKIE['ou'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">
  <label for="oblast">Укажите область</label>
  <input 
    type="text" 
    placeholder="Например: Свердловская область" 
    name="oblast" 
    id="oblast" 
    value="<?php echo isset($_COOKIE['oblast']) ? htmlspecialchars($_COOKIE['oblast'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">
  <label for="place">Населенный пункт</label>
  <input 
    type="text" 
    placeholder="Например: г. Серов" 
    name="place" 
    id="place" 
    value="<?php echo isset($_COOKIE['place']) ? htmlspecialchars($_COOKIE['place'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">		
  <label for="mesto">Выберите результат</label>
  <select name="mesto" id="mesto">
    <option value="25">I место</option>
    <option value="25">II место</option>
    <option value="25">III место</option>
    <option value="25">участник</option>
  </select>
</div>

<div class="width-input">
  <label for="data">Укажите дату оформления диплома</label>
  <input 
    type="text" 
    placeholder="Укажите дату оформления диплома" 
    name="data" 
    id="data" 
    value="<?php echo isset($_COOKIE['data']) ? htmlspecialchars($_COOKIE['data'], ENT_QUOTES, 'UTF-8') : date('d.m.Y'); ?>" 
    required>
</div>

<div class="width-input">
  <label for="email">&nbsp;</label>
  <input 
    type="email" 
    placeholder="Ваш электронный адрес" 
    name="email" 
    id="email" 
    value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>


				<div class="width-input" style="display:none" >
					<label for="design">Выберите дизайн </label>	
					<select id="design" name="design">
					<?php
					for ($i = 1; $i <= DESIGN_COUNT; $i++) {
						echo "<option value='$i'>дизайн $i</option>";
					}
					?>
					</select>
					
				</div>


<div class="width-input">
				<label for="nazvanie_konkursa" >Выберите название пройденного теста</label>
					<select name="nazvanie_konkursa" id="nazvanie_konkursa" >
					  <option value="Знания по ИКТ">Знания по ИКТ</option>
					  <option value="АДАПТАЦИЯ К ШКОЛЕ В УСЛОВИЯХ ФГОС">АДАПТАЦИЯ К ШКОЛЕ В УСЛОВИЯХ ФГОС</option>
					  <option value="Современные подходы в развитии связной речи">Современные подходы в развитии связной речи</option>
					  <option value="Конструирование в ДОУ в соответствии с ФГОС">Конструирование в ДОУ в соответствии с ФГОС</option>
					  <option value="Педагог и родители в соответствии с требованиями ФГОС">Педагог и родители в соответствии с требованиями ФГОС</option>
					  <option value="Обучение грамоте в условиях введения ФГОС">Обучение грамоте в условиях введения ФГОС</option>
					  <option value="ФОРМИРОВАНИЕ ЗВУКОВОЙ КУЛЬТУРЫ РЕЧИ (ЗКР) С УЧЕТОМ ФГОС">ФОРМИРОВАНИЕ ЗВУКОВОЙ КУЛЬТУРЫ РЕЧИ (ЗКР) С УЧЕТОМ ФГОС</option>
					  <option value="РАЗВИТИЕ РЕЧИ">РАЗВИТИЕ РЕЧИ</option>
					  <option value="ЛЕПКА В ДОУ ПО ФГОС">ЛЕПКА В ДОУ ПО ФГОС</option>
					  <option value="АППЛИКАЦИЯ В ДОУ ПО ФГОС">АППЛИКАЦИЯ В ДОУ ПО ФГОС</option>
					  <option value="РИСОВАНИЕ В ДОУ ПО ФГОС">РИСОВАНИЕ В ДОУ ПО ФГОС</option>
					  <option value="ВИДЫ И ТИПЫ МУЗЫКАЛЬНЫХ ЗАНЯТИЙ">ВИДЫ И ТИПЫ МУЗЫКАЛЬНЫХ ЗАНЯТИЙ</option>
					  <option value="ХУДОЖЕСТВЕННАЯ ЛИТЕРАТУРА В РАЗВИТИИ РЕЧИ ДЕТЕЙ">ХУДОЖЕСТВЕННАЯ ЛИТЕРАТУРА В РАЗВИТИИ РЕЧИ ДЕТЕЙ</option>
					  <option value="ФГОС В МУЗЫКАЛЬНОМ ВОСПИТАНИИ">ФГОС В МУЗЫКАЛЬНОМ ВОСПИТАНИИ</option>
					  <option value="МЕТОДИКА ФИЗИЧЕСКОГО ВОСПИТАНИЯ ДОШКОЛЬНИКОВ С ТРЕБОВАНИЯМИ ФГОС">МЕТОДИКА ФИЗИЧЕСКОГО ВОСПИТАНИЯ ДОШКОЛЬНИКОВ С ТРЕБОВАНИЯМИ ФГОС</option>
					  <option value="ФЭМП У ДОШКОЛЬНИКОВ В СООТВЕТСТВИИ С ТРЕБОВАНИЯМИ ФГОС">ФЭМП У ДОШКОЛЬНИКОВ В СООТВЕТСТВИИ С ТРЕБОВАНИЯМИ ФГОС</option>
					  <option value="ИНКЛЮЗИВНОЕ ОБРАЗОВАНИЕ">ИНКЛЮЗИВНОЕ ОБРАЗОВАНИЕ</option>
					  <option value="Здоровьесберегающие технологии в образовании">Здоровьесберегающие технологии в образовании</option>
					  <option value="Экологическая культура">Экологическая культура</option>
					  <option value="Дошкольная педагогика">Дошкольная педагогика</option>
					  <option value="Изобразительное искусство">Изобразительное искусство</option>
					  <option value="Инновационные технологии в образовании">Инновационные технологии в образовании</option>
					  <option value="Знание ППБ в образовательном учреждении">Знание ППБ в образовательном учреждении</option>
					  <option value="Правовая компетенция педагога в сфере педагогической деятельности">Правовая компетенция педагога в сфере педагогической деятельности</option>
					  <option value="Первая доврачебная помощь детям">Первая доврачебная помощь детям</option>
					  <option value="СТАРШИЙ ВОСПИТАТЕЛЬ">СТАРШИЙ ВОСПИТАТЕЛЬ</option>
					  <option value="ПЕДАГОГ-ПСИХОЛОГ">ПЕДАГОГ-ПСИХОЛОГ</option>
					  <option value="ОСНОВЫ СОЦИОЛОГИИ">ОСНОВЫ СОЦИОЛОГИИ</option>
					  <option value="ОСНОВЫ ЛОГОПЕДИИ">ОСНОВЫ ЛОГОПЕДИИ</option>
					  <option value="ФГОС ДО">ФГОС ДО</option>
					  <option value="ФГОС НОО">ФГОС НОО</option>
					  <option value="ФГОС ООО">ФГОС ООО</option>
					  <option value="ФГОС СОО">ФГОС СОО</option>
					</select>	

					
                <!--<input type="text" placeholder="Название конкурса" value="Инновационная педагогика: опыт, достижения" name="nazvanie_konkursa" id="nazvanie_konkursa" <?php if(isset($_COOKIE['nazvanie_konkursa'])) { echo 'value="'.$_COOKIE['nazvanie_konkursa'].'"'; } ?> >-->
</div>	



				<input type="hidden" name="session_id" value="<?php echo (session_id()); ?>"> 
				<input type="hidden" name="mestoLabel" id="mestoLabel" value="I место"> 				
                </div>
            </div>
			
            <div class="diplom-100 onlinetest">
            	№ 000 - 00000<br>
            	Награждается<br>
                <b><span id='name2'><?php if(isset($_COOKIE['name'])) { echo $_COOKIE['name']; } else { echo 'Фамилия Имя Отчество'; }   ?></b></span><br>
                <span id='dolgnost2'><?php if(isset($_COOKIE['dolgnost'])) { echo $_COOKIE['dolgnost']; } else { echo 'Должность'; }   ?></span><br>
                <span id='ou2'><?php if(isset($_COOKIE['ou'])) { echo $_COOKIE['ou']; } else { echo 'Наименование образовательного учреждения'; }   ?></span><br>
				<span id='oblast2'><?php if(isset($_COOKIE['oblast'])) { echo $_COOKIE['oblast']; } else { echo 'Область'; }   ?></span><br>
                <span id='place2'><?php if(isset($_COOKIE['place'])) { echo $_COOKIE['place']; } else { echo 'Населенный пункт'; }   ?></span><br><br>
				<span id='mesto2'><b>I место</b></span><br><br>
                во Всероссийском онлайн-тестировании<br>
                для педагогов<br>
                с Международным участием<br> 
				“<b><span id='nazvanie_konkursa2'>Знания по ИКТ</span></b>”<br>
				
                на сайте https://дельфиненок.рф<br>
                <span id='data2'><?php echo date("d.m.Y"); ?></span><br>
            </div>
			<div class="clear"></div>

        </div>
		

        
        <div class="payer">
        	Стоимость диплома: <span id="mesto3">50</span> руб.
            <div class="span-text">После успешной оплаты Вы получите на свою электронную почту письмо со ссылкой <p>
            на диплом</div><br>
			
		</div>
			
			
                <a class="create-zaya redbutton" href="">Оплатить</a><br>
			
</form>	 

<?php
// === Константа цены (в рублях) ===
if ( ! defined( 'PAYFORM_PRICE' ) ) {
    define( 'PAYFORM_PRICE', 50.00 );
}
 get_sidebar('payform'); 
?> 
		

<div style="text-align:center;">
<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="https://yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,viber,whatsapp"></div>
</div>
		
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
			
jQuery('#nominaciya').on('input', function() { 
    jQuery('#nominaciya2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('nominaciya', jQuery(this).val());
	
});		
				
jQuery('#nkr').on('input', function() { 
    jQuery('#nkr2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('nkr', jQuery(this).val());
	
});		
	
jQuery('#data').on('input', function() { 
    jQuery('#data2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('data', jQuery(this).val());
	
});	
	
	
				
jQuery('#email').on('input', function() { 
	jQuery.cookie('email', jQuery(this).val());
	jQuery('#email2').val(jQuery(this).val())
	
});		



jQuery("select#mesto").change(function(){
		var selectedMesto_no_price='';
        var selectedPrice = jQuery(this).children("option:selected").val();
       
	    var selectedText = jQuery(this).children("option:selected").text();
        
		//alert(selectedText);
			
		jQuery('#mesto3').text(selectedPrice);
		jQuery( "input[name='sum']" ).val(selectedPrice);
		
		jQuery('#mesto2').text(selectedText);
		jQuery( "#mestoLabel" ).val(selectedText);
    });
	
	
	
	
	
jQuery("select#design").change(function(){
        var selectedDesignValue = jQuery(this).children("option:selected").val();
		console.log(selectedDesignValue);
		jQuery('.diplom-100').css("background-image","url(/wp-content/themes/valentin/images/onlinetest/onlinetest"+selectedDesignValue+".jpg)");
    });
	
	
});




jQuery("select#nazvanie_konkursa").change(function(){
	jQuery('#nazvanie_konkursa2').text(jQuery(this).children("option:selected").text());
    });



	
</script>		
				



<script>
  window.postType = 'onlinetest'; //  тип поста  JS
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/create-zaya.js"></script>	
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/validate.js"></script>	
	
	
</div>	
</div>	
		

<!----------------------------------->

<?php get_footer(); ?>

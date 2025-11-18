<?php acf_form_head();/* Template Name: Diplom-page*/ 


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<style>
.site-content .ast-container {
    flex-direction: column;
}
</style>

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

<div class="wrapper">	
<div class="inwrapper">	



 <form class="dform" method="get" action="#">   
 
    	<div class="diplom">

<!--/********SLIDER************/-->
<?php
define('DESIGN_COUNT', 7);
define('DESIGN_FOLDER', '/wp-content/themes/valentin/images/blag/');
define('DESIGN_PREFIX', 'blag');
include get_stylesheet_directory() . '/includes/diploma_slider.php';
?>		
<!--/********************/-->

        	<div class="diplom-01">
				<div class="start">

<div class="width-input">
  <label for="name">Введите ФИО участника</label>
  <input type="text" placeholder="ФИО участника" name="name" id="name" title="ФИО участника" 
         value="<?php echo isset($_COOKIE['name']) ? htmlspecialchars($_COOKIE['name'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
</div>

<div class="width-input">
  <label for="dolgnost">Введите должность</label>
  <input type="text" placeholder="Должность" name="dolgnost" id="dolgnost" 
         value="<?php echo isset($_COOKIE['dolgnost']) ? htmlspecialchars($_COOKIE['dolgnost'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
</div>

<div class="width-input">
  <label for="ou">Укажите наименование учреждения</label>
  <input type="text" placeholder="Наименование ОУ" name="ou" id="ou" 
         value="<?php echo isset($_COOKIE['ou']) ? htmlspecialchars(stripslashes($_COOKIE['ou']), ENT_QUOTES, 'UTF-8') : ''; ?>" required>
</div>

<div class="width-input">
  <label for="oblast">Название области</label>
  <input type="text" placeholder="Например: Свердловская область" name="oblast" id="oblast" 
         value="<?php echo isset($_COOKIE['oblast']) ? htmlspecialchars($_COOKIE['oblast'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
</div>

<div class="width-input">
  <label for="place">Населенный пункт</label>
  <input type="text" placeholder="Например: г. Серов" name="place" id="place" 
         value="<?php echo isset($_COOKIE['place']) ? htmlspecialchars($_COOKIE['place'], ENT_QUOTES, 'UTF-8') : ''; ?>" required>
</div>
	
<!--

				<div class="width-input">		
					<label for="mesto">Выберите результат (участник — 25 руб)</label>
					<select name="mesto" id="mesto" >					  
					  <option value="25">участник - 25руб.</option>
                      <option value="50" >I место - 50руб.</option>
					  <option value="50">II место - 50руб.</option>
					  <option value="50">III место - 50руб.</option>

					</select>
				</div>
				
-->

<?php
        $competition_levels = [
            'профессиональную подготовку участников во Всероссийских творческих конкурсах.',
            'профессиональное мастерство, публикацию статей и методических материалов.',
            'активное участие и подготовку участников во Всероссийских олимпиадах соответствующих ФГОС.',
            'профессиональное участие в педагогическом конкурсе.',
            'педагогический талант, профессиональное мастерство в творческом конкурсе.',
            'участие и профессиональное мастерство </br> во Всероссийских онлайн-тестах нашего сайта.'
        ];
?>

<div class="width-input">
    <label for="competition_level">Благодарность за</label>
    <select name="competition_level" id="competition_level" required>
        <?php
        $saved_level = isset($_COOKIE['competition_level']) ? $_COOKIE['competition_level'] : 'профессиональную подготовку участников во Всероссийских творческих конкурсах.';
        foreach ($competition_levels as $level) {
            $selected = ($level === $saved_level) ? 'selected' : '';
            echo "<option value=\"$level\" $selected>$level</option>";
        }
        ?>
    </select>
</div>	


<!--
<div class="width-input">
  <label for="nazvanie_konkursa">Введите свое название конкурса без кавычек</label>
  <input 
    type="text" 
    placeholder="Название конкурса" 
    name="nazvanie_konkursa" 
    id="nazvanie_konkursa" 
    value="<?php echo isset($_COOKIE['nazvanie_konkursa']) ? htmlspecialchars($_COOKIE['nazvanie_konkursa'], ENT_QUOTES, 'UTF-8') : 'Инновационная педагогика: опыт, достижения'; ?>">
</div>

<div class="width-input">
  <label for="nominaciya">Введите свою номинацию без кавычек</label>
  <input 
    type="text" 
    placeholder="Номинация" 
    name="nominaciya" 
    id="nominaciya" 
    value="<?php echo isset($_COOKIE['nominaciya']) ? htmlspecialchars($_COOKIE['nominaciya'], ENT_QUOTES, 'UTF-8') : 'Свободная номинация'; ?>">
</div>

<div class="width-input">
  <label for="nkr">Укажите название работы</label>
  <input 
    type="text" 
    placeholder="Название работы без кавычек" 
    name="nkr" 
    id="nkr" 
    value="<?php echo isset($_COOKIE['nkr']) ? htmlspecialchars($_COOKIE['nkr'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>
-->


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
    type="text" 
    placeholder="Ваш электронный адрес" 
    name="email" 
    id="email" 
    value="<?php echo isset($_COOKIE['email']) ? htmlspecialchars($_COOKIE['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required 
    autocomplete="off">
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

				<input type="hidden" name="session_id" value="<?php echo (session_id()); ?>"> 
				<input type="hidden" name="mestoLabel" id="mestoLabel" value="участник"> 				
                </div>
            </div>
            

            <div class="diplom-100">
            	№ 000 - 00000<br>
            	Награждается<br>
                <b><span id='name2'><?php if(isset($_COOKIE['name'])) { echo $_COOKIE['name']; } else { echo 'Фамилия Имя Отчество'; }   ?></span></b><br>
                <span id='dolgnost2'><?php if(isset($_COOKIE['dolgnost'])) { echo $_COOKIE['dolgnost']; } else { echo 'Должность'; }   ?></span><br>
                <span id='ou2'><?php if(isset($_COOKIE['ou'])) { echo stripslashes($_COOKIE['ou']); } else { echo 'Наименование образовательного учреждения'; }   ?></span><br>
				<span id='oblast2'><?php if(isset($_COOKIE['oblast'])) { echo $_COOKIE['oblast']; } else { echo 'Область'; }   ?></span><br>
                <span id='place2'><?php if(isset($_COOKIE['place'])) { echo $_COOKIE['place']; } else { echo 'Населенный пункт'; }   ?></span><br><br>
                <!--<span id='mesto2'><b>I место</b></span><br><br>-->
				Сайт интернет - портала “Дельфиненок.рф” <br>
				выражает благодарность за<br>
                <span id="competition_level2"> <?php echo isset($_COOKIE['competition_level']) ? $_COOKIE['competition_level'] : 'профессиональную подготовку участников во Всероссийских творческих конкурсах.'; ?></span><br>
				<!--“<b><span id='nazvanie_konkursa2'><?php if(isset($_COOKIE['nazvanie_konkursa'])) { echo $_COOKIE['nazvanie_konkursa']; } else { echo 'Инновационная педагогика: опыт, достижения'; }   ?></span></b>”<br>
				Номинация: “<b><span id='nominaciya2'><?php if(isset($_COOKIE['nominaciya'])) { echo $_COOKIE['nominaciya']; } else { echo 'Свободная номинация'; }   ?></span></b>”<br>
				Название работы: “<b><span id='nkr2'><?php if(isset($_COOKIE['nkr'])) { echo $_COOKIE['nkr']; } else { echo 'Открытый урок'; }   ?></span></b>”<br>-->
                Желаем дальнейших профессиональных успехов<br>
				и творческого вдохновения.<br><br>
				<span id='data2'>12.05.2019</span><br>
            </div>
			<div class="clear"></div>

        </div>
		

        <div class="payer">
        	Стоимость диплома: <span id="mesto3">25</span> руб.
            <div class="span-text">После успешной оплаты Вы получите на свою электронную почту письмо со ссылкой <p>
            на диплом</div>
		</div>
		
			
        <a class="create-zaya redbutton" href="">Оплатить</a><br>
			
</form>	 


<?php
// === Константа цены (в рублях) ===
if ( ! defined( 'PAYFORM_PRICE' ) ) {
    define( 'PAYFORM_PRICE', 25.00 );
}
 get_sidebar('payform'); 
?> 
	
		
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

jQuery('#competition_level').on('change', function() { 
    var val = jQuery(this).val();
    jQuery('#competition_level2').text(val);
    jQuery.cookie('competition_level', val);
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
				
jQuery('#nazvanie_konkursa').on('input', function() { 
    jQuery('#nazvanie_konkursa2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('nazvanie_konkursa', jQuery(this).val());
	
});	

jQuery("select#grade").change(function(){
	jQuery('#grade2').text(jQuery(this).children("option:selected").text());

});
		
				
jQuery('#email').on('input', function() { 
	jQuery.cookie('email', jQuery(this).val());
	jQuery('#email2').val(jQuery(this).val())
	
});		
	

	
jQuery("select#mesto").change(function(){
		var selectedMesto_no_price='';
        var selectedPrice = jQuery(this).children("option:selected").val();
        jQuery('#mesto3').text(selectedPrice);
		jQuery( "input[name='sum']" ).val(selectedPrice);
		
switch (selectedPrice) {
  case '50':
    // все три места — одинаковая цена
    var selectedText = jQuery(this).children("option:selected").text();
    selectedMesto_no_price = selectedText.split(' - ')[0]; // извлекаем только "I место", "II место" и т.д.
    break;
  case '25':
    selectedMesto_no_price = 'участник';
    break;
  default:
    selectedMesto_no_price = 'участник';
    break;
}

		
		jQuery('#mesto2').text(selectedMesto_no_price);
		jQuery( "#mestoLabel" ).val(selectedMesto_no_price);
    });
		
	
jQuery("select#design").change(function(){
        var selectedDesignValue = jQuery(this).children("option:selected").val();
		console.log(selectedDesignValue);
		jQuery('.diplom-100').css("background-image","url(/wp-content/themes/valentin/images/blag/blag"+selectedDesignValue+".jpg)");
    });
    

	
	
});
	
</script>		
				


<script>
  window.postType = 'blag'; //  тип поста  JS
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/create-zaya.js"></script>	
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/validate.js"></script>	

	
</div>	
</div>	
<!----------------------------------->
<?php get_footer(); ?>

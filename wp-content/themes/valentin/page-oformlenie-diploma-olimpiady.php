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
define('DESIGN_COUNT', 10);
define('DESIGN_FOLDER', '/wp-content/themes/valentin/images/olimpiada/');
define('DESIGN_PREFIX', 'olimpiada');
include get_stylesheet_directory() . '/includes/diploma_slider.php';
?>		
<!--/********************/-->


        	<div class="diplom-01">
				<div class="start">

<div class="width-input">
  <label for="name">&nbsp;</label>
  <input 
    type="text" 
    placeholder="ФИ участника" 
    name="name" 
    id="name" 
    title="ФИ участника" 
    value="<?php echo isset($_COOKIE['name']) ? htmlspecialchars($_COOKIE['name'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">		
					<label for="klass">Класс </label>
					<select name="klass" id="klass" >
					  <option value="Выберите Ваш класс">Выберите Ваш класс</option>
					  <option value="1 класс">1 класс</option>
					  <option value="2 класс">2 класс</option>
					  <option value="3 класс">3 класс</option>
					  <option value="4 класс">4 класс</option>
					  <option value="5 класс">5 класс</option>
					  <option value="6 класс">6 класс</option>
					</select>
</div>


<div class="width-input">
  <label for="ou">&nbsp;</label>
  <input 
    type="text" 
    placeholder="Наименование ОУ" 
    name="ou" 
    id="ou" 
    value="<?php echo isset($_COOKIE['ou']) ? htmlspecialchars(stripslashes($_COOKIE['ou']), ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">
  <label for="oblast">&nbsp;</label>
  <input 
    type="text" 
    placeholder="Область" 
    name="oblast" 
    id="oblast" 
    value="<?php echo isset($_COOKIE['oblast']) ? htmlspecialchars($_COOKIE['oblast'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>

<div class="width-input">
  <label for="place">&nbsp;</label>
  <input 
    type="text" 
    placeholder="Населенный пункт" 
    name="place" 
    id="place" 
    value="<?php echo isset($_COOKIE['place']) ? htmlspecialchars($_COOKIE['place'], ENT_QUOTES, 'UTF-8') : ''; ?>" 
    required>
</div>



				<div class="width-input">		
					<label for="mesto">Выберите результат </label>
					<select name="mesto" id="mesto" >
					  <option value="25" >I место</option>
					  <option value="25">II место</option>
					  <option value="25">III место</option>
					  <option value="25">участник</option>
					</select>
				</div>
				
<?php
$competition_levels = [
    'Во Всероссийской',
    'В республиканской',
    'В областной',
    'В городской',
    'В муниципальной',
];
?>

<div class="width-input">
    <label for="competition_level">Выберите уровень олимпиады</label>
    <select name="competition_level" id="competition_level" required>
        <?php
        $saved_level = isset($_COOKIE['competition_level']) ? $_COOKIE['competition_level'] : 'Во Всероссийской';
        foreach ($competition_levels as $level) {
            $selected = ($level === $saved_level) ? 'selected' : '';
            echo "<option value=\"$level\" $selected>$level</option>";
        }
        ?>
    </select>
</div>				
				
<div class="width-input">
  <label for="data">Укажите дату оформления диплома</label>
  <input 
    type="text" 
    placeholder="Укажите дату оформления диплома" 
    name="data" 
    id="data" 
    value="<?php echo isset($_COOKIE['data']) 
      ? htmlspecialchars($_COOKIE['data'], ENT_QUOTES, 'UTF-8') 
      : date('d.m.Y'); ?>" 
    required>
</div>

<div class="width-input">
  <label for="email">&nbsp;</label>
  <input 
    type="email" 
    placeholder="Ваш электронный адрес" 
    name="email" 
    id="email" 
    value="<?php echo isset($_COOKIE['email']) 
      ? htmlspecialchars($_COOKIE['email'], ENT_QUOTES, 'UTF-8') 
      : ''; ?>" 
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
					<label for="nazvanie_konkursa" >Выберите название пройденной олимпиады</label>
						<select name="nazvanie_konkursa" id="nazvanie_konkursa" >
						  <option value="Пожарная безопасность">Пожарная безопасность</option>
						  <option value="Русский язык">Русский язык</option>
						  <option value="Математика">Математика</option>
						  <option value="Окружающий мир">Окружающий мир</option>
						  <option value="Английский язык">Английский язык</option>
						  <option value="Литературное чтение">Литературное чтение</option>
						  <option value="Биология">Биология</option>
						  <option value="География">География</option>
						  <option value="Естествознание">Естествознание</option>
						  <option value="Информатика">Информатика</option>
						  <option value="История">История</option>
						  <option value="Литература">Литература</option>
						  <option value="ОБЖ">ОБЖ</option>
						  <option value="Естествознание">Естествознание</option>
						  <option value="80 Лет Победы!">80 лет Победы!</option>
						</select>	

						
					<!--<input type="text" placeholder="Название конкурса" value="Инновационная педагогика: опыт, достижения" name="nazvanie_konkursa" id="nazvanie_konkursa" <?php if(isset($_COOKIE['nazvanie_konkursa'])) { echo 'value="'.$_COOKIE['nazvanie_konkursa'].'"'; } ?> >-->
				</div>	




	<div class="width-input" style="width:100%!important;"  >
	  <label for="add_cur">Хочу внести данные о кураторе в этот диплом</label>	  
	  <label>
		<input type="radio" name="add_cur" id="add_cur_yes" value="yes">
		Да
	  </label>
	  
	  <label >
		<input type="radio" name="add_cur" id="add_cur_no" value="no" checked>
		Нет
	  </label>
	</div>



			<span  id="curators">				
							
				<div class="width-input">
								<label for="" >Если куратор не нужен - оставьте поле пустым</label>
								<input type="text" placeholder="ФИО куратора" name="curator" id="curator" <?php if(isset($_COOKIE['curator'])) { echo 'value="'.$_COOKIE['curator'].'"'; } ?> >					
				</div>




				<div class="width-input">
								<label for="" >Если куратор не нужен - оставьте поле пустым</label>
								<input type="text" placeholder="Должность куратора" name="curators_position" id="curators_position" <?php if(isset($_COOKIE['curators_position'])) { echo 'value="'.$_COOKIE['curators_position'].'"'; } ?> >					
				</div>				
								
			</span>	


<div class="width-input" id="curator_certificate_wrap" style="display:none; margin-top:10px; width:100%!important;">
  <label for="curator_certificate">Оформить отдельный сертификат куратора</label>	 
  <label>
    <input type="checkbox" id="curator_certificate" name="curator_certificate">
    (+25₽)
  </label>
</div>


				<input type="hidden" name="session_id" value="<?php echo (session_id()); ?>"> 
				<input type="hidden" name="mestoLabel" id="mestoLabel" value="I место"> 				
                </div>
            </div>
			
            <div class="diplom-100 olimpiada">
            	№ 000 - 00000<br>
            	Награждается<br>
                <b><span id='name2'><?php if(isset($_COOKIE['name'])) { echo $_COOKIE['name']; } else { echo 'Фамилия Имя'; }   ?></b></span><br>
				

                <b><span id='klass2'><?php if(isset($_COOKIE['klass'])) { echo $_COOKIE['klass']; } else { echo 'выберите номер класса'; }   ?></b></span><br>
				
								
				
				
				
                <span id='ou2'><?php if(isset($_COOKIE['ou'])) { echo stripslashes($_COOKIE['ou']); } else { echo 'Наименование образовательного учреждения'; }   ?></span><br>
				<span id='oblast2'><?php if(isset($_COOKIE['oblast'])) { echo $_COOKIE['oblast']; } else { echo 'Область'; }   ?></span><br>
                <span id='place2'><?php if(isset($_COOKIE['place'])) { echo $_COOKIE['place']; } else { echo 'Населенный пункт'; }   ?></span><br><br>
				<span id='mesto2'><b>I место</b></span><br><br>
                <span id="competition_level2"><?php echo isset($_COOKIE['competition_level']) ? $_COOKIE['competition_level'] : 'Во Всероссийской'; ?></span> онлайн-олимпиаде<br>
                для школьников<br>
				“<b><span id='nazvanie_konkursa2'>Пожарная безопасность</span></b>”<br>
                на сайте https://дельфиненок.рф<br>
               <span id='curator3'><?php if(!empty($_COOKIE['curator'])) { echo 'Куратор: '; } ?></span> <b><span id='curator2'><?php if(isset($_COOKIE['curator'])) { echo $_COOKIE['curator']; } else { echo ''; }   ?></span></b><br>
				<b><span id='curators_position2'><?php if(isset($_COOKIE['curators_position'])) { echo $_COOKIE['curators_position']; }   ?></span></b><br>				
                <span id='data2'><?php echo date("d.m.Y"); ?></span><br>
            </div>
			<div class="clear"></div>

        </div>
		

        
        <div class="payer">
        	Стоимость диплома: <span id="mesto3">25</span> руб.
            <div class="span-text">После успешной оплаты Вы получите на свою электронную почту письмо со ссылкой <p>
            на диплом</div><br>
			
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
		jQuery('.diplom-100').css("background-image","url(/wp-content/themes/valentin/images/olimpiada/olimpiada"+selectedDesignValue+".jpg)");
    });
	
	
});






	
jQuery("select#klass").change(function(){
        var klassValue = jQuery(this).children("option:selected").val();
		console.log(klassValue);
		jQuery('#klass2').text(klassValue);
			jQuery.cookie('klass', klassValue);
    });
	



jQuery("select#nazvanie_konkursa").change(function(){
	jQuery('#nazvanie_konkursa2').text(jQuery(this).children("option:selected").text());
    });


jQuery('#curator').on('input', function() { 
    jQuery('#curator2').text(jQuery(this).val());// get the current value of the input field.
	
	if (jQuery(this).val()=='') {
    jQuery('#curator3').text("");// get the current value of the input field.
	} else {
    jQuery('#curator3').text("Куратор: ");// get the current value of the input field.		
	}
	
	
	
	
	jQuery.cookie('curator', jQuery(this).val());
	
});		

jQuery('#curators_position').on('input', function() { 
    jQuery('#curators_position2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('curators_position', jQuery(this).val());
	
});	
		
	
</script>




<script>
  window.postType = 'olimpiada'; //  тип поста  JS
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/create-zaya.js"></script>	
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/validate.js"></script>		

		
<script>	
jQuery( document ).ready(function() {


// === при загрузке страницы прячем поля и чекбокс ===
jQuery('#curator, #curators_position').closest('.width-input').hide();
jQuery('#curator_certificate_wrap').hide();

// === слушаем радиокнопки "Хочу внести данные о кураторе" ===
jQuery('input[name="add_cur"]').change(function() {
  const value = jQuery(this).val();

  if (value === 'yes') {
    jQuery('#curator, #curators_position').closest('.width-input').slideDown(200);
    jQuery('#curator_certificate_wrap').slideDown(200);
    jQuery('#mesto3').text('25');
    jQuery('input[name="sum"]').val('25');
  } else {
    jQuery('#curator, #curators_position').closest('.width-input').slideUp(200);
    jQuery('#curator_certificate_wrap').slideUp(200);
    jQuery('#curator_certificate').prop('checked', false);
    jQuery('#curator, #curators_position').val('').trigger('input');
    jQuery('#mesto3').text('25');
    jQuery('input[name="sum"]').val('25');
  }
});

// === при клике на чекбокс сертификата ===
jQuery('#curator_certificate').change(function() {
  if (jQuery(this).is(':checked')) {
    jQuery('#mesto3').text('50');
    jQuery('input[name="sum"]').val('50');
  } else {
    jQuery('#mesto3').text('25');
    jQuery('input[name="sum"]').val('25');
  }
});
	
	
});
	
</script>		




	
	
	
	
	
	
	
</div>	
</div>	
		

<!----------------------------------->

<?php get_footer(); ?>

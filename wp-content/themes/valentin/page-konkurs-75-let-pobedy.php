<?php /* Template Name: Tvorcheskiy-konkurs */ 


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
acf_form_head(); 
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
define('DESIGN_COUNT', 6);
define('DESIGN_FOLDER', '/wp-content/themes/valentin/images/75demo/');
define('DESIGN_PREFIX', '75demo');
include get_stylesheet_directory() . '/includes/diploma_slider.php';
?>		
<!--/********************/-->

 <div class="diplom-01">
				<div class="start">

<div class="width-input">
  <label>&nbsp;</label>
  <input 
    type="text" 
    name="name" 
    id="name" 
    placeholder="ФИ ребёнка (или ФИО педагога)" 
    title="ФИО участника"
    value="<?php echo isset($_COOKIE['name']) ? esc_attr($_COOKIE['name']) : ''; ?>" 
    required
  >
</div>

<div class="width-input">
  <label>Возраст ребёнка (или должность педагога)</label>
  <input 
    type="text" 
    name="age" 
    id="age" 
    placeholder="Например: 5 лет (учитель)" 
    value="<?php echo isset($_COOKIE['age']) ? esc_attr($_COOKIE['age']) : ''; ?>"
  >
</div>

<div class="width-input">
  <label>&nbsp;</label>
  <input 
    type="text" 
    name="ou" 
    id="ou" 
    placeholder="Наименование ОУ" 
    value="<?php echo isset($_COOKIE['ou']) ? esc_attr(stripslashes($_COOKIE['ou'])) : ''; ?>"
    required
  >
</div>

<div class="width-input">
  <label>Укажите область</label>
  <input 
    type="text" 
    name="oblast" 
    id="oblast" 
    placeholder="Например: Свердловская область"
    value="<?php echo isset($_COOKIE['oblast']) ? esc_attr($_COOKIE['oblast']) : ''; ?>" 
    required
  >
</div>

<div class="width-input">
  <label>Населённый пункт</label>
  <input 
    type="text" 
    name="place" 
    id="place" 
    placeholder="Например: г. Серов" 
    value="<?php echo isset($_COOKIE['place']) ? esc_attr($_COOKIE['place']) : ''; ?>" 
    required
  >
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
    'Во Всероссийском',
    'В Международном',
    'В республиканском',
    'В областном',
    'В городском',
    'В муниципальном',
];
?>

<div class="width-input">
    <label for="competition_level">Выберите уровень конкурса</label>
    <select name="competition_level" id="competition_level" required>
        <?php
        $saved_level = isset($_COOKIE['competition_level']) ? $_COOKIE['competition_level'] : 'Во Всероссийском';
        foreach ($competition_levels as $level) {
            $selected = ($level === $saved_level) ? 'selected' : '';
            echo "<option value=\"$level\" $selected>$level</option>";
        }
        ?>
    </select>
</div>	
				
				
<div class="width-input">
  <label>Введите своё название конкурса</label>
  <input 
    type="text" 
    name="nazvanie_konkursa" 
    id="nazvanie_konkursa" 
    placeholder="Название конкурса без кавычек"
    value="<?php echo isset($_COOKIE['nazvanie_konkursa']) ? esc_attr($_COOKIE['nazvanie_konkursa']) : '80 лет Победы'; ?>"
  >
</div>

<div class="width-input">
  <label>Введите свою номинацию без кавычек</label>
  <input 
    type="text" 
    name="nominaciya" 
    id="nominaciya" 
    placeholder="Номинация"
    value="<?php echo isset($_COOKIE['nominaciya']) ? esc_attr($_COOKIE['nominaciya']) : 'Свободная номинация'; ?>"
  required>
</div>

<div class="width-input">
  <label>Введите название работы без кавычек</label>
  <input 
    type="text" 
    name="nkr" 
    id="nkr" 
    placeholder="Название конкурсной работы"
    value="<?php echo isset($_COOKIE['nkr']) ? esc_attr($_COOKIE['nkr']) : ''; ?>"
    required
  >
</div>

<div class="width-input">
  <label>Укажите дату оформления диплома</label>
  <input 
    type="text" 
    name="data" 
    id="data" 
    placeholder="Укажите дату оформления диплома"
    value="<?php echo isset($_COOKIE['data']) ? esc_attr($_COOKIE['data']) : date('d.m.Y'); ?>"
    required
  >
</div>

<div class="width-input">
  <label>&nbsp;</label>
  <input 
    type="email" 
    name="email" 
    id="email" 
    placeholder="Ваш электронный адрес"
    value="<?php echo isset($_COOKIE['email']) ? esc_attr($_COOKIE['email']) : ''; ?>"
    required
  >
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
  <label for="curator">ФИО куратора</label>
  <input 
    type="text" 
    placeholder="ФИО куратора" 
    name="curator" 
    id="curator" 
    value="<?php echo isset($_COOKIE['curator']) ? htmlspecialchars($_COOKIE['curator'], ENT_QUOTES, 'UTF-8') : ''; ?>">
</div>

<div class="width-input">
  <label for="curators_position">Должность куратора</label>
  <input 
    type="text" 
    placeholder="Должность куратора" 
    name="curators_position" 
    id="curators_position" 
    value="<?php echo isset($_COOKIE['curators_position']) ? htmlspecialchars($_COOKIE['curators_position'], ENT_QUOTES, 'UTF-8') : ''; ?>">
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
			
            <div class="diplom-100 d75demo1">
            	№ 000 - 00000<br>
            	Награждается<br>
                <b><span id='name2'><?php if(isset($_COOKIE['name'])) { echo $_COOKIE['name']; } else { echo 'Фамилия Имя Отчество'; }   ?></span></b><br>
                <span id='age2'><?php if(isset($_COOKIE['age'])) { echo $_COOKIE['age']; } else { echo 'Возраст'; }   ?></span><br>
                <span id='ou2'><?php if(isset($_COOKIE['ou'])) { echo stripslashes($_COOKIE['ou']); } else { echo 'Наименование образовательного учреждения'; }   ?></span><br>
				<span id='oblast2'><?php if(isset($_COOKIE['oblast'])) { echo $_COOKIE['oblast']; } else { echo 'Область'; }   ?></span><br>
                <span id='place2'><?php if(isset($_COOKIE['place'])) { echo $_COOKIE['place']; } else { echo 'Населенный пункт'; }   ?></span><br><br>
                <span id='mesto2'><b>I место</b></span><br><br>
                <span id="competition_level2"><?php echo isset($_COOKIE['competition_level']) ? $_COOKIE['competition_level'] : 'Во Всероссийском'; ?></span> патриотическом конкурсе<br>
                с международным участием<br>
				“<b><span id='nazvanie_konkursa2'><?php if(isset($_COOKIE['nazvanie_konkursa'])) { echo $_COOKIE['nazvanie_konkursa']; } else { echo '80 лет Победы'; }   ?></span></b>”<br>
				Номинация: “<b><span id='nominaciya2'><?php if(isset($_COOKIE['nominaciya'])) { echo $_COOKIE['nominaciya']; } else { echo 'Рисунок'; }   ?></span></b>”<br>
				Название работы: “<b><span id='nkr2'><?php if(isset($_COOKIE['nkr'])) { echo $_COOKIE['nkr']; } else { echo 'Победа!'; }   ?></span></b>”<br>
               <span id='curator3'><?php if(!empty($_COOKIE['curator'])) { echo 'Куратор: '; } ?></span> <b><span id='curator2'><?php if(isset($_COOKIE['curator'])) { echo $_COOKIE['curator']; } else { echo ''; }   ?></span></b><br>
				<b><span id='curators_position2'><?php if(isset($_COOKIE['curators_position'])) { echo $_COOKIE['curators_position']; }   ?></span></b><br>
                <span id='data2'>01.09.2019</span><br>
            </div>
			<div class="clear"></div>

        </div>
		

        
        <div class="payer">
        	Стоимость диплома: <span id="mesto3">25</span> руб.
            <div class="span-text">После успешной оплаты Вы получите на свою электронную почту письмо со ссылкой <p>
            на диплом. Диплом можно также скачать на странице - СКАЧАТЬ ДИПЛОМ</div><br>
			
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
		
jQuery('#age').on('input', function() { 
    jQuery('#age2').text(jQuery(this).val());// get the current value of the input field
	jQuery.cookie('age', jQuery(this).val());
	
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
		

		
jQuery('#nazvanie_konkursa').on('input', function() { 
    jQuery('#nazvanie_konkursa2').text(jQuery(this).val());// get the current value of the input field.
	jQuery.cookie('nazvanie_konkursa', jQuery(this).val());
	
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
		jQuery('.d75demo1').css("background-image","url(/wp-content/themes/valentin/images/75demo/75demo"+selectedDesignValue+".jpg)");
    });
	
	
});
	
</script>		
				

<script>
  window.postType = '75let'; //  тип поста  JS
</script>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/create-zaya.js"></script>	
<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/validate.js"></script>	

<script>
jQuery(document).ready(function() {

  // --- Спрятать поля куратора при загрузке ---
  jQuery('#curator, #curators_position').closest('.width-input').hide();
  jQuery('#curator_certificate_wrap').hide();

  // --- При выборе "Хочу внести данные о кураторе" ---
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

  // --- При клике на "Оформить сертификат куратора" ---
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

jQuery(document).ready(function($) {

  $('.create-zaya').click(function(e) {
    e.preventDefault();

    const $form = $('.dform');

    const postType = window.postType;

    const handlerUrl = '/wp-content/themes/valentin/handlers/create.php?post_type=' + encodeURIComponent(postType);

    if ($form.valid()) {

      console.log('Відправляємо на:', handlerUrl);
      console.log($form.serialize());

      $.ajax({
        type: "POST",
        url: handlerUrl,
        data: $form.serialize(),
        success: function(response) {
          $("input[name='targets']").val('Оплата диплома №' + response + '. Сайт дельфиненок.рф');
          $("input[name='label']").val(response);
		  var emailVal = $form.find("input[name='email']").val();
		  $("input[name='email']").val(emailVal);
		  
  
          $(".create-zaya").hide();
          $(".payform").show();
          $('.ykbutton').click();
        },
        error: function(xhr) {
          console.error('AJAX помилка:', xhr.responseText);
          alert('Ошибка при создании записи. Проверьте соединение.');
        }
      });

    } else {
      alert('Заполните обязательные поля, отмеченные красным');
    }
  });

});

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
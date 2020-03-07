jQuery(document).ready(function ($) {
	$('#signup').submit(function () {
		var container = $(this);
		var name = container.find('input[name=name]');
		var surname = container.find('input[name=surname]');
		var phone = container.find('input[name=phone]');
		var email = container.find('input[name=email]');
		var regx = /^([a-z0-9_\-\.])+\@([a-z0-9_\-\.])+\.([a-z]{2,4})$/i;
		var returnError = false;
		
		if (name.val()=='') {
			name.addClass('error');
			returnError = true;
		} else name.removeClass('error');
		
		if (email.val()=='') {
			email.addClass('error');
			returnError = true;
		} else email.removeClass('error');		
		
		if(!regx.test(email.val())){
          email.addClass('error');
          returnError = true;
		} else email.removeClass('error');

		if (surname.val()=='') {
			surname.addClass('error');
			returnError = true;
		} else surname.removeClass('error');

		if (phone.val()=='') {
			phone.addClass('error');
			returnError = true;
		} else phone.removeClass('error');

		if(returnError == true){
			return false;	
		}

		var str = container.serialize();
		
		$.ajax({
			url: "signup.php",
			type: "POST",
			data: str,

			success: function (html) {				
				//if contact.php returned OK (send mail success)
				if (html==="OK") {
				
					//show the success message
					container.parent().find('.done').fadeIn('slow');
					container.find('input[type=text], input[type=email], input[type=tel]').val("");
					
				//if contact.php returned 0/false (send mail failed)
				} else alert('Извините, возникла ошибка при отправке вашего сообщения. Пожалуйста, повторите отправку чуть позже.');
			}		
		});
		return false;
	});

	$('#message').submit(function () {
		var container = $(this);
		var name = container.find('input[name=name]');
		var email = container.find('input[name=email]');
		var subject = container.find('input[name=subject]');
		var message = container.find('textarea[name=comment]');
		var regx = /^([a-z0-9_\-\.])+\@([a-z0-9_\-\.])+\.([a-z]{2,4})$/i;
		var returnError = false;

		if (name.val()=='') {
			name.addClass('error');
			returnError = true;
		} else name.removeClass('error');

		if (email.val()=='') {
			email.addClass('error');
			returnError = true;
		} else email.removeClass('error');

		if(!regx.test(email.val())){
			email.addClass('error');
			returnError = true;
		} else email.removeClass('error');

		if (subject.val()=='') {
			subject.addClass('error');
			returnError = true;
		} else subject.removeClass('error');

		if (message.val()=='') {
			message.addClass('error');
			returnError = true;
		} else message.removeClass('error');

		if(returnError == true){
			return false;
		}

		var str = container.serialize();

		$.ajax({
			url: "contact.php",
			type: "POST",
			data: str,

			success: function (html) {
				//if contact.php returned OK (send mail success)
				if (html==="OK") {

					//show the success message
					container.parent().find('.done').fadeIn('slow');
					container.find('input[type=text], input[type=email], textarea').val("");

					//if contact.php returned 0/false (send mail failed)
				} else alert('Извините, возникла ошибка при отправке вашего сообщения. Пожалуйста, повторите отправку чуть позже.');
			}
		});
		return false;
	});
});	
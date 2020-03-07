<?php

$post = (!empty($_POST)) ? true : false;

if ($post) {
	$name = htmlspecialchars($_POST['name']);
	$surname = htmlspecialchars($_POST['surname']);
	$email = htmlspecialchars($_POST['email']);
	$tel = htmlspecialchars($_POST["phone"]);
	$error = '';

	if (!$name) {
		$error .= 'Пожалуйста введите ваше имя<br />';
	}

// Проверка телефона
	function ValidateTel($valueMail)
	{
		$regexTel = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
		if ($valueMail == "") {
			return false;
		} else {
			$string = preg_replace($regexTel, "", $valueMail);
		}
		return empty($string) ? true : false;
	}

	if (!$email) {
		$error .= "Пожалуйста введите email<br />";
	}
	if ($email && !ValidateTel($email)) {
		$error .= "Введите корректный email<br />";
	}
	if (!$error)

	if (!$tel || strlen($tel) < 1) {
		$error .= "Введите ваш номер телефона<br />";
	}
	if (!$error) {

		$name_tema = "=?utf-8?b?" . base64_encode($name) . "?=";
		$subject = "Новая заявка с сайта Школы Программирования";
		$subject1 = "=?utf-8?b?" . base64_encode($subject) . "?=";

		$message1 = "\n\nИмя: " . $name. "\n\nФамилия: " . $surname . "\n\n" . "\n\nТелефон: " . $tel . "\n\nE-mail: " . $email . "\n\nХочет записаться на курсы.";
		$header = "Content-Type: text/plain; charset=utf-8\n";

		/* Please, setup a host-like mail address to have good response on submit */
		$header .= "From: Новая заявка <contact@codeschool-iti.ru>\n\n";
		$mail = mail("codeschool.iti@gmail.com", $subject1, iconv('utf-8', 'windows-1251', $message1), iconv('utf-8', 'windows-1251', $header));

		if ($mail) {
			echo 'OK';
		}

	} else {
		echo '<div class="notification_error">' . $error . '</div>';
	}

}
?>
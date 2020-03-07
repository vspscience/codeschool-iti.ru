<?php

$post = (!empty($_POST)) ? true : false;

if ($post) {
	$name = htmlspecialchars($_POST['name']);
	$email = htmlspecialchars($_POST['email']);
	$sub = htmlspecialchars($_POST['subject']);
	$comment = htmlspecialchars($_POST["comment"]);
	$error = '';

	if (!$name) {
		$error .= 'Пожалуйста введите ваше имя<br />';
	}

// Проверка телефона
	function ValidateMail($valueMail)
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
	if ($email && !ValidateMail($email)) {
		$error .= "Введите корректный email<br />";
	}
	if (!$error)

	if (!$comment || strlen($comment) < 1) {
		$error .= "Введите ваше сообщение<br />";
	}
	if (!$error) {

		$name_tema = "=?utf-8?b?" . base64_encode($name) . "?=";
		$subject = "Новое сообщение с сайта Школы Программирования";
		$subject1 = "=?utf-8?b?" . base64_encode($subject) . "?=";

		$message1 = "\n\nИмя: " . $name. "\n\nТема: " . $sub . "\n\nE-mail: " . $email . "\n\nОставил сообщение:" ."\n" . $comment;
		$header = "Content-Type: text/plain; charset=utf-8\n";

		/* Please, setup a host-like mail address to have good response on submit */
		$header .= "From: Новое сообщение <contact@codeschool-iti.ru>\n\n";
		$mail = mail("codeschool.iti@gmail.com", $subject1, iconv('utf-8', 'windows-1251', $message1), iconv('utf-8', 'windows-1251', $header));

		if ($mail) {
			echo 'OK';
		}

	} else {
		echo '<div class="notification_error">' . $error . '</div>';
	}

}
?>
<?php

/* ignores data not submitted via form */
if (!isset($_POST['msg'], $_POST['name'], $_POST['email'])) {
	exit('Please fill all fields!');
}

// $_POST = array_map("trim", $_POST);
// $_POST = array_map("htmlspecialchars", $_POST);

// $errors = [];
// $errorMessage = '';

// if (!empty($_POST)) {
// 	$name = $_POST['name'];
// 	$email = $_POST['email'];
// 	$message = $_POST['msg'];
 
// 	if (empty($name)) {
// 		$errors[] = 'Name is empty';
// 	}
 
// 	if (empty($email)) {
// 		$errors[] = 'Email is empty';
// 	} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
// 		$errors[] = 'Email is invalid';
// 	}
 
// 	if (empty($message)) {
// 		$errors[] = 'Message is empty';
// 	}
 
// 	if (empty($errors)) {
// 		$toEmail = 'example@niepodam.pl';
// 		$emailSubject = 'New email from your contact form';
// 		$headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];
// 		$bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
// 		$body = join(PHP_EOL, $bodyParagraphs);
 
// 		if (mail($toEmail, $emailSubject, $body, $headers)) {
 
// 			header('Location: index.html');
// 		} else {
// 			$errorMessage = 'Oops, something went wrong. Please try again later';
// 		}
		
// 	} else {
 
// 		$allErrors = join('<br/>', $errors);
// 		$errorMessage = "<p style='color: red;'>{$allErrors}</p>";
// 	}
// }

$LINK_MAIN = "http://localhost/index.html";
header("Location: $LINK_MAIN");

?>
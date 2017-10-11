<?php

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$name = strip_tags(trim($_POST['name']));
		$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
		$recipient = $_POST['recipient'];
		$subject = $_POST['subject'];
		// echo $name;
		// echo $email;
		// echo $recipient;
		// echo $subject;
		if (empty($name) || empty($email)) {
			http_response_code(400);
			echo 'Please fill in all the fields';
		}

		// Build email
		$message = "Name: $name\n";
		$message .= "Email: $email\n\n";

		// Build headers
		$headers = "From: $name <$email>";

		// Send email
		if (mail($recipient, $subject, $message, $headers)) {
			http_response_code(200);
			echo "Thank you for subscribtion";
		}else{
			http_response_code(500);
			echo "Something went wrong! Try later";
		}
	}else{
		http_response_code(403);
		echo "Forbidden";
	}
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title>Form</title>
		<link rel="stylesheet" type="text/css" href="form.css" />
	</head>
	<body>
		<?php
			$name = "";
			$age = "";
			$email = "";
			$homepage = "";
			$message = "";
			$errors = "";
		
			if (isset($_POST['send'])) { //form sent
				//validation: name
				if ($_POST['name'] != "") {
					$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
					if ($name == "") {
						$errors .= '<p>Please enter a valid name.</p>';
					}
				} else {
					$errors .= '<p>Please enter your name.</p>';
				}
				//validation: age
				if ($_POST['age'] != "") {
					if (!filter_var($_POST['age'], FILTER_VALIDATE_INT)) {
						$errors .= '<p>Please enter a valid age.</p>';
					}
					$age = $_POST['age'];
				} else {
					$errors .= '<p>Please enter your age.</p>';
				}
				//validation: email
				if ($_POST['email'] != "") {
					$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
					if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						$errors .= "<p>$email is <strong>NOT</strong> a valid email address.</p>";
					}
				} else {
					$errors .= '<p>Please enter your email address.</p>';
				}
				//validation: homepage
				if ($_POST['homepage'] != "") {
					$homepage = filter_var($_POST['homepage'], FILTER_SANITIZE_URL);
					if (!filter_var($homepage, FILTER_VALIDATE_URL)) {
						$errors .= "<p>$homepage is <strong>NOT</strong> a valid URL.</p>";
					}
				} else {
					$errors .= '<p>Please enter your home page.</p>';
				}
				//validation: message
				if ($_POST['message'] != "") {
					$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
					if ($message == "") {
						$errors .= '<p>Please enter a message to send.</p>';
					}
				} else {
					$errors .= '<p>Please enter a message to send.</p>';
				}

				if (!$errors) {
					echo "<p>Thank you for filling in the form!</p>";
				} else {
					echo '<div>' . $errors . '</div>';
				}
			}
		?>
	
		<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
			<fieldset>Personal data form
				<p>
					<label>Name:</label>
					<input type="text" name="name" value="<?php echo $name; ?>" size="50" />
				</p>
				<p>
					<label>Age:</label>
					<input type="text" name="age" value="<?php echo $age; ?>" size="50" />
				</p>
				<p>
					<label>Email Address:</label>
					<input type="text" name="email" value="<?php echo $email; ?>" size="50" />
				</p>
				<p>
					<label>Home Page:</label>
					<input type="text" name="homepage" value="<?php echo $homepage; ?>" size="50" />
				</p>
				<p>
					<label>Message:</label>
					<textarea name="message" rows="5" cols="50"><?php echo $message; ?></textarea>
				</p>
				<p>
					<input type="submit" name="send" />
				</p>
			</fieldset>
		</form>
	</body>
</html>

<?php

include 'database.php';

# Will protect a page with a simple password. The user will only need
# to input the password once. After that their session will be enough
# to get them in. The optional scope allows access on one page to
# grant access on another page. If not specified then it only grants
# access to the current page.
function with($form, $scope)
{
	$session_key = 'password_protect_' . preg_replace('/\W+/', '_', $scope);

	session_start();

	if (isset($_POST['email']) && isset($_POST['password'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];
		if ((strpos($email, "'") !== false) || (strpos($password, "'") !== false)) {
			ko($form);
		}
		$database = new Database();
		$database->getConnection();
		$stmt = $database->getUserByEmailAndPassword($email, $password);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (is_array($row)) {
			extract($row);
			$_SESSION[$session_key] = true;
			$_SESSION['username'] = $name;
			$_SESSION['userid'] = $id;
			$_SESSION['admin'] = $role === "admin";
			$_SESSION['super-admin'] = $role === "super-admin";
			redirect(current_url());
		}

	}

	# If user has access then simply return so original page can render.
	if (isset($_SESSION[$session_key])) {
		return;
	}

	ko($form);
}

#### PRIVATE ####

function ko($form)
{
	require $form;
	exit;
}

function current_url($script_only = false): string
{
	$protocol = 'http';
	if (isset($_SERVER["HTTPS"]) == 'on') {
		$protocol .= 's';
	}
	$path = $script_only ? $_SERVER['SCRIPT_NAME'] : $_SERVER['REQUEST_URI'];
	return "$protocol://$_SERVER[SERVER_NAME]$path";
}

function redirect($url)
{
	header("Location: $url");
	exit;
}
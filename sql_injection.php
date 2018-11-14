<form action="" method="post">
<input name='username'>
<input name='password'>
<input type='submit' name='submit' value="submit">
</form>

<?php

$db = new mysqli("localhost", "root", "root123", "pentest");

// vulnerable code

if($_POST['submit']) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$q = "select * from users where username='$username' && password='$password' limit 1";

	$res = mysqli_query($db, $q);

	$data = mysqli_fetch_assoc($res);

	if(count($data) > 0 && is_array($data)) {
		echo 'logged in';
	}else{
		echo 'could not';
	}
}

// fixed code using Prepared statement

/*
if($_POST['submit']) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$stmt = $db->prepare('select id from users where username=? && password=? limit 1');

	$stmt->bind_param('ss', $username, $password);
	
	$stmt->execute();

	$result = $stmt->get_result();

	$data = $result->fetch_assoc();

	if(count($data) > 0 && is_array($data)) {
		echo 'logged in';
	}else{
		echo 'could not';
	}
}
*/

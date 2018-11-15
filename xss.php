<form action="" method="post">
Enter comment: <input name='comment'>
<input type='submit' name='submit' value="submit">
</form>

<?php

$db = new mysqli("localhost", "root", "root123", "pentest");

if($_POST['submit']) {
	$comment = $_POST['comment']; //use htmlspecialchars to avoid xss attacks 
	$stmt = $db->prepare('insert into comments(comment) values(?)');
	$stmt->bind_param('s', $comment);
	$stmt->execute();
	$stmt->close();
	header('location: xss.php');
}

$stmt = $db->prepare("SELECT comment FROM comments");
$stmt->execute();
$result = $stmt->get_result();

/*
 * if user mischievously  enters <script>alert('some text')</script> in comment box, every user visiting that page will see this alert
*/

while($row = $result->fetch_assoc()) {
    echo '<div>'.$row['comment'].'</div>';
}
$stmt->close();

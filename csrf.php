<?php
session_start();
$token= md5(uniqid());
$_SESSION['token']= $token;
session_write_close();
?>


<form method="post" action="csrf.php">
<input type="hidden" name="token" value="<?php echo $token; ?>" />
Confirm action?
<input type="submit" value="Confirm" />
</form>


<?php
session_start();
$token = $_SESSION['token'];
unset($_SESSION['token']);
session_write_close();

if ($token && $_POST['token']==$token) {
   // delete the record
} else {
   // log potential CSRF attack.
}

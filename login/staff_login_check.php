<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ろくまる農園</title>
</head>
<body>

<?php

ini_set("display_errors", "On");


define('DB_DATABASE','shop_book');
define('DB_USERNAME','eckosuke');
define('DB_PASSWORD','komazawataxidesu');
define('PDO_DSN','mysql:host=localhost;dbname=' . DB_DATABASE);




try {
	//DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$staff_code=$_POST['code'];
	$staff_pass=$_POST['pass'];



	$staff_code=htmlspecialchars($staff_code,ENT_QUOTES,'UTF-8');
	$staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

	$staff_pass = md5($staff_pass);


	$sql='SELECT name FROM  staff WHERE code=? AND password=?';
	$stmt = $db->prepare($sql);
	$data[] = $staff_code;
	$data[] = $staff_pass;
	$stmt->execute($data);

	$db = null;

	$rec = $stmt->fetch(PDO::FETCH_ASSOC);

	if($rec == false) {
		echo 'スタッフコードかパスワードが間違っています。';
		echo '<a href="staff_login.html>戻る</a>';
	} else {
		session_start();
		$_SESSION['login']=1;
		$_SESSION['staff_code']=$staff_code;
		$_SESSION['staff_name']=$rec['name'];
		header('Location:staff_top.php');
		exit();
	}

} catch(Exception $e) {
	echo 'ただいま障害により大変ご迷惑をお掛けいたしております。';
	exit();
}
?>

</body>
</html>
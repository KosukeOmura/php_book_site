<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ろくまる農園</title>
</head>
<body>

<?php

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login'])==false) {
    echo 'ログインできません';
    echo '<a href="../login/staff_login.html">ログイン画面へ</a>';
    exit();
}else {

    echo $_SESSION['staff_name'];
    echo 'さんログイン中 <br />';
    echo '<br />';
}




ini_set("display_errors", "On");

define('DB_DATABASE','shop_book');
define('DB_USERNAME','eckosuke');
define('DB_PASSWORD','komazawataxidesu');
define('PDO_DSN','mysql:host=localhost;dbname=' . DB_DATABASE);

try{

    //index.phpから入力データを受け取り処理
    $staff_code = $_POST['code'];


    //DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql ='DELETE FROM staff WHERE code=?';
    $stmt=$db->prepare($sql);
    $data[]=$staff_code;
    $stmt->execute($data);

    $db = null;


} catch(PDOException $e){
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
    print_r($sql->errorInfo());
}

?>


削除しました。<br />
<br />
<a href="staff_list.php"> 戻る</a>


</body>
</html>


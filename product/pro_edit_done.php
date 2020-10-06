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

define('DB_DATABASE','product');
define('DB_USERNAME','eckosuke');
define('DB_PASSWORD','komazawataxidesu');
define('PDO_DSN','mysql:host=localhost;dbname=' . DB_DATABASE);

try{

    //index.phpから入力データを受け取り処理
    $pro_name = $_POST['name'];
    $pro_price =$_POST['price'];
    $pro_code = $_POST['code'];
    $pro_image_name=$_POST['image_name'];
    $pro_image_name_old = $_POST['image_name_old'];
    $pro_image_name= $_POST['image_name'];


    $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
    $pro_pass=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

    //DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE mini_product SET name=?,price=?,image=?  WHERE code=?';
    $stmt=$db->prepare($sql);
    $data[]=$pro_name;
    $data[]=$pro_price;
    $data[]=$pro_code;
    $data[]=$pro_image_name;
    $stmt->execute($data);

    $db = null;

    echo '商品を追加しました。<br />';

} catch(PDOException $e){
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
    exit();
    print_r($sql->errorInfo());
}

if($pro_image_name_old !=$pro_image_name) {
    if($pro_image_name_old !='') {

        unlink('./image/'.$pro_image_name_old);

    }
}

?>

修正しました。<br />
<br />
<a href="pro_list.php"> 戻る</a>


</body>
</html>


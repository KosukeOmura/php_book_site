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

$pro_code=$_POST['code'];
$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_image_name_old=$_POST['image_name_old'];
$pro_image = $_FILES['image'];


$pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
$pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');
$pro_code=htmlspecialchars($pro_code,ENT_QUOTES,'UTF-8');

if($pro_name=='')
{
	print '商品名が入力されていません。<br />';
}
else
{
	print '商品名：';
	print $pro_name;
	print '<br />';
}

if(preg_match('/\A[0-9]+\z/',$pro_price)==0)
{
	echo '金額が入力されていません。<br />';
}
if($pro_image['size']>0) {

	if($pro_image['size']>1000000) {
		echo '画像が大き過ぎます。';
	}else {

		move_uploaded_file($pro_image['tmp_name'],'./image/'.$pro_image['name']);
		echo '<img src="./image/'.$pro_image['name'].'">';
		echo '<br />';
	}
}

if($pro_name=='' || preg_match('/\A[0-9]+\z/',$pro_price)==0 || $pro_image['size']>1000000)
{
	print '<form>';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '</form>';
}
else
{
    $pro_price=md5($pro_price);
    echo '上記のように変更します。<br />';
    print '<form method="post" action="pro_edit_done.php">';
    print '<input type="hidden" name="code" value="'.$pro_code.'">';
	print '<input type="hidden" name="name" value="'.$pro_name.'">';
	print '<input type="hidden" name="price" value="'.$pro_price.'">';
	print '<input type="hidden" name="image_name_old" value="'.$pro_image_name_old.'">';
	print '<input type="hidden" name="image_name" value="'.$pro_image['name'].'">';
	print '<br />';
	print '<input type="button" onclick="history.back()" value="戻る">';
	print '<input type="submit"　 value="ＯＫ">';
	print '</form>';
}

?>

</body>
</html>
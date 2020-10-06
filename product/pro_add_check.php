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


ini_set('display_errors', 1);

$pro_name=$_POST['name'];
$pro_price=$_POST['price'];
$pro_image=$_FILES['image'];

$pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
$pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');

if($pro_name == '') {

    echo '商品名が入力されていません.';

}else {
    echo '商品名：';
    echo $pro_name;
}
if(preg_match('/\A[0-9]+\z/',$pro_price)==0) {

    echo '商品金額が入力されていません。';
    
}else {
    echo '商品金額：';
    echo $pro_price;
    echo '円<br />';
}
//もし画像サイズが０より大きければ「画像あり」と判断する処理
if($pro_image['size'] > 0) {

    //画像サイズが100000より大きければエラー処理
    if($pro_image['size'] > 1000000) {

        echo '画像が大きすぎます。';
    }else {
        move_uploaded_file($pro_image['tmp_name'],'./image/'.$pro_image['name']);
        echo '<img src="./image/'.$pro_image['name'].'" >';
        echo '<br />';
    }
}


if($pro_name == '' || preg_match('/\A[0-9]+\z/',$pro_price)==0 || $pro_image['size'] > 1000000) {

    echo '<form>';
    echo '半角数字で入力ください';
    echo '<input type="button" onclick="history.back()" value="戻る" >';
    echo '</form>';
}else {

    echo '上記の金額を追加します。';
    echo '<form method="post" action="pro_add_done.php">';
    echo '<input type="hidden" name="name" value="'.$pro_name.'">';
    echo '<input type="hidden" name="price" value="'.$pro_price.'">';
    echo '<input type="hidden" name="image_name" value="'.$pro_image['name'].'">';
    echo '<br/>';
    echo '<input type="button" onclick="history.back()" value="戻る">';
    echo '<input type="submit" value="OK">';
    echo '</form>';

}

?>


</body>
</html>
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


try {

    //選択されたpro_list.phpで作成した「スタッフコード」を受け取る処理
    $pro_code = filter_input(INPUT_POST, 'procode');
    
    //DB接続
    define('DB_DATABASE','product');
    define('DB_USERNAME','eckosuke');
    define('DB_PASSWORD','komazawataxidesu');
    define('PDO_DSN','mysql:host=localhost;dbname=' . DB_DATABASE);


    //DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //データの名前をを全て出力するSQL文
    $sql='SELECT name,price,image FROM mini_product WHERE code=?';
    $stmt= $db->prepare($sql);
    $data[] = $pro_code;
    $stmt->execute($data);

    //fetch（どのようにデータ取る？) FETCH_ASSOC(一行ずつ配列)
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $pro_name=$rec['name'];
    $pro_price=$rec['price'];
    $pro_image_name_old = $rec['image'];
    $rec=$stmt->fetch(PDO::FETCH_ASSOC);

    $db = null;

    //画像を表示する処理
    //画像がない商品の時に壊れた画像アイコンが出ないようにif文で画像がない場合の処理を命令しておく
    if($pro_image_name_old== '') {
        $disp_image = '';
    }else {
        $disp_image = '<img src="./image/'.$pro_image_name.'">';
    }


}catch(Exception $e) {
    echo 'ただいま障害発生中';
    exit();
}

?>

商品情報修正 <br/>
<br />
商品コード <br />
<?php echo $pro_code; ?>

<br />
<br />
<form method="post" action="pro_edit_check.php" enctype="multipart/form-data">
<!-- valueを初期設定で名前が元から編集画面で入るように処理 -->
    <input type="hidden" name="code" value="<?php echo $pro_code; ?>">
    <input type="hidden" name="image" value="<?php echo $pro_image_name_old; ?>">
    商品名 <br />
    <input type="text" name="name" style="width:200px" value="<?php echo $pro_name; ?>">
    <br />
    商品金額 <br />
    <input type="text" name="price" style="width:50px" value="<?php echo $pro_price; ?>">円<br />
    <br />
    <?php echo $disp_image;?>
    <br />
    画像を選んでください<br />
    <input type="file" name="image" style="width:400px"><br />
    <br />
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
</form>


</body>
</html>
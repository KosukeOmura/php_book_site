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

try {

    //選択されたstaff_list.phpで作成した「スタッフコード」を受け取る処理
    $staff_code = $_GET['staffcode'];

    //DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //データの名前をを全て出力するSQL文
    $sql = 'SELECT name FROM staff WHERE code =? ';
    $stmt= $db->prepare($sql);
    $data[] = $staff_code;
    $stmt->execute($data);

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $staff_name = $rec['name'];



}catch(Exception $e) {
    echo 'ただいま障害発生中';
    exit();
}

?>

スタッフ削除 <br/>
<br />
スタッフコード <br />
<?php echo $staff_code; ?>
<br />
スタッフ名 <br />
<?php echo $staff_name; ?>
<br />
このスタッフを削除してもよろしいですか? <br />

<?php echo '<form method="post" action="staff_delete_done.php">'; ?>
<!-- valueを初期設定で名前が元から編集画面で入るように処理 -->
    <input type="hidden" name="code" value="<?php echo $staff_code; ?>">

    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" value="OK">
<?php echo '</form>' ?>

</body>
</html>
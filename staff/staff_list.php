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


    //DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //データの名前をを全て出力するSQL文
    $sql = 'SELECT code,name FROM staff WHERE 1 ';
    $stmt= $db->prepare($sql);
    $stmt->execute();

    $db = null;

    echo 'スタッフ一覧<br><br/>';

    echo '<form method="post" action="staff_branch.php">';
        //↓スタッフの名前を$stmtから１レコードずつ取り出しながら表示
        // データが無くなったらループ終了
        while(true){
            //$stmtから１レコード取り出している処理
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);

            //$stmtからもうデータがなければループ終了処理
            if($rec ==false) {
                break;
            }
            echo'<br/>';
            //ラジオぼたん
            echo '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
            echo $rec['name'];
        }
    echo'<br/>';
    echo '<input type="submit" name="disp" value="参照">';
    echo '<input type="submit" name="add" value="追加">';
    echo '<input type="submit" name="edit" value="修正">';
    echo '<input type="submit" name="delete" value="削除">';
    echo '</form>';

}catch(Exception $e) {
    echo 'ただいま障害発生中';
    exit();
}


?>

<br />
<a href="../login/staff_top.php">トップメニューへ</a>


</body>
</html>
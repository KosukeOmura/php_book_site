
<?php

// session_start();
// session_regenerate_id(true);
// if(isset($_SESSION['login'])==false) {
//     echo 'ログインできません';
//     echo '<a href="../login/staff_login.html">ログイン画面へ</a>';
//     exit();
// }else {

//     echo $_SESSION['staff_name'];
//     echo 'さんログイン中 <br />';
//     echo '<br />';
// }


ini_set("display_errors", "On");

define('DB_DATABASE','shop_book');
define('DB_USERNAME','eckosuke');
define('DB_PASSWORD','komazawataxidesu');
define('PDO_DSN','mysql:host=localhost;dbname=' . DB_DATABASE);

try{

    //index.phpから入力データを受け取り処理
    $staff_name = $_POST['name'];
    $staff_pass =$_POST['password'];


    $staff_name=htmlspecialchars($staff_name,ENT_QUOTES,'UTF-8');
    $staff_pass=htmlspecialchars($staff_pass,ENT_QUOTES,'UTF-8');

    //DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO staff (name,password) VALUES (?,?)';
    $stmt=$db->prepare($sql);
    $data[]=$staff_name;
    $data[]=$staff_pass;
    $stmt->execute($data);


    echo $staff_name;
    echo 'さんを追加しました。<br />';


    $db= null;

} catch(PDOException $e){
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

$db=null;

?>

<a href="staff_list.php"> 戻る</a>

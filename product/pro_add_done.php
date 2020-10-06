
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
    $pro_image_name = $_POST['image_name'];
    

    $pro_name=htmlspecialchars($pro_name,ENT_QUOTES,'UTF-8');
    $pro_price=htmlspecialchars($pro_price,ENT_QUOTES,'UTF-8');
    $pro_image_name=htmlspecialchars($pro_image_name,ENT_QUOTES,'UTF-8');

    //DB接続
    $db = new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD);
    //エラーをスロー
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql='INSERT INTO mini_product (name,price,image) VALUES (?,?,?)';
    $stmt=$db->prepare($sql);
    $data[]=$pro_name;
    $data[]=$pro_price;
    $data[]=$pro_image_name;
    $stmt->execute($data);


    echo $pro_name;
    echo 'を追加しました。<br />';


    $db= null;

} catch(PDOException $e){
	echo 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

$db=null;

?>

<a href="pro_list.php"> 戻る</a>

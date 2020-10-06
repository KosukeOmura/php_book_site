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
     ?>

商品が選択されていません<br/>
<a href="pro_list.php">商品一覧へ戻る</a>



</body>
</html>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> ろくまる農園</title>
</head>
<body>
スタッフが選択されていません<br/>
<a href="staff_list.php">リスト選択へ戻る</a>

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

</body>
</html>